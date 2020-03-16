<?php

namespace App\Http\Controllers;

use App\mrp;
use App\Order;
use App\Product;
use App\Project;
use App\ProjectProcess;
use Illuminate\Http\Request;

class MrpController extends Controller
{
    public function index(){
        $current_month = date('F');
        $current_week_number = date('W');
        $projects = Project::with('processes')->get();
        $processes = ProjectProcess::all();
        $product = Product::find(3)->first();
        
        // $first_day = date('d-m-Y');
        $first_day = '09-03-2020';
        $currentDate = strtotime($first_day);
        $day_14 = date("d-m-Y", strtotime("+14 day", $currentDate));

        $date = mrp::whereBetween('date', [$first_day, $day_14])->where('product_id', 1)->get();
         $mrp_date = mrp::all();
        $date_count = count($date);
        // dd($date);
        if($date_count == 0){
            foreach($projects as $project){
                for($i=1; $i<=14; $i++){
                    $formatted = date("d-m-Y", $currentDate);
                    $mrp = new mrp;
                    $mrp->date = $formatted;
                    $mrp->product_id = $project->product_id;
                    $mrp->save();
    
                    //Add one day onto the timestamp / counter.
                    $currentDate = strtotime("+1 day", $currentDate);
                }
                $first_day = date('d-m-Y');
                $currentDate = strtotime($first_day);
            } 
        }
        else{
            foreach($projects as $project){
                $formatted = date("d-m-Y", $currentDate);
                $currentDate = strtotime("+13 day", $currentDate);
                $latest = date('d-m-Y', $currentDate);

                $each_date = mrp::where('date', $latest)->where('product_id', $project->product_id)->get();
                // dd(count($date));
                if(count($each_date) == 0){
                    $mrp = new mrp;
                    $mrp->date = $latest;
                    $mrp->product_id = $project->product_id;
                    $mrp->save();
                }
                
                $first_day = date('d-m-Y');
                $currentDate = strtotime($first_day);
                
            }
        }

        $beginning_inventory = $product->current_stock;
        $first_id = $date->first();
        $first_id->on_hand = $beginning_inventory;
        $first_id->save();

        $initial = $first_id->on_hand;
        $prev = $first_id->on_hand;
        
        $manufacture_cycle = 1;
        $lead_time = $manufacture_cycle;
        $min_production = 50;
        $max_production = 350;
        $production_level = $max_production / 2;
        $production_counter = $production_level; 
        $i = 0;
        $old_value = 0;
        
        
        foreach($date->fresh() as $index => $each_date){  
            $order_receipt = 0;
            //Calculate On Hand////////////////////////////////////////////////////
            if($index > 0){
                $initial = $initial - $date[$index-1]->quantity;
                // dump($initial);
                if($initial >= 0){
                    $each_date->on_hand = $initial;
                    $date[$index-1]->order_receipt = 0;
                    $production = 0;
                }

                else{
                    $net = $order_receipt = abs($initial);
                    
                    if($net < $production_level){
                        $min = $net % $min_production; //calculate the balance
                        $max = floor($net / $min_production);
                        if($min !== 0){
                            $min = 50;
                        }
                        if($max !== 0){
                            $max = $max * $min_production;
                        }
                        $total_production = $min + $max;
                        $total = $total_production - $net;
                        $production = $total_production;
                        $each_date->on_hand = $total;
                        $initial = $total;
                        $date[$index-1]->order_receipt = $production;
                    }

                    if($net >= $production_level){
                        $max_pro = floor($net / $max_production);
                        $min_pro = $net % $max_production;
                        if($max_pro > 0){
                            
                            if($min_pro == 0){
                                $cummulative_production = 0;
                                for($j=1; $j<=$max_pro; $j++){
                                    $date[$index-$j]->order_receipt = $max_production;
                                    $cummulative_production += $max_production;
                                }
                                $initial = $cummulative_production-$net;
                                $each_date->on_hand = $initial;
                            }
                            if($min_pro !== 0){
                                $cummulative_production = 0;
                                if($min_pro >=  $production_level){
                                    $date[$index-1]->order_receipt = $max_production;
                                    // $each_date->on_hand = $max_production;
                                    $initial = $max_production;
                                    $cummulative_production += $max_production;
                                }
                                else{
                                    $date[$index-1]->order_receipt = $min_pro;
                                    // $each_date->on_hand = $min_pro;
                                    $initial = $min_pro;
                                    $cummulative_production += $min_pro;
                                }

                                for($j=1; $j<=$max_pro; $j++){
                                    $date[$index-1-$j]->order_receipt = $max_production;
                                    // $each_date->on_hand = $max_production;
                                    // $initial = $max_production;
                                    $cummulative_production +=  $max_production;
                                }
                                $initial = $cummulative_production-$net;
                                $each_date->on_hand = $initial;
                            }

                            
                        }

                        if($max_pro == 0){
                            if($min_pro < $production_level){
                                $total = $min_pro - $net;
                                $each_date->on_hand = $total;
                                $initial = $total;
                                $date[$index-1]->order_receipt = $min_pro;
                            }

                            if($min_pro > $production_level){
                                $total = $max_production - $net;
                                $each_date->on_hand = $total;
                                $initial = $total;
                                $date[$index-1]->order_receipt = $max_production;
                            }
                        }
                        
                    }
                    
                }

                // if($order_receipt > $max_production ){
                //     $max_pro = floor($order_receipt / $max_production);
                //     $min_pro = $order_receipt % $max_production;
                //     if($min_pro !== 0){
                //         dump($min_pro ." ". $production_level);
                //         if($min_pro >=  $production_level){
                //             $date[$index-1]->order_receipt = $max_production;
                //         }
                //         else{
                //             $date[$index-1]->order_receipt = $min_pro;
                //         }
                        
                //     }
                //     if($max_pro !== 0){
                //         for($j=1; $j<=$max_pro; $j++){
                //             $date[$index-1-$j]->order_receipt = $max_production;
                //         }
                //     }
                        
                    
                // }

                // else{
                //     $date[$index-1]->order_receipt = $order_receipt;
                // }
                $date[$index-1]->save();
            }

            //Calculate Net Requirement/////////////////////////////////////////////
            $balance = $each_date->on_hand - $each_date->quantity;
            if($balance > 0){
                $each_date->net_requirement = 0;
            }
            if($balance <= 0){
                $each_date->net_requirement = abs($balance);
                
               
            }
            $each_date->save();
        }
        
        return view('Mrp.index', compact('current_month', 'current_week_number', 'projects', 'processes', 'first_day', 'date', 'product'));
    }
}
