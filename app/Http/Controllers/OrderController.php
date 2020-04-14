<?php

namespace App\Http\Controllers;

use App\Bom;
use App\mrp;
use App\Order;
use App\Product;
use App\Project;
use App\Customer;
use App\OrderItem;
use App\ProductionCapacity;
use App\RawMaterialSupplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();

        return view('Order.index', compact('order'));
    }

    public function create()
    {
        $customer = Customer::all();
        $product = Product::all();
        $project = Project::all();

        //generate automate running number
        $twodigit1st = date('y');
        $twodigit2nd = date('m');

        $first_day_this_month = date('m-01-Y');
        $date_today = date('d/m/Y');

        $get_number_of_order = Order::whereBetween('order_date', [$first_day_this_month, $date_today])->paginate(10000);
        $total_orders = $get_number_of_order->total() + 1;

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

        $current_date = date('d-m-Y');
        $accumulate_lead_time = $highest_lead_time + 2;
        $delivery_date = today()->addDays($accumulate_lead_time);
        $Order = new Order;
        $Order->order_number = $request->input('order_number');
        $Order->customer_id = $request->input('cust_id');
        $Order->order_date = $current_date;
        $Order->delivery_date = $delivery_date;
        $Order->save();

        for ($i = 0; $i < count($request->product_id); $i++) {
            OrderItem::create([
                'order_id' => $Order->id,
                'item_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i]
            ]);

            $capacity = ProductionCapacity::all();
            $balance_next_day = -1;
            $current_quantity = $request->quantity[$i];
            while ($balance_next_day < 0) {
                $mrp_quantity = mrp::where('date', $delivery_date)->get();
                $total_quantity_mrp = 0;

                foreach ($mrp_quantity as $quantity_item) {
                    $total_quantity_mrp += $quantity_item->quantity;
                }

                $balance_of_day = $capacity[0]->max_production - $total_quantity_mrp;
                $balance_next_day = $balance_of_day - $current_quantity;

                if ($balance_next_day < 0) {
                    $mrp = mrp::where('date', $delivery_date)->where('product_id',  $request->product_id[$i])->first();
                    $mrp_id = mrp::find($mrp->id);
                    $mrp_id->quantity = $mrp_id->quantity + $balance_of_day;
                    $mrp_id->save();
                    $current_quantity = abs($balance_next_day);
                }

                if ($balance_next_day == 0) {
                    $mrp = mrp::where('date', $delivery_date)->where('product_id',  $request->product_id[$i])->first();
                    $mrp_id = mrp::find($mrp->id);
                    $mrp_id->quantity = $mrp_id->quantity + $balance_of_day;
                    $mrp_id->save();
                }

                if ($balance_next_day > 0) {
                    $mrp = mrp::where(['date' => $delivery_date, 'product_id' => (int) $request->product_id[$i]])->first();
                    $mrp_id = mrp::find($mrp->id);
                    $mrp_id->quantity = $mrp_id->quantity + $current_quantity;
                    $mrp_id->save();
                    $current_quantity = abs($balance_next_day);
                }
                $delivery_date = $delivery_date->addDays(1);
            }

            $count_project = count(Project::all());
            for ($i = 0; $i < $count_project; $i++) {
                //CALCULATE MRP lvl 0/////////////////////////////////////////////////////////////////////////////////////////////////////
                //call the first 30 days
                $date = mrp::where('product_id', (int) $request->product_id[$i])
                    ->whereBetween(
                        'date',
                        [
                            today(),
                            today()->addDays(14)
                        ]
                    )
                    ->orderBy('date', 'ASC')
                    ->get(); // formula purposes

                //Initialize the beginning inventory of MRP table
                $product = Product::find($request->product_id[$i])->first();
                $beginning_inventory = $product->current_stock;
                $first_id = $date->first();
                $first_id->on_hand = $beginning_inventory;
                $first_id->save();

                $initial = $first_id->on_hand;
                $production_capacity = ProductionCapacity::all();
                $manufacture_cycle = 1;
                $lead_time = $manufacture_cycle;
                $min_production = $production_capacity[0]->min_production;
                
                foreach ($date as $index => $each_date) {
                    //Calculate On Hand////////////////////////////////////////////////////
                    if ($index > 0) {
                        $initial = $initial - $date[$index - 1]->quantity;
                        
                        if ($initial >= 0) {
                            $each_date->on_hand = $initial;
                            $date[$index - 1]->order_receipt = 0;
                            $date[$index - 1]->save();
                            $production = 0;
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
            }
        }

        // $count_project = count(Project::all());
        // for ($i = 0; $i < $count_project; $i++) {
        //     //CALCULATE MRP lvl 0/////////////////////////////////////////////////////////////////////////////////////////////////////
        //     //call the first 30 days
        //     $date = mrp::where('product_id', (int) $request->product_id[$i])
        //         ->whereBetween(
        //             'date',
        //             [
        //                 today(),
        //                 today()->addDays(14)
        //             ]
        //         )
        //         ->orderBy('date', 'ASC')
        //         ->get(); // formula purposes
        //     // dd($date);
        //     //Initialize the beginning inventory of MRP table
        //     $product = Product::find($request->product_id[$i])->first();
        //     $beginning_inventory = $product->current_stock;
        //     $first_id = $date->first();
        //     $first_id->on_hand = $beginning_inventory;
        //     $first_id->save();

        //     $initial = $first_id->on_hand;
        //     $production_capacity = ProductionCapacity::all();
        //     $manufacture_cycle = 1;
        //     $lead_time = $manufacture_cycle;
        //     $min_production = $production_capacity[0]->min_production;
        //     $max_production = $production_capacity[0]->max_production;
        //     // $production_level = $max_production / 2;
        //     $i = 0;
        //     foreach ($date as $index => $each_date) {
        //         //Calculate On Hand////////////////////////////////////////////////////
        //         dump( $i.":".$initial."-".$each_date->quantity);
        //         if ($index > 0) {
        //             $initial = $initial - $date[$index - 1]->quantity;
        //             // dump( $i.":".$initial."-".$date[$index - 1]->quantity);
                    
        //             if ($initial >= 0) {
        //                 $each_date->on_hand = $initial;
        //                 $date[$index - 1]->order_receipt = 0;
        //                 $date[$index - 1]->save();
        //                 $production = 0;
        //             } 
                    
        //             else {
        //                 // dump( $i."else:".$initial);
        //                 $net  = abs($initial);
        //                 // if($net < $production_level){
        //                 $min = $net % $min_production; //calculate the balance
        //                 $max = floor($net / $min_production);
        //                 if ($min !== 0) {
        //                     $min = 50;
        //                 }
        //                 if ($max !== 0) {
        //                     $max = $max * $min_production;
        //                 }
        //                 $total_production = $min + $max;
        //                 $total = $total_production - $net;
        //                 $production = $total_production;
        //                 $each_date->on_hand = $total;
        //                 $initial = $total;
        //                 $date[$index - 1]->order_receipt = $production;
        //                 $date[$index - 1]->save();
        //                 $date[$index - 1 - $lead_time]->order_release = $production;
        //                 $date[$index - 1 - $lead_time]->save();
        //             }
        //             $i++;
        //                 // if($net >= $production_level){
        //                 //     $max_pro = floor($net / $max_production);
        //                 //     $min_pro = $net % $max_production;
        //                 //     $cummulative_production = 0;
        //                 //     if($max_pro > 0){

        //                 //         if($min_pro == 0){
        //                 //             for($j=1; $j<=$max_pro; $j++){
        //                 //                 $date[$index-$j]->order_receipt = $max_production;
        //                 //                 $date[$index-$j]->save();
        //                 //                 $date[$index-1-$lead_time-$j]->order_release = $max_production;
        //                 //                 $date[$index-1-$lead_time-$j]->save();
        //                 //                 $cummulative_production += $max_production;
        //                 //             }
        //                 //             $initial = $cummulative_production-$net;
        //                 //             $each_date->on_hand = $initial;
        //                 //         }
        //                 //         if($min_pro !== 0){
        //                 //             if($min_pro >=  $production_level){
        //                 //                 $date[$index-1]->order_receipt = $max_production;
        //                 //                 $date[$index-1]->save();
        //                 //                 $date[$index-1-$lead_time]->order_release = $max_production;
        //                 //                 $date[$index-1-$lead_time]->save();
        //                 //                 $initial = $max_production;
        //                 //                 $cummulative_production += $max_production;
        //                 //             }
        //                 //             else{
        //                 //                 $date[$index-1]->order_receipt = $min_pro;
        //                 //                 $date[$index-1]->save();
        //                 //                 $date[$index-1-$lead_time]->order_release = $min_pro;
        //                 //                 $date[$index-1-$lead_time]->save();
        //                 //                 $initial = $min_pro;
        //                 //                 $cummulative_production += $min_pro;
        //                 //             }

        //                 //             for($j=1; $j<=$max_pro; $j++){
        //                 //                 $date[$index-1-$j]->order_receipt = $max_production;
        //                 //                 $date[$index-1-$j]->save();
        //                 //                 $date[$index-1-$lead_time-$j]->order_release = $max_production;
        //                 //                 $date[$index-1-$lead_time-$j]->save();
        //                 //                 $cummulative_production +=  $max_production;
        //                 //             }
        //                 //             $initial = $cummulative_production-$net;
        //                 //             $each_date->on_hand = $initial;
        //                 //         }


        //                 //     }

        //                 //     if($max_pro == 0){
        //                 //         if($min_pro < $production_level){
        //                 //             $total = $min_pro - $net;
        //                 //             $each_date->on_hand = $total;
        //                 //             $initial = $total;
        //                 //             $date[$index-1]->order_receipt = $min_pro;
        //                 //             $date[$index-1]->save();
        //                 //             $date[$index-1-$lead_time]->order_release = $min_pro;
        //                 //             $date[$index-1-$lead_time]->save();
        //                 //         }

        //                 //         if($min_pro > $production_level){
        //                 //             $total = $max_production - $net;
        //                 //             $each_date->on_hand = $total;
        //                 //             $initial = $total;
        //                 //             $date[$index-1]->order_receipt = $max_production;
        //                 //             $date[$index-1]->save();
        //                 //             $date[$index-1-$lead_time]->order_release = $max_production;
        //                 //             $date[$index-1-$lead_time]->save();
        //                 //         }
        //                 //     }

        //                 // }

        //             // }

        //         }

        //         //Calculate Net Requirement/////////////////////////////////////////////
        //         $balance = $each_date->on_hand - $each_date->quantity;
        //         if ($balance > 0) {
        //             $each_date->net_requirement = 0;
        //         }
        //         if ($balance <= 0) {
        //             $each_date->net_requirement = abs($balance);
        //         }
        //         $each_date->save();
        //     }
        // }

        return redirect(route('order.index'));
    }

    public function downloadPDF($id)
    {
        $orders = Order::find($id);
        return view('Order.download', compact('orders'));
    }
}
