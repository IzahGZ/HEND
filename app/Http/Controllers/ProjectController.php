<?php

namespace App\Http\Controllers;

use App\Process;
use App\Product;
use App\Project;
use App\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ProjectController extends Controller
{
    public function index(){
        $project = Project::all();
        return view('Project.index', compact('project'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('project.delete',['id'=>$id]);
          return view('Project/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Project::destroy($id);
           return redirect(route('project.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        $products = Product::all();
        $rawMaterials = RawMaterial::all();
        $process = Process::all();
        return view('Project.create', compact('products', 'rawMaterials', 'process'));
    }

    public function store(Request $request)
    {
        $project = new Project;
        $project->code = $request->input('code');
        $project->product_id = $request->input('product_id');
        $project->save();

        return redirect(route('project.index'));
    }

    public function view($id)
    {
        $project = Project::with('products')->findOrFail($id);
        $products =Product::all();
        return view('project.view', compact('products'));
    }

    public function edit($id){
        // $rawMaterial = RawMaterial::with('suppliers', 'uoms')->findOrFail($id);
        // $uoms = Uom::all();
        // $suppliers = Supplier::all();
        // return view('rawMaterial.edit', compact('rawMaterial','uoms', 'suppliers'));
    }

    public function update(Request $request, $id){
        // $rawMaterial = RawMaterial::find($id);
        // $rawMaterial->name = $request->input('name');
        // $rawMaterial->code = $request->input('code');
        // $rawMaterial->supplier = $request->input('supplier');
        // $rawMaterial->lead_time = $request->input('lead_time');
        // $rawMaterial->uom = $request->input('uom');
        // $rawMaterial->price = $request->input('price');
        // $rawMaterial->shelf_life = $request->input('shelf_life');
        // $rawMaterial->safety_stock = $request->input('safety_stock');
        // $rawMaterial->holding_cost = $request->input('holding_cost');
        // $rawMaterial->save();

        // return redirect(route('rawMaterial.index'))->with('success', 'RawMaterial updated');
    }
}
