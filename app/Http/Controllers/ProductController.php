<?php

namespace App\Http\Controllers;

use App\Uom;
use App\Product;
use App\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('Product.index', compact('product'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('product.delete',['id'=>$id]);
          return view('Product/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Product::destroy($id);
           return redirect(route('product.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){

        $uoms = Uom::all();
        return view('Product.create',compact('uoms'));
    }

    public function store(Request $request)
    {
        //To validate form
        // $this->validate($request,[
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone No.' => 'required',
        //     'address' => 'required'
        // ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->lead_time = $request->input('lead_time');
        $product->uom = $request->input('uom');
        $product->price = $request->input('price');
        $product->shelf_life = $request->input('shelf_life');
        $product->safety_stock = $request->input('safety_stock');
        $product->holding_cost = $request->input('holding_cost');
        $product->category_id = 2;
        $product->save();

        return redirect(route('product.index'));
    }

    public function view($id)
    {
        $product = Product::with('uoms')->findOrFail($id);
        $uoms = Uom::all();
        return view('product.view', compact('product','uoms'));
    }

    public function edit($id){
        $product = Product::with('uoms')->findOrFail($id);
        $uoms = Uom::all();
        return view('product.edit', compact('product','uoms'));
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->lead_time = $request->input('lead_time');
        $product->uom = $request->input('uom');
        $product->price = $request->input('price');
        $product->shelf_life = $request->input('shelf_life');
        $product->safety_stock = $request->input('safety_stock');
        $product->holding_cost = $request->input('holding_cost');
        $product->save();

        return redirect(route('product.index'))->with('success', 'Product updated');
    }

    public function downloadPDF(){
        $products = Product::orderBy('name', 'asc')->get();
        $company = CompanyProfile::all();
        // dd($company);
        return view('Product.download',compact('products', 'company'));
    }
}
