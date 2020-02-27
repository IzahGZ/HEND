<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\RawMaterial;
use App\RequestOfPurchase;
use App\RawMaterialSupplier;
use Illuminate\Http\Request;

class RequestOfPurchaseController extends Controller
{
    public function index(){
        $rop = RequestOfPurchase::orderBy('pr_number', 'desc')->get();
        return view('requestOfPurchase.index', compact('rop'));
    }

    public function create(){

        $raw_materials = RawMaterial::all();
        $suppliers = Supplier::all();
        $raw_material_suppliers = RawMaterialSupplier::with('supplier')
                                                    ->with('moq')
                                                    ->get();

        //generate automate running number
        $twodigit1st=date('y');
        $twodigit2nd=date('m');
        
        $first_day_this_month = date('Y-m-01');
        $date_today = date('Y-m-d');

        $get_number_of_pr = RequestOfPurchase::whereBetween('request_date',[$first_day_this_month, $date_today])->paginate(10000);
        $total_pr = $get_number_of_pr->total() + 1;

        $prID = str_pad($total_pr, 4, '0', STR_PAD_LEFT);

        $unique_number = $twodigit1st.$twodigit2nd.$prID;

        return view('requestOfPurchase.create',compact('raw_materials', 'suppliers', 'raw_material_suppliers', 'unique_number','date_today'));
    }

    public function store(Request $request)
    {
        $rop = new RequestOfPurchase;
        $rop->pr_number = $request->input('pr_number');
        $rop->item_id = $request->input('item_id');
        $rop->raw_material_supplier_id = $request->input('raw_material_supplier_id');
        $rop->quantity = $request->input('quantity');
        $rop->estimated_date = $request->input('estimated_date');
        $rop->request_date = $request->input('request_date');
        $rop->status = $request->input('status');
        $rop->request_by = $request->input('request_by');
        $rop->save();

        return redirect(route('requestOfPurchase.index'));
    }

    public function edit($id){
        
        $purchaseRequest = RequestOfPurchase::find($id);
        $raw_materials = RawMaterial::all();
        $suppliers = Supplier::all();
        $raw_material_suppliers =RawMaterialSupplier::where('raw_material_id', 'LIKE', '%'.$purchaseRequest->item_id.'%')->get();
        $raw_material_suppliers_all = RawMaterialSupplier::with('supplier')
                                    ->with('moq')
                                    ->get();
        return view('requestOfPurchase.edit', compact('purchaseRequest', 'raw_materials', 'suppliers', 'raw_material_suppliers', 'raw_material_suppliers_all'));
    }

    public function update(Request $request, $id){
        $rop = RequestOfPurchase::find($id);
        $rop->pr_number = $request->input('pr_number');
        $rop->item_id = $request->input('item_id');
        $rop->raw_material_supplier_id = $request->input('raw_material_supplier_id');
        $rop->quantity = $request->input('quantity');
        $rop->estimated_date = $request->input('estimated_date');
        $rop->request_date = $request->input('request_date');
        $rop->save();

        return redirect(route('requestOfPurchase.index'))->with('success', 'Purchase request updated');
    }

    public function downloadPDF($id){
        $rop = RequestOfPurchase::find($id);
        return view('requestOfPurchase.download',compact('rop'));
    }
}
