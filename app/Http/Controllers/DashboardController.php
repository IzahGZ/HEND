<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\WorkOrder;
use App\PurchaseOrder;
use App\GoodReceiveNote;
use App\OrderItem;
use App\Product;
use App\Project;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function profile(){
        $user = User::find(auth()->user()->id);

        if(auth()->user()->id == 1){
            return view('index.profile', compact('user'));
        }
        else{
            return view('index.profileStaff', compact('user'));
        }
        
    }

    public function editProfile(){
        $user = User::find(auth()->user()->id);

        if(auth()->user()->id == 1){
            return view('index.editProfile', compact('user'));
        }
        else{
            return view('index.editProfileStaff', compact('user'));
        }
        
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        if(auth()->user()->id == 1){
            $user->user_details->position = $request->input('position');
            $user->email = $request->input('email');
            $user->user_details->phone = $request->input('phone_number');
            $user->user_details->office_no = $request->input('office_number');
            $user->user_details->school = $request->input('school');
            $user->user_details->address = $request->input('address');
            $user->save();
            $user->user_details->save();
        }
        else{
            $user->email = $request->input('email');
            $user->save();
        }
        

        return redirect(route('profile.index',compact('user')))->with('success', 'Details updated');
    }

    public function updatePassword()
      { 
          $user = User::find(auth()->user()->id);
          return view('index.changePassword');
      }

    public function storePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->password = $request->input('password');
        $user->save();
        return redirect(route('profile.index',compact('user')))->with('success', 'Password changed');

    }

    public function index()
    {
        $AllOrders = Order::get();
        $AllPo = PurchaseOrder::all();
        $AllGrn = GoodReceiveNote::all();
        $AllWo = WorkOrder::all();
        $AllProject = Project::all();
        $AllSchools = Customer::all();

        //Get number of Student
        $student_no = 0;
        foreach($AllSchools as $schools){
            $student_no += $schools->student_no;
        }

        //Get start-end of current week
        $startWeek = today()->startOfWeek()->format('Y-m-d');
        $endWeek = today()->endOfWeek()->format('Y-m-d');

        //Get start-end of previous week
        $prevStartWeek = today()->startOfWeek()->subWeek()->format('Y-m-d');
        $prevEndWeek = today()->endOfWeek()->subWeek()->format('Y-m-d');

        //Get start-end of previous month
        $startMonth = today()->startOfMonth()->subMonth()->format('Y-m-d');
        $endMonth = today()->endOfMonth()->subMonth()->format('Y-m-d');

        //Get first date of the year
        $startOfMonth = today()->startOfYear();
        $endOfMonth = today()->startOfYear()->endOfMonth();
        // dd($AllProject);
        //ORDERS
        //////////////////////////////////////////////////////////////////////////////////////////
        //Get total orders of current week
        $thisWeekOrders = $AllOrders->whereBetween('order_date', [$startWeek, $endWeek]);

        //Get total orders of current week
        $lastWeekOrders = $AllOrders->whereBetween('order_date', [$prevStartWeek, $prevEndWeek]);

        $graphInitial = [];

        foreach (range(1, 12) as $i) {
            $graphInitial[$i] = [];
        }

        //Get total orders of current week
        $lastMonthOrders = $AllOrders->whereBetween('order_date', [$startMonth, $endMonth]);

        $allProducts = OrderItem::with('order', 'product')->get();
        //Get the total orders in RM
        $productsByMonthRM = $allProducts->reduce(function ($acc, $item) {
            $quantity = $item->quantity;
            $price = $item->product->price;
            $productName = $item->product->name;
            $month = Carbon::parse($item->order->order_date)->month;
            if (isset($acc[$month][$productName])) {
                $acc[$month][$productName] += ($quantity*$price); // iteration
            }

            else{
                $acc[$month][$productName] = $quantity*$price;
            }
            
            return $acc;
        }, $graphInitial); // <== ini initial data which is an array of months
        //Get total orders in Unit
        $productsByMonth = $allProducts->reduce(function ($acc, $item) {
            $quantity = $item->quantity;
            $price = $item->product->price;
            $productName = $item->product->name;
            $month = Carbon::parse($item->order->order_date)->month;
            if (isset($acc[$month][$productName])) {
                $acc[$month][$productName] += $quantity; // iteration
            }
            else{
                $acc[$month][$productName] = $quantity;
            }
            return $acc;
        }, $graphInitial); // <== ini initial data which is an array of months

        //PURCHASE ORDERS
        //////////////////////////////////////////////////////////////////////////////////////////
        //Get total orders of current week
        $thisWeekPO = $AllPo->whereBetween('po_date', [$startWeek, $endWeek]);

        //Get total orders of current week
        $lastWeekPO = $AllPo->whereBetween('po_date', [$prevStartWeek, $prevEndWeek]);

        //Get total orders of current week
        $lastMonthPO = $AllPo->whereBetween('po_date', [$startMonth, $endMonth]);

        $totalPoRM = 0;
        $totalPo = 0;
        $PoRmArray = [];
        $PoArray = [];

        $totalorderRM = 0;
        $totalProfitRM = 0;
        $ProfitArray = [];
        for($i = 1; $i <= 8; $i++){
        $PoByMonth = $AllPo->whereBetween('po_date',[$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')]);
        $OrderByMonth = $AllOrders->whereBetween('order_date',[$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')]);
        if(!empty($PoByMonth) || !empty($OrderByMonth)){
            foreach($PoByMonth as $po){
                foreach($po->purchase_order_items as $item){
                    $totalPoRM = $totalPoRM + $item->quantity*$item->raw_material_supplier->price_per_unit;
                    $totalPo += 1;
                }
            }
            foreach($OrderByMonth as $order){
                foreach($order->order_item as $item){
                    $totalorderRM = $totalorderRM + $item->quantity*$item->product->price;
                }
            }
            $totalProfitRM = $totalorderRM - $totalPoRM;   
            array_push($ProfitArray, $totalProfitRM);
            array_push($PoRmArray, $totalPoRM);
            array_push($PoArray, $totalPo);
            $totalPoRM = 0;
            $totalPo = 0;
            $totalorderRM = 0;
            $totalProfitRM = 0;
        }
        else{
            array_push($PoRmArray, 0);
            array_push($PoArray, 0);
            array_push($ProfitArray, 0);
        }
        
        $startOfMonth = $startOfMonth->addMonths();
        $endOfMonth = $endOfMonth->addDays(1)->endOfMonth();
        };

        //GOOD RECEIVE NOTE
        //////////////////////////////////////////////////////////////////////////////////////////
        //Get total orders of current week
        $thisWeekGrn = $AllGrn->whereBetween('created_at', [$startWeek, $endWeek]);

        //Get total orders of current week
        $lastWeekGrn = $AllGrn->whereBetween('created_at', [$prevStartWeek, $prevEndWeek]);

        //Get total orders of current week
        $lastMonthGrn = $AllGrn->whereBetween('created_at', [$startMonth, $endMonth]);

        //WORK ORDER
        //////////////////////////////////////////////////////////////////////////////////////////
        //Get total orders of current week
        $thisWeekWo = $AllWo->whereBetween('created_at', [$startWeek, $endWeek]);

        //Get total orders of current week
        $lastWeekWo = $AllWo->whereBetween('created_at', [$prevStartWeek, $prevEndWeek]);

        //Get total orders of current week
        $lastMonthWo = $AllWo->whereBetween('created_at', [$startMonth, $endMonth]);


        $startOfMonth = $startOfMonth->startOfYear();
        $endOfMonth = $endOfMonth->startOfYear()->endOfMonth();
        $totalWo = 0;
        $totalProduction = 0;
        $WoArray = [];
        $ProductionArray = [];
        for($i = 1; $i <= 8; $i++){
        $WoByMonth = $AllWo->whereBetween('created_at',[$startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d')]);
        if(!empty($WoByMonth)){
            foreach($WoByMonth as $wo){
                $totalWo += 1;
                $totalProduction += $wo->quantity;
            }
            array_push($WoArray, $totalWo);
            array_push($ProductionArray, $totalProduction);
            $totalWo = 0;
            $totalProduction = 0;
        }
        else{
            array_push($WoArray, 0);
            array_push($ProductionArray, 0);
        }
        $startOfMonth = $startOfMonth->addMonths();
        $endOfMonth = $endOfMonth->addDays(1)->endOfMonth();
        };
        return view(
            'index.dashboard',
            compact(
                'AllOrders',
                'AllPo',
                'AllGrn',
                'AllWo',
                'AllProject',
                'startWeek',
                'endWeek',
                'prevStartWeek',
                'prevEndWeek',
                'startMonth',
                'endMonth',
                'startOfMonth',
                'endOfMonth',
                'AllProject',
                'thisWeekOrders',
                'productsByMonthRM',
                'productsByMonth',
                'thisWeekPO',
                'lastWeekPO',
                'lastMonthPO',
                'thisWeekGrn',
                'lastWeekGrn',
                'lastMonthGrn',
                'thisWeekWo',
                'lastWeekWo',
                'lastMonthWo',
                'lastWeekOrders',
                'lastMonthOrders',
                'PoRmArray',
                'PoArray',
                'ProductionArray',
                'WoArray',
                'ProfitArray',
                'AllSchools',
                'student_no'
            )
        );
    }
}
