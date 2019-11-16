<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SupplierController extends Controller
{
    public function index(){
        $supplier = Supplier::all();
        return view('Supplier.index', compact('supplier'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('supplier.delete',['id'=>$id]);
          return view('Supplier/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Supplier::destroy($id);
           return redirect(route('supplier.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        return view('Supplier.create');
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

        $supplier = new Supplier;
        $supplier->name = $request->input('name');
        $supplier->email = $request->input('email');
        $supplier->phone = $request->input('phone');
        $supplier->address = $request->input('address');
        $supplier->save();

        return redirect(route('supplier.index'));
    }

    public function view($id)
    {
        $supplier = Supplier::find($id);

        // if (empty($customer)) {
        //     Flash::error('Customer not found');

        //     return redirect(route('customer.index'));
        // }

        return view('supplier.view', compact('supplier'));
    }

    public function edit($id){
        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id){
        $supplier = Supplier::find($id);
        $supplier->name = $request->input('name');
        $supplier->email = $request->input('email');
        $supplier->phone = $request->input('phone');
        $supplier->address = $request->input('address');
        $supplier->save();

        return redirect(route('supplier.index'))->with('success', 'Supplier updated');
    }
}
