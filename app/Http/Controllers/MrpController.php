<?php

namespace App\Http\Controllers;

use App\mrp;
use App\Product;
use App\Project;
use App\MrpRawMaterial;
use App\ProjectProcess;
use App\ProductionCapacity;
use App\RawMaterial;
use Illuminate\Http\Request;

class MrpController extends Controller
{
    public function index(){
        $checkBOM = Project::all();
        if(count($checkBOM) == 0){
            return view('Mrp.indexNoBOM');
        }
        else{
            $current_month = date('F');
            $current_week_number = date('W');
            $projects = Project::with('processes')->get();
            $processes = ProjectProcess::all();
        
            //call the first 14 days
            $first_day = today();
            // ni basically tambah 13 dari hari ni ke apa  ?yes
            $day_14 = today()->addDays(13);
            $dates = mrp::whereBetween('date', [$first_day, $day_14])->where('product_id', 3)->orderBy('date', 'ASC')->get();
            $date_raw_materials = MrpRawMaterial::whereBetween('date', [$first_day, $day_14])->where('product_id', 3)->orderBy('date', 'ASC')->get();
            $mrp = mrp::where('date', $first_day)->where('product_id', 3)->get();
            $product = Product::find(3);
            $project = Project::where('product_id', $product);
            if($mrp->first()->on_hand == 0){
                foreach($dates as $item){
                    $item->on_hand = $product->current_stock;
                    $item->save();
                }  
            }

            $Projects = Project::all();
            foreach ($Projects as $project) {
                //CALCULATE MRP lvl 1/////////////////////////////////////////////////////////////////////////////////////////////////////
                //call the first 30 days
                foreach($project->materials as $raw_materials){
                    $mrp_raw_material = MrpRawMaterial::where('product_id', $project->product_id)
                                                        ->where('raw_material_id', $raw_materials->pivot->raw_material_id)
                                                        ->whereBetween(
                                                            'date',
                                                            [
                                                                today(),
                                                                today()->addDays(15)
                                                            ]
                                                        )
                                                        ->orderBy('date', 'ASC')
                                                        ->get(); // formula purposes

                                                        // Initialize the beginning inventory of MRP table
                    $raw_material = RawMaterial::find($mrp_raw_material->first()->raw_material_id);
                    // dump($raw_material);
                    $beginning_inventory = $raw_material->current_stock;
                    $first_id = $mrp_raw_material->first();
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
                    foreach($mrp_raw_material as $index => $each_date){

                        //Calculate On Hand////////////////////////////////////////////////////
                        if ($index > 0) {
                            $initial = $initial - $mrp_raw_material[$index - 1]->quantity;
                            // dump($initial);
                            if ($initial >= 0) {
                                $each_date->on_hand = $initial;
                                $mrp_raw_material[$index - 1]->order_receipt = 0;
                                $mrp_raw_material[$index - 1]->save();
                            } 
                            
                            else {
                                $net  = abs($initial);
                                $net_round_up = ceil($net);
                                $total = $net_round_up - $net;
                                $each_date->on_hand = $total;
                                $initial = $total;
                                $mrp_raw_material[$index - 1]->order_receipt = $net_round_up;
                                $mrp_raw_material[$index - 1]->save();
                                $mrp_raw_material[$index - 1 - $shortest_lead_time]->order_release = $net_round_up;
                                $mrp_raw_material[$index - 1 - $shortest_lead_time]->save();
                            }
                        }

                        //Calculate Net Requirement/////////////////////////////////////////////
                        $balance = $each_date->on_hand - $each_date->quantity;
                        if ($balance > 0) {
                            $each_date->net_requirement = 0;
                        }
                        if ($balance <= 0) {
                            $each_date->net_requirement = abs($balance);
                        }
                        $each_date->save();
                    }
                }
            }

            return view('Mrp.index', compact('current_month', 'current_week_number', 
                                            'projects', 'processes', 'first_day', 
                                            'date', 'product', 'dates', 
                                            'date_raw_materials', 'project'));
        }
    }
}
