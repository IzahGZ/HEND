<?php

namespace App\Http\Controllers;

use App\mrp;
use App\Product;
use App\Project;
use App\ProjectProcess;
use Illuminate\Http\Request;

class MrpController extends Controller
{
    public function index(){

        $checkBOM = Project::all();
        // dd(count($checkMRP));
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
            $mrp = mrp::where('date', $first_day)->where('product_id', 3)->get();
            $product = Product::find(3);
            
            if($mrp->first()->on_hand == 0){
                foreach($dates as $item){
                    $item->on_hand = $product->current_stock;
                    $item->save();
                }  
            }

            return view('Mrp.index', compact('current_month', 'current_week_number', 'projects', 'processes', 'first_day', 'date', 'product', 'dates'));
        }
    }
}
