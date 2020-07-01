<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\MrpRawMaterial;
use App\Supplier;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\RawMaterialSupplier;
use App\RequestOfPurchase;
use App\Uom;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){

        $purchaseOrders = PurchaseOrder::Orderby('po_date', 'desc')->get();
        return view('purchaseOrder.index', compact('purchaseOrders'));
    }

    public function create(){

        $suppliers = Supplier::all();
        $uoms = Uom::all();
        $company = CompanyProfile::all();
        $purchaseRequests = RequestOfPurchase::with('raw_material_supplier')
                                            ->with('raw_material')
                                            ->get();
        $raw_material_suppliers =RawMaterialSupplier::with('supplier')
                                                    ->with('moq')
                                                    ->get();

        //generate automate running number
        $twodigit1st=date('y');
        $twodigit2nd=date('m');
        
        $first_day_this_month = date('Y-m-01');
        $date_today = date('Y-m-d');

        $get_number_of_po = PurchaseOrder::whereBetween('po_date',[$first_day_this_month, $date_today])->paginate(10000);
        $total_po = $get_number_of_po->total() + 1;

        $poID = str_pad($total_po, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st.$twodigit2nd.$poID;

        return view('purchaseOrder.create',compact('suppliers', 'raw_material_suppliers', 'unique_number','date_today', 'purchaseRequests', 'uoms', 'company'));
    }

    public function store(Request $request)
    {
        $RawMaterialMrpAll = MrpRawMaterial::where('pr_id', '!=', 0)->get();
        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->po_number = $request->input('po_number');
        $purchaseOrder->po_date = $request->input('po_date');
        $purchaseOrder->delivery_address = $request->input('delivery_address');
        $purchaseOrder->supplier_id = $request->input('supplier_id');
        $purchaseOrder->purchase_by = $request->input('purchase_by');
        $purchaseOrder->save();

        for ($i=0; $i < count($request->pr_id); $i++) {
            
            PurchaseOrderItem::create([
                'po_id' => $purchaseOrder->id,
                'pr_id' => $request->pr_id[$i],
                'item_id' => $request->item_id[$i],
                'quantity' => $request->quantity[$i],
                'delivery_date' => $request->delivery_date[$i],
                'raw_material_supplier_id' => $request->raw_material_supplier_id[$i]
            ]);
        }
        for ($i=0; $i < count($request->pr_id); $i++) {
            $purchaseRequest = RequestOfPurchase::find($request->pr_id[$i]);
            $RawMaterialMrp = $RawMaterialMrpAll->where('pr_id', $purchaseRequest->id);
            if($RawMaterialMrp->isEmpty()){
                $purchaseRequest->status = 7;
                $purchaseRequest->save();
            }
            else{
                $RawMaterialMrp->first()->order_release_status = 7;
                $RawMaterialMrp->first()->save();
                $purchaseRequest->status = 7;
                $purchaseRequest->save();
            }
            
        }
        return redirect(route('purchaseOrder.index'));
    }

    public function downloadPDF($id){
        $purchaseOrders = PurchaseOrder::find($id);
        $company = CompanyProfile::all();
        // dd($company);
        return view('purchaseOrder.download',compact('purchaseOrders', 'company'));
    }
    
}
