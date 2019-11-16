<?php

namespace App\Http\Controllers;

use App\Uom;
use App\RawMaterial;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class RawMaterialController extends Controller
{
    public function index(){
        $rawMaterial = RawMaterial::all();
        return view('RawMaterial.index', compact('rawMaterial'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('rawMaterial.delete',['id'=>$id]);
          return view('RawMaterial/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = RawMaterial::destroy($id);
           return redirect(route('rawMaterial.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){

        $uoms = Uom::all();
        $suppliers = Supplier::all();
        return view('RawMaterial.create',compact('uoms', 'suppliers'));
    }

    public function store(Request $request)
    {
        $rawMaterial = new RawMaterial;
        $rawMaterial->name = $request->input('name');
        $rawMaterial->code = $request->input('code');
        $rawMaterial->supplier = $request->input('supplier');
        $rawMaterial->lead_time = $request->input('lead_time');
        $rawMaterial->uom = $request->input('uom');
        $rawMaterial->price = $request->input('price');
        $rawMaterial->shelf_life = $request->input('shelf_life');
        $rawMaterial->safety_stock = $request->input('safety_stock');
        $rawMaterial->holding_cost = $request->input('holding_cost');
        $rawMaterial->save();

        return redirect(route('rawMaterial.index'));
    }

    public function view($id)
    {
        $rawMaterial = RawMaterial::with('suppliers', 'uoms')->findOrFail($id);
        $uoms = Uom::all();
        $suppliers = Supplier::all();
        return view('rawMaterial.view', compact('rawMaterial','uoms', 'suppliers'));
    }

    public function edit($id){
        $rawMaterial = RawMaterial::with('suppliers', 'uoms')->findOrFail($id);
        $uoms = Uom::all();
        $suppliers = Supplier::all();
        return view('rawMaterial.edit', compact('rawMaterial','uoms', 'suppliers'));
    }

    public function update(Request $request, $id){
        $rawMaterial = RawMaterial::find($id);
        $rawMaterial->name = $request->input('name');
        $rawMaterial->code = $request->input('code');
        $rawMaterial->supplier = $request->input('supplier');
        $rawMaterial->lead_time = $request->input('lead_time');
        $rawMaterial->uom = $request->input('uom');
        $rawMaterial->price = $request->input('price');
        $rawMaterial->shelf_life = $request->input('shelf_life');
        $rawMaterial->safety_stock = $request->input('safety_stock');
        $rawMaterial->holding_cost = $request->input('holding_cost');
        $rawMaterial->save();

        return redirect(route('rawMaterial.index'))->with('success', 'RawMaterial updated');
    }
}
