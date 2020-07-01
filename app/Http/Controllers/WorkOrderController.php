<?php

namespace App\Http\Controllers;

use App\mrp;
use App\WorkOrder;
use App\CompanyProfile;
use App\InventoryStockTransaction;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class WorkOrderController extends Controller
{
    public function index(){
        $workOrders = WorkOrder::orderBy('created_at', 'desc')->get();
        return view('workOrder.index', compact('workOrders'));
    }

    public function getModalWO($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('workOrder.wo',['id'=>$id]);
          return view('workOrder/modal_confirmation', compact('error','model', 'confirm_route'));

      }

    public function getWO($id = null)
    {
        //generate automate running number
        $twodigit1st=date('y');
        $twodigit2nd=date('m');
        
        $first_day_this_month = date('Y-m-01');
        $currentDate = strtotime(date('Y-m-d'));
        $date_today = date("Y-m-d", strtotime("+1 day", $currentDate));

        $get_number_of_wo = WorkOrder::whereBetween('created_at',[$first_day_this_month, $date_today])->paginate(10000);
        $total_wo = $get_number_of_wo->total() + 1;
        $woID = str_pad($total_wo, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st.$twodigit2nd.$woID;
        $mrp = mrp::find($id);

        $WorkOrder = new WorkOrder();
        $WorkOrder->work_order_no = $unique_number;
        $WorkOrder->item_id = $mrp->product_id;
        $WorkOrder->mrp_id = $id;
        $WorkOrder->quantity = $mrp->order_release;
        $WorkOrder->due_date = $mrp->date;
        $WorkOrder->status = 2;
        $mrp->wo_status = 8;
        $mrp->save();
        $create = $WorkOrder->save();

        return redirect(route('mrp.index'))->with('success', Lang::get('message.success.create'));

    }

    public function downloadPDF($id){
        $workOrders = WorkOrder::find($id);
        $company = CompanyProfile::all();
        // dd($company);
        return view('workOrder.download',compact('workOrders', 'company'));
    }

    public function downloadProcessTravellerPDF($id){
        $workOrders = WorkOrder::find($id);
        $company = CompanyProfile::all();
        // dd($company);
        return view('workOrder.downloadProcessTravellerPDF',compact('workOrders', 'company'));
    }

    public function getModalProduction($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('workOrder.production',['id'=>$id]);
          return view('workOrder/modal_confirmation', compact('error','model', 'confirm_route'));

      }

      public function getProduction($id = null)
    {
        $wo = WorkOrder::find($id);
        $wo->status = 12;
        $mrp = mrp::find($wo->mrp_id);
        $mrp->wo_status = 12;
        
        foreach($wo->project->materials as $item){
            $inventoryStockTransaction = new InventoryStockTransaction();
            $inventoryStockTransaction->transaction_id = 2;
            $inventoryStockTransaction->grn_id = 0;
            $inventoryStockTransaction->wo_id = $id;
            $inventoryStockTransaction->transaction_by = "Izah Atirah";
            $inventoryStockTransaction->quantity = $item->pivot->quantity * $wo->quantity;
            $inventoryStockTransaction->category_id = 1;
            $inventoryStockTransaction->item_id = $item->pivot->raw_material_id;

            $item->current_stock = $item->current_stock - $item->pivot->quantity * $wo->quantity;
            $item->save();
            $inventoryStockTransaction->save();
        }

        $wo->save();
        $mrp->save();
        
        return redirect(route('workOrder.index'));
    }

    public function finishGoodProductionCreate(){
        $workOrders = WorkOrder::where('status', 12)->get();
        return view('FinishGoodProduction.create',compact('workOrders'));
    }

    public function finishGoodProductionStore(Request $request){
        $inventoryStockTransaction = new InventoryStockTransaction();
        $inventoryStockTransaction->transaction_id = 1;
        $inventoryStockTransaction->grn_id = 0;
        $inventoryStockTransaction->wo_id = $request->wo_id;
        $inventoryStockTransaction->transaction_by = "Izah Atirah";
        $inventoryStockTransaction->quantity = $request->production_quantity;
        $inventoryStockTransaction->category_id = 2;
        $inventoryStockTransaction->item_id = $request->item_id;
        $inventoryStockTransaction->save();

        $products = Product::find($request->item_id);
        $products->current_stock = $products->current_stock + $request->production_quantity;
        $products->save();

        $wo = WorkOrder::find( $request->wo_id);
        $wo->status = 11;
        $wo->save();

        $mrp = mrp::find($wo->mrp_id);
        $mrp->wo_status = 11;
        $mrp->save();

        return redirect(route('workOrder.index'));
    }
}
