<?php

namespace App\Http\Controllers;

use App\Bom;
use Illuminate\Http\Request;

class BomController extends Controller
{
    public function index(){
        $boms = Bom::all();
        return view('Bom.index', compact('boms'));
    }

    // public function getModalDelete($id = null)
    //   {
    //       $error = '';
    //       $model = '';
    //       $confirm_route =  route('product.delete',['id'=>$id]);
    //       return view('Product/modal_confirmation', compact('error','model', 'confirm_route'));

    //   }

    //    public function getDelete($id = null)
    //    {
    //        $delete = Product::destroy($id);
    //        return redirect(route('product.index'))->with('success', Lang::get('message.success.delete'));

    //    }

    //    public function create(){

    //     $uoms = Uom::all();
    //     return view('Product.create',compact('uoms'));
    // }

    // public function store(Request $request)
    // {
    //     //To validate form
    //     // $this->validate($request,[
    //     //     'name' => 'required',
    //     //     'email' => 'required',
    //     //     'phone No.' => 'required',
    //     //     'address' => 'required'
    //     // ]);

    //     $product = new Product;
    //     $product->name = $request->input('name');
    //     $product->code = $request->input('code');
    //     $product->lead_time = $request->input('lead_time');
    //     $product->uom = $request->input('uom');
    //     $product->price = $request->input('price');
    //     $product->shelf_life = $request->input('shelf_life');
    //     $product->safety_stock = $request->input('safety_stock');
    //     $product->holding_cost = $request->input('holding_cost');
    //     $product->save();

    //     return redirect(route('product.index'));
    // }

    public function view($id)
    {
        $bom = Bom::findOrFail($id);
        return view('Bom.view', compact('bom'));
    }

    // public function edit($id){
    //     $product = Product::with('uoms')->findOrFail($id);
    //     $uoms = Uom::all();
    //     return view('product.edit', compact('product','uoms'));
    // }

    // public function update(Request $request, $id){
    //     $product = Product::find($id);
    //     $product->name = $request->input('name');
    //     $product->code = $request->input('code');
    //     $product->lead_time = $request->input('lead_time');
    //     $product->uom = $request->input('uom');
    //     $product->price = $request->input('price');
    //     $product->shelf_life = $request->input('shelf_life');
    //     $product->safety_stock = $request->input('safety_stock');
    //     $product->holding_cost = $request->input('holding_cost');
    //     $product->save();

    //     return redirect(route('product.index'))->with('success', 'Product updated');
    // }
}
