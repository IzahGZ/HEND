<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Supplier;
use App\GoodReceiveNote;
use App\GoodReceiveNoteItem;
use App\InventoryStockTransaction;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\RawMaterial;
use App\Uom;
use Illuminate\Http\Request;

class GoodReceiveNoteController extends Controller
{
    public function index(){
        $goodReceiveNotes = GoodReceiveNote::all();
        return view('goodReceiveNote.index', compact('goodReceiveNotes'));
    }

    public function create(){

        $suppliers = Supplier::all();
        $purchaseOrders = PurchaseOrder::where('status', 2)->orWhere('status', 4)->get();
        $purchaseOrderItems = PurchaseOrderItem::with('raw_material')->with('raw_material_supplier')->where('status', 2)->orWhere('status', 4)->get();
        $uoms = Uom::all();

        //generate automate running number
        $twodigit1st=date('y');
        $twodigit2nd=date('m');
        
        $first_day_this_month = date('Y-m-01');
        $date_today = date('Y-m-d');

        $get_number_of_grn = GoodReceiveNote::whereBetween('supplier_do_date',[$first_day_this_month, $date_today])->paginate(10000);
        $total_grn = $get_number_of_grn->total() + 1;
        $grnID = str_pad($total_grn, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st.$twodigit2nd.$grnID;

        return view('goodReceiveNote.create',compact('suppliers', 'unique_number','date_today', 'purchaseOrders', 'purchaseOrderItems', 'uoms'));
    }

    public function store(Request $request)
    {
        $grn = new GoodReceiveNote();
        $grn->grn_number = $request->input('grn_number');
        $grn->po_id = $request->input('po_id');
        $grn->supplier_do_number = $request->input('supplier_do_number');
        $grn->supplier_do_date = $request->input('supplier_do_date');
        $grn->receiving_area = $request->input('receiving_area');
        $grn->receive_by = $request->input('receive_by');
        $grn->save();

        for ($i=0; $i < count($request->po_item_id); $i++) {
            
            GoodReceiveNoteItem::create([
                'grn_id' => $grn->id,
                'po_item_id' => $request->po_item_id[$i],
                'order_quantity' => $request->order_quantity[$i],
                'receive_quantity' => $request->receive_quantity[$i]
            ]);

            $po_item_raw_material = PurchaseOrderItem::find($request->po_item_id[$i]);
            $raw_material = RawMaterial::find($po_item_raw_material->item_id);
            $raw_material->current_stock = $request->receive_quantity[$i]+$raw_material->current_stock;
            $raw_material->save();

            InventoryStockTransaction::create([
                'transaction_id' => 1,
                'grn_id' => $grn->id,
                'category_id' => 1,
                'item_id' => $request->po_item_id[$i],
                'wo_id' => 0,
                'transaction_by' => $grn->receive_by,
                'quantity' => $request->receive_quantity[$i]
            ]);
            
            if($po_item_raw_material->quantity == $request->receive_quantity[$i]){
                $po_item_raw_material->status = 3;
                $po_item_raw_material->save();
            }

            if($po_item_raw_material->quantity > $request->receive_quantity[$i]){
                $po_item_raw_material->status = 4;
                $po_item_raw_material->save();
            }

        }

        $po = PurchaseOrder::find($request->input('po_id'));
        $total_poi = count($po->purchase_order_items);
        $value = 0;
        $value_double = $total_poi * 2;
        foreach($po->purchase_order_items as $item){
            if($item->status == 4){
                $value++;
            }

            if($item->status == 3){
                $value = $value + 0;
            }

            if($item->status == 2){
                $value = $value + 2;
            }
        }

        if($value == 0){
            $po->status = 3;
            $po->save();
        }
        if($value == $value_double){
            $po->status = 2;
            $po->save();
        }
        if($value > 0 && $value < $value_double){
            $po->status = 4;
            $po->save();
        }

        return redirect(route('goodReceiveNote.index'));
    }

    public function downloadPDF($id){
        $goodReceiveNotes = GoodReceiveNote::find($id);
        $company = CompanyProfile::all();
        return view('goodReceiveNote.download',compact('goodReceiveNotes', 'company'));
    }
}
