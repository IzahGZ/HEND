<?php

namespace App\Http\Controllers;

use App\Bom;
use App\Order;
use App\Product;
use App\Project;
use App\Customer;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $order = Order::all();
        
        return view('Order.index', compact('order'));
    }

    public function create(){
        $customer = Customer::all();
        $product = Product::all();
        $project = Project::all();

        //generate automate running number
        $twodigit1st=date('y');
        $twodigit2nd=date('m');
        
        $first_day_this_month = date('m-01-Y');
        $date_today = date('d/m/Y');

        $get_number_of_order = Order::whereBetween('order_date',[$first_day_this_month, $date_today])->paginate(10000);
        $total_orders = $get_number_of_order->total() + 1;

        $orderID = str_pad($total_orders, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st.$twodigit2nd.$orderID;
    return view('Order.create', compact('customer', 'product', 'date_today', 'unique_number', 'project'));
    }

    public function store(Request $request)
    {
        $Order = new Order;
        $Order->order_number = $request->input('order_number');
        $Order->customer_id = $request->input('cust_id');
        $Order->order_date = $request->input('order_date');
        $Order->delivery_date = $request->input('delivery_date');
        $Order->save();

        for ($i=0; $i < count($request->product_id); $i++) {
    
            //generate automate running number
            $twodigit1st=date('y');
            $twodigit2nd=date('m');
            
            $first_day_this_month = date('Y-m-01');
            $date_today = date("Y-m-d", time() + 86400);

            $get_number_of_bom = Bom::whereBetween('created_at',[$first_day_this_month, $date_today])->paginate(10000);
            $total_boms = $get_number_of_bom->total() + 1;
            // dd($total_boms);
            $orderID = str_pad($total_boms, 4, '0', STR_PAD_LEFT);

            $unique_number = $twodigit1st.$twodigit2nd.$orderID;

            OrderItem::create([
                'order_id' => $Order->id,
                'item_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i]
            ]);

            $project = Project::where('product_id', $request->product_id[$i])->first();
            // dd($project->id);
            Bom::create([
                'order_id' => $Order->id,
                'bom_number' => $unique_number,
                'project_id' => $project->id,
                'quantity' => $request->quantity[$i]
            ]);
        }  

        return redirect(route('order.index'));
    }

    public function downloadPDF($id){
        $orders = Order::find($id);
        return view('Order.download',compact('orders'));
    }
}
