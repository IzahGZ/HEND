<?php

namespace App\Http\Controllers;

use App\Moq;
use App\Uom;
use App\Supplier;
use App\RawMaterial;
use App\RawMaterialSupplier;
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
        $moqs = Moq::all();

        return view('RawMaterial.create',compact('uoms', 'suppliers', 'moqs'));
    }

    public function store(Request $request)
    {
        $rawMaterial = new RawMaterial;
        $rawMaterial->name = $request->input('name');
        $rawMaterial->code = $request->input('code');
        $rawMaterial->uom = $request->input('uom');
        $rawMaterial->shelf_life = $request->input('shelf_life');
        $rawMaterial->safety_stock = $request->input('safety_stock');
        $rawMaterial->holding_cost = $request->input('holding_cost');
        $rawMaterial->category_id = 1;
        $rawMaterial->save();

        for ($i=0; $i < count($request->supplier_id); $i++) {
            
            RawMaterialSupplier::create([
                'raw_material_id' => $rawMaterial->id,
                'supplier_id' => $request->supplier_id[$i],
                'uom_id' => $request->uom_id[$i],
                'moq_id' => $request->moq_id[$i],
                'price_per_unit' => $request->price_per_unit[$i],
                'lead_time' => $request->lead_time[$i]
            ]);
        } 

        return redirect(route('rawMaterial.index'));
    }

    public function view($id)
    {
        $rawMaterial = RawMaterial::with('suppliers', 'uoms')->findOrFail($id);
        $uoms = Uom::all();
        $suppliers = Supplier::all();
        $moqs = Moq::all();
        return view('rawMaterial.view', compact('rawMaterial','uoms', 'suppliers', 'moqs'));
    }

    public function edit($id){
        $rawMaterial = RawMaterial::with('suppliers', 'uoms')->findOrFail($id);
        $uoms = Uom::all();
        $suppliers = Supplier::all();
        $moqs = Moq::all();
        return view('rawMaterial.edit', compact('rawMaterial','uoms', 'suppliers', 'moqs'));
    }

    public function update(Request $request, $id){
        $rawMaterial = RawMaterial::find($id);
        $rawMaterial->name = $request->input('name');
        $rawMaterial->code = $request->input('code');
        $rawMaterial->uom = $request->input('uom');
        $rawMaterial->shelf_life = $request->input('shelf_life');
        $rawMaterial->safety_stock = $request->input('safety_stock');
        $rawMaterial->holding_cost = $request->input('holding_cost');
        $rawMaterial->save();

        $rawMaterial->suppliers()->delete();
        if($request->supplier_id){
            foreach($request->supplier_id as $key => $supplier_id) {
                $rawMaterial->suppliers()->create([
                    'supplier_id' => $supplier_id,
                    'uom_id' => $request->uom_id[$key],
                    'moq_id' => $request->moq_id[$key],
                    'price_per_unit' => $request->price_per_unit[$key],
                    'lead_time' => $request->lead_time[$key]
                ]);
            } 
        }        

        return redirect(route('rawMaterial.index'))->with('success', 'RawMaterial updated');
    }
}
