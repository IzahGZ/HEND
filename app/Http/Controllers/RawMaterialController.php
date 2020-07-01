<?php

namespace App\Http\Controllers;

use App\Moq;
use App\Uom;
use App\Supplier;
use App\RawMaterial;
use App\CompanyProfile;
use App\Http\Requests\RawMaterialSupplierRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;

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

    public function store(RawMaterialSupplierRequest $request)
    {
        // dd($request->suppliers);
        $rawMaterial = new RawMaterial;
        $rawMaterial->name = $request->input('name');
        $rawMaterial->code = $request->input('code');
        $rawMaterial->uom = $request->input('uom');
        $rawMaterial->shelf_life = $request->input('shelf_life');
        $rawMaterial->set_up_cost = $request->input('set_up_cost');
        $rawMaterial->inventory_cost = $request->input('inventory_cost');
        $rawMaterial->category_id = 1;
        $rawMaterial->save();
        // dd("helo");
        foreach ($request->suppliers as $supp) {
            $rawMaterial->raw_material_suppliers()->attach($supp['supplier_id'], [
                'uom_id' => $supp['uom_id'],
                'price_per_unit' => $supp['price_per_unit'],
                'lead_time' => $supp['lead_time'],
                'moq_id' => $supp['moq_id'],
            ]);
        }
    
        // dump($request->suppliers);
        // dd($request->suppliers);
        return redirect()
            ->route('rawMaterial.index')
            ->with('success', 'Raw material successfully created');
    }

    public function view($id)
    {
        $rawMaterial = RawMaterial::with('suppliers', 'uoms')->findOrFail($id);
        $uoms = Uom::all();
        $suppliers = Supplier::all();
        $moqs = Moq::all();
        return view('rawMaterial.view', compact('rawMaterial','uoms', 'suppliers', 'moqs'));
    }

    public function edit( RawMaterial $rawMaterial){
        $uoms = Uom::all();
        $suppliers = Supplier::all();
        $moqs = Moq::all();
        return view('rawMaterial.edit', compact('rawMaterial','uoms', 'suppliers', 'moqs'));
    }

    public function update(RawMaterialSupplierRequest $request, RawMaterial $rawMaterial){
        // dd($request->supplier);
        DB::transaction(function() use ($request, $rawMaterial) {
            $rawMaterial->raw_material_suppliers()->detach();
            $rawMaterial->name = $request->name;
            $rawMaterial->code = $request->code;
            $rawMaterial->uom = $request->uom;
            $rawMaterial->shelf_life = $request->shelf_life;
            $rawMaterial->set_up_cost = $request->set_up_cost;
            $rawMaterial->inventory_cost = $request->inventory_cost;
            $rawMaterial->category_id = 1;
            $rawMaterial->save();
            foreach ($request->supplier as $supp) {
                $rawMaterial->raw_material_suppliers()->attach($supp['supplier_id'], [
                    'uom_id' => $supp['uom_id'],
                    'moq_id' => $supp['moq_id'],
                    'price_per_unit' => $supp['price_per_unit'],
                    'lead_time' => $supp['lead_time'],
                ]);
            }
        });   

        return redirect(route('rawMaterial.index'))->with('success', 'RawMaterial updated');
    }

    public function downloadPDF(){
        $raw_materials = RawMaterial::orderBy('name', 'asc')->get();
        $company = CompanyProfile::all();
        // dd($company);
        return view('RawMaterial.download',compact('raw_materials', 'company'));
    }
}
