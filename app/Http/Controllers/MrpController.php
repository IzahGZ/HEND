<?php

namespace App\Http\Controllers;

use App\mrp;
use App\Product;
use App\Project;
use App\Supplier;
use App\LotSizing;
use App\RawMaterial;
use App\PurchaseOrder;
use App\CompanyProfile;
use App\MrpRawMaterial;
use App\ProjectProcess;
use App\RequestOfPurchase;
use App\ProductionCapacity;
use App\RawMaterialSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MrpController extends Controller
{
    public function index()
    {
        $checkBOM = Project::all();
        if (count($checkBOM) == 0) {
            return view('Mrp.indexNoBOM');
        } else {
            $current_month = date('F');
            $current_week_number = date('W');
            $projects = Project::with('processes')->get();
            $processes = ProjectProcess::all();

            return view('Mrp.index', compact('current_month', 'current_week_number', 'projects', 'processes'));
        }
    }

    public function generateMrp(Request $request)
    {
        $lot_sizing = LotSizing::all();
        $current_month = $request->month;
        $current_week_number = $request->current_week;
        $projects = $request->project_id;
        $manufacture_time = $request->manufacturing_time;

        //call the first 14 days
        $first_day = today();
        $day_14 = today()->addDays(13);
        $dates = mrp::whereBetween('date', [$first_day, $day_14])->where('product_id', $request->project_id)->orderBy('date', 'ASC')->get();
        $date_raw_materials = MrpRawMaterial::whereBetween('date', [$first_day, $day_14])->where('product_id', $request->project_id)->orderBy('date', 'ASC')->get();
        $mrp = mrp::where('date', $first_day)->where('product_id', $request->project_id)->get();
        $product = Product::find($request->project_id);
        // dd($mrp);
        if ($mrp->first()->on_hand == 0) {
            foreach ($dates as $item) {
                $item->on_hand = $product->current_stock;
                $item->save();
            }
        }
        return view('Mrp.indexGenerateMrp', compact(
            'current_month',
            'current_week_number',
            'projects',
            'processes',
            'first_day',
            'date',
            'product',
            'dates',
            'date_raw_materials',
            'manufacture_time',
            'lot_sizing'
        ));
    }

    public function LotSeizing(Request $request, $id)
    {
        // DB::enableQueryLog();
        DB::beginTransaction();
        $current_month = date('F');
        $current_week_number = date('W');
        $project = Project::with('materials','products')->find($id); 
        //Assign Lot Sizing technique to each raw materials
        $ls_count = 0;
        foreach($project->materials as $materials){
            $materials->pivot->lot_sizing_id = $request->input('method')[$ls_count];
            $materials->pivot->save();
            $ls_count++;
        }
        $projectName = $project->products->name; 
        $processes = ProjectProcess::where('project_id', $id)->get();
        $manufacturing_time = 0;
        foreach ($processes as $item) {
            $manufacturing_time += $item->duration;
        }

        $hour = floor($manufacturing_time / 60);
        $hour = intval($hour);
        $minute = $manufacturing_time % 60;
        $duration = $hour . " hours " . $minute . " minutes";

        //call the first 14 days
        $first_day = today();
        $day_14 = today()->addDays(13);
        $dates = mrp::whereBetween('date', [$first_day, $day_14])->where('product_id', $id)->orderBy('date', 'ASC')->get();
        $date_raw_materials = MrpRawMaterial::whereBetween('date', [$first_day, $day_14])->where('product_id', $id)->orderBy('date', 'ASC')->get();
        $mrp = mrp::where('date', $first_day)->where('product_id', $id)->get();
        $product = Product::find($id);
        $Projects = Project::where('product_id', $id)->get(); 
        if ($mrp->first()->on_hand == 0) {
            foreach ($dates as $item) {
                $item->on_hand = $product->current_stock;
                $item->save();
            }
        }

        // $Projects = Project::with('materials')->where('product_id', $id);
        $allMrps = MrpRawMaterial::orderBy('date', 'ASC')->get(); // formula purposes
        $allRawMaterials = RawMaterial::all();
        $Mrp = mrp::all();
        foreach ($Projects as $p) {
            //CALCULATE MRP lvl 1/////////////////////////////////////////////////////////////////////////////////////////////////////
            //call the first 30 days
            foreach ($p->materials as $raw_materials) {
                $mrp_raw_material = $allMrps->where('product_id', $p->product_id)
                    ->where('raw_material_id', $raw_materials->pivot->raw_material_id)
                    ->whereBetween(
                        'date',
                        [
                            today()->subDays(1),
                            today()->addDays(15)
                        ]
                    )->values();
                // Initialize the beginning inventory of MRP table
                $raw_material = $allRawMaterials->where('id', $mrp_raw_material->first()->raw_material_id)->first();
                $beginning_inventory = $raw_material->current_stock;
                
                $first_id = $mrp_raw_material->first();
                // dd($mrp_raw_material);
                $first_id->on_hand = $beginning_inventory;
                $first_id->save();

                $initial = $first_id->on_hand;
                $lead_time = $raw_materials->suppliers;
                //Find shortest lead time of supplier
                $shortest_lead_time = 0;
                foreach ($lead_time as $rms) {
                    $shortest_lead_time = $rms->lead_time;
                    $supplier_lead_time = $rms->lead_time;
                    $current = $supplier_lead_time;

                    if ($current < $shortest_lead_time) {
                        $shortest_lead_time = $current;
                    }
                }
                $total_demand = 0; //get total demand
                $EPP = $raw_materials->set_up_cost/$raw_materials->inventory_cost; //Initialize EPP value
                $lot_size = 0; //Initialize trial lot size
                $curr_index = 0;
                $combine_lot = 0; 
                foreach ($mrp_raw_material as $each_date) {
                    if($raw_materials->pivot->lot_sizing_id == 2){
                        $total_demand += $each_date->quantity;
                    }
                    
                    $each_date->on_hand = $initial;
                    $each_date->order_receipt = 0;
                    $each_date->order_release = 0;
                    $each_date->net_requirement = 0;
                    $each_date->save();
                }
                foreach ($mrp_raw_material as $index => $each_date) {
                    //Calculate On Hand
                    if ($index > 0 ) {
                        $initial = $initial - $mrp_raw_material[$index - 1]->quantity;
                        if ($initial >= 0) {
                            $each_date->on_hand = $initial;
                            $mrp_raw_material[$index - 1]->order_receipt = 0;
                            $mrp_raw_material[$index - 1]->save();
                        } else {
                            //Start LFL Lot Sizing method///////////////////////////////////
                            if($raw_materials->pivot->lot_sizing_id == 1){
                                $net  = abs($initial);
                                $net_round_up = ceil($net);
                                $total = $net_round_up - $net;
                                $each_date->on_hand = $total;
                                $initial = $total;

                                $mrp_raw_material[$index - 1]->order_receipt = $net_round_up;
                                $mrp_raw_material[$index - 1]->save();
                                if ($index - $shortest_lead_time >= 0) {
                                    $mrp_raw_material[$index - 1 - $shortest_lead_time]->order_release = $net_round_up;
                                    $mrp_raw_material[$index - 1 - $shortest_lead_time]->save();
                                }
                            }
                            if($raw_materials->pivot->lot_sizing_id == 2){
                                //Get Average Demand, D
                                $D = $total_demand / 7;
                                
                                //Get Q value
                                $Q = sqrt((2*$D*$raw_materials->set_up_cost)/$raw_materials->inventory_cost);
                                $net  = abs($initial);
                                $to_order = ceil($Q);
                                $total = $to_order - $net;
                                $each_date->on_hand = $total;
                                $initial = $total;

                                $mrp_raw_material[$index - 1]->order_receipt = $to_order;
                                $mrp_raw_material[$index - 1]->save();
                                if ($index - $shortest_lead_time >= 0) {
                                    $mrp_raw_material[$index - 1 - $shortest_lead_time]->order_release = $to_order;
                                    $mrp_raw_material[$index - 1 - $shortest_lead_time]->save();
                                }
                            }
                            if($raw_materials->pivot->lot_sizing_id == 3){
                                // abs($initial);
                                if($combine_lot < $EPP){
                                    $curr_index = $index-1;
                                    foreach ($mrp_raw_material as $index1 => $nested_each_date) {
                                        if($index1 > $curr_index ) {
                                            $combine_lot = $combine_lot + $mrp_raw_material[$curr_index + 1]->quantity;
                                            // dump("start: ".$curr_index);
                                            if($combine_lot > $EPP){
                                                // dump("end: ".$curr_index);
                                                $combine_lot = $combine_lot - $mrp_raw_material[$curr_index + 1]->quantity;
                                                $mrp_raw_material[$curr_index - 1 ]->order_receipt = $combine_lot;
                                                $mrp_raw_material[$curr_index - 1 ]->save();
                                                if ($curr_index - $shortest_lead_time >= 0) {
                                                    $mrp_raw_material[$curr_index - 1 - $shortest_lead_time]->order_release = $combine_lot;
                                                    $mrp_raw_material[$curr_index - 1 - $shortest_lead_time]->save();
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    $net  = abs($initial);
                                    $total = $combine_lot - $net;
                                    $each_date->on_hand = $total;
                                    $initial = $total;
                                }
                                $combine_lot = 0;
                            }
                        }
                    }

                    //Calculate Net Requirement
                    $balance = $each_date->on_hand - $each_date->quantity;
                    if ($balance >= 0) {
                        $each_date->net_requirement = 0;
                    }
                    if ($balance < 0) {
                        $each_date->net_requirement = abs($balance);
                        if($raw_materials->pivot->lot_sizing_id == 3){
                            if(abs($balance)< $EPP);
                                $lot_size = abs($balance);
                                $combine_lot = $lot_size;
                                // dump($combine_lot);
                        }
                    }
                    $each_date->save();
                }

            }
            $shortest_lead_time = 0;
            $total_demand = 0;
            $EPP = 0;
        }
        // dd(DB::getQueryLog());
        DB::commit();
        
        return view('Mrp.indexLotSeizing', compact(
            'current_month',
            'current_week_number',
            'first_day',
            'date',
            'product',
            'dates',
            'project',
            'projectName',
            'date_raw_materials',
            'duration'
        ));
    }

    public function getModalPR($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('purchaseRequest.pr',['id'=>$id]);
          return view('purchaseRequest/modal_confirmation', compact('error','model', 'confirm_route'));

      }

    public function getPR($id = null)
    {
        //generate automate running number
        $twodigit1st=date('y');
        $twodigit2nd=date('m');
        
        $first_day_this_month = date('Y-m-01');

        $get_number_of_pr = RequestOfPurchase::whereBetween('created_at',[$first_day_this_month, today()->addDays(1)->format('Y-m-d')])->paginate(10000);
        $total_pr = $get_number_of_pr->total() + 1;
        $prID = str_pad($total_pr, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st.$twodigit2nd.$prID;
        $mrpRawMaterial = MrpRawMaterial::find($id);
        // dd($mrpRawMaterial);
        $lead_time = $mrpRawMaterial->rawMaterials->suppliers;
            //Find shortest lead time of supplier
            $shortest_lead_time = 0;
            $lowest_price = 0;
            foreach ($lead_time as $rms) {
                $shortest_lead_time = $rms->lead_time;
                $supplier_lead_time = $rms->lead_time;
                $current = $supplier_lead_time;

                $lowest_price = $rms->price_per_unit;
                $price = $rms->price_per_unit;
                $current_price = $price;
                if ($current_price < $lowest_price) {
                    $lowest_price = $current_price;
                }

                if ($current < $shortest_lead_time) {
                    $shortest_lead_time = $current;
                }
            }
        $supplier = RawMaterialSupplier::where('lead_time', $shortest_lead_time)
                                         ->where('raw_material_id', $mrpRawMaterial->raw_material_id)
                                         ->where('price_per_unit', $lowest_price)
                                         ->first();
        $rop = new RequestOfPurchase;
        $rop->pr_number = $unique_number;
        $rop->item_id = $mrpRawMaterial->raw_material_id;
        $rop->raw_material_supplier_id = $supplier->id;
        $rop->quantity = $mrpRawMaterial->order_release;
        $rop->estimated_date = today()->addDays($shortest_lead_time)->format('Y-m-d');
        $rop->request_date = today()->format('Y-m-d');
        $rop->status = 2;
        $rop->request_by = "Izah Atirah";
        $rop->save();
        
        $mrpRawMaterial->order_release_status = 13;
        $mrpRawMaterial->pr_id = $rop->id;
        $mrpRawMaterial->save();

        return redirect(route('mrp.index'));

    }

    public function downloadMrpPDF($id){
        //call the first 14 days
        $product = Product::find($id);
        $project = Project::with('materials','products')->find($id);  
        $duration = 0;
        foreach($project->processes as $process){
            $duration = $duration + $process->pivot->duration;
        }
        $first_day = today();
        $day_14 = today()->addDays(13);
        $dates = mrp::whereBetween('date', [$first_day, $day_14])->where('product_id', $id)->orderBy('date', 'ASC')->get();
        $date_raw_materials = MrpRawMaterial::whereBetween('date', [$first_day, $day_14])->where('product_id', $id)->orderBy('date', 'ASC')->get();
        $company = CompanyProfile::all();
        
        return view('Mrp.downloadMrpPDF',compact(
            'dates', 
            'company', 
            'product',
            'project',
            'date_raw_materials',
            'duration'));
    }
}
