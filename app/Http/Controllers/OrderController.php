<?php

namespace App\Http\Controllers;

use App\Bom;
use App\mrp;
use App\Order;
use App\Product;
use App\Project;
use App\Customer;
use App\OrderItem;
use Carbon\Carbon;
use App\MrpRawMaterial;
use App\ProjectMaterial;
use App\ProductionCapacity;
use App\RawMaterialSupplier;
use Illuminate\Http\Request;
use App\InventoryStockTransaction;

class OrderController extends Controller
{
    public function index()
    {
        $AllOrders = Order::all();
        if(auth()->user()->user_type == 1){
            $order = $AllOrders->where('customer_id', auth()->user()->id);
            return view('Order.index', compact('order'));
        }
        
        else{ 
            $order = $AllOrders;
            return view('Order.index', compact('order'));
        }
    }

    public function create()
    {
        $customer = Customer::all();
        $product = Product::all();
        $project = Project::all();

        //generate automate running number
        $twodigit1st = date('y');
        $twodigit2nd = date('m');

        $first_day_this_month = today()->startOfMonth()->format('Y-m-d');
        $date_today = today()->format('Y-m-d');

        $get_number_of_order = Order::whereBetween('order_date', [$first_day_this_month, $date_today])->get();
        $total_orders = count($get_number_of_order) + 1;

        $orderID = str_pad($total_orders, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st . $twodigit2nd . $orderID;
        return view('Order.create', compact('customer', 'product', 'unique_number', 'project'));
    }

    public function store(Request $request)
    {
        $rawMaterialSupplier = RawMaterialSupplier::all();

        //Find longest lead time of supplier
        $highest_lead_time = 0;
        foreach ($rawMaterialSupplier as $rms) {
            $supplier_lead_time = $rms->lead_time;
            $current = $supplier_lead_time;

            if ($current > $highest_lead_time) {
                $highest_lead_time = $current;
            }
        }

        $current_date = today();
        $accumulate_lead_time = $highest_lead_time + 2; //2 represent manufacturing time + 1 day after order is confirmed
        $delivery_date = today()->addDays($accumulate_lead_time);
        $Order = new Order;
        $Order->order_number = $request->input('order_number');
        $Order->customer_id = auth()->user()->id;
        $Order->order_date = $current_date;
        $Order->delivery_date = $delivery_date;
        $Order->save();

        $capacity = ProductionCapacity::all();
        $MrpAll = mrp::orderBy('date', 'asc')->get();
        $ProjectRawMaterials = ProjectMaterial::all();
        $ProductAll = Product::all();
        $MrpRM_All = MrpRawMaterial::all();
        for ($i = 0; $i < count($request->product_id); $i++) {
            OrderItem::create([
                'order_id' => $Order->id,
                'item_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i]
            ]);
                
            $balance_next_day = -1;
            $current_quantity = $request->quantity[$i];
            while ($balance_next_day < 0) {
                $mrp_quantity = $MrpAll->where('date', $delivery_date);
                $total_quantity_mrp = 0;
                foreach ($mrp_quantity as $quantity_item) {
                    $total_quantity_mrp += $quantity_item->quantity;
                }

                $balance_of_day = $capacity[0]->max_production - $total_quantity_mrp;
                $balance_next_day = $balance_of_day - $current_quantity;

                if ($balance_next_day < 0) {
                    $mrp = $MrpAll->where('date', $delivery_date)->where('product_id',  $request->product_id[$i])->first();
                    $mrp_id = $MrpAll->find($mrp->id);
                    $mrp_id->quantity = $mrp_id->quantity + $balance_of_day;
                    $mrp_id->save();
                    $current_quantity = abs($balance_next_day);
                }

                if ($balance_next_day == 0) {
                    $mrp = $MrpAll->where('date', $delivery_date)->where('product_id',  $request->product_id[$i])->first();
                    $mrp_id = $MrpAll->find($mrp->id);
                    $mrp_id->quantity = $mrp_id->quantity + $balance_of_day;
                    $mrp_id->save();
                }

                if ($balance_next_day > 0) {
                    $mrp = $MrpAll->where('date', $delivery_date)->where('product_id',  $request->product_id[$i])->first();
                    $mrp_id = $MrpAll->find($mrp->id);
                    $mrp_id->quantity = $mrp_id->quantity + $current_quantity;
                    $mrp_id->save();
                    $current_quantity = abs($balance_next_day);
                }
                $delivery_date = $delivery_date->addDays(1);
            }
                //CALCULATE MRP lvl 0/////////////////////////////////////////////////////////////////////////////////////////////////////
                //call the first 30 days
                $date = $MrpAll->where('product_id', $request->product_id[$i])
                    ->whereBetween(
                        'date',
                        [
                            today(),
                            today()->addDays(30)
                        ]
                    )->values(); // formula purposes
                
                //Initialize the beginning inventory of MRP table
                $product = $ProductAll->find($request->product_id[$i])->first();
                $beginning_inventory = $product->current_stock;
                $first_id = $date->first();
                $first_id->on_hand = $beginning_inventory;
                $first_id->save();

                $initial = $first_id->on_hand;
                $manufacture_cycle = 1;
                $lead_time = $manufacture_cycle;
                $min_production = $capacity[0]->min_production;
                $ProjectMaterial = $ProjectRawMaterials->where('project_id', $request->product_id[$i]);
                
                foreach ($date as $index => $each_date) {

                    //Calculate On Hand////////////////////////////////////////////////////
                    if ($index > 0 && isset($date[$index - 1])) {
                        $initial = $initial - $date[$index - 1]->quantity;
                        
                        if ($initial >= 0) {
                            $each_date->on_hand = $initial;
                            $date[$index - 1]->order_receipt = 0;
                            $date[$index - 1]->save();
                        } 
                        
                        else {
                            $net  = abs($initial);
                            $min = $net % $min_production; //calculate the balance
                            $max = floor($net / $min_production);
                            if ($min !== 0) {
                                $min = $min_production;
                            }
                            if ($max !== 0) {
                                $max = $max * $min_production;
                            }
                            $total_production = $min + $max;
                            $total = $total_production - $net;
                            $production = $total_production;
                            $each_date->on_hand = $total;
                            $initial = $total;
                            $date[$index - 1]->order_receipt = $production;
                            $date[$index - 1]->save();
                            $date[$index - 1 - $lead_time]->order_release = $production;
                            $date[$index - 1 - $lead_time]->save();
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

                $assign_RawMaterialMrp = $date->where('order_release', '!=' , 0);
                foreach ($assign_RawMaterialMrp as $rm) {
                    foreach ($rm->projects->materials as $item){
                        //Assign quantity of mrp Raw Materials
                        $mrp_raw_material = $MrpRM_All  ->where('date', $rm->date->format('Y-m-d'))
                                                        ->where('product_id', $rm->product_id)
                                                        ->where('raw_material_id', $item->pivot->raw_material_id)
                                                        ->first();
                        $mrp_raw_material->quantity = $rm->order_release * $item->pivot->quantity;
                        $mrp_raw_material->save();
                    }
                }
        }
        return redirect(route('order.index'));
    }

    public function downloadPDF($id)
    {
        $orders = Order::find($id);
        return view('Order.download', compact('orders'));
    }

    public function getModalDO($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('order.do',['id'=>$id]);
          return view('order/modal_confirmation', compact('error','model', 'confirm_route'));

      }

      public function getDO($id = null)
    {
        $order = Order::find($id);
        $order->status = 14;
        $products = Product::all();
        foreach($order->order_item as $item){
            $inventoryStockTransaction = new InventoryStockTransaction();
            $inventoryStockTransaction->transaction_id = 2;
            $inventoryStockTransaction->grn_id = 0;
            $inventoryStockTransaction->wo_id = 0;
            $inventoryStockTransaction->transaction_by = "Izah Atirah";
            $inventoryStockTransaction->quantity = $item->quantity;
            $inventoryStockTransaction->category_id = 2;
            $inventoryStockTransaction->item_id = $item->item_id;
            $inventoryStockTransaction->save();
            foreach($products as $product){
                if($item->item_id == $product->id){
                    $product->current_stock = $product->current_stock - $item->quantity;
                    $product->save();
                }
            }
        }
        
        $order->save();
        
        return redirect(route('order.index'));
    }
}
