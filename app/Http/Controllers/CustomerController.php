<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::all();
        return view('Customer.index', compact('customer'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('customer.delete',['id'=>$id]);
          return view('Customer/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Customer::destroy($id);
           return redirect(route('customer.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        return view('Customer.create');
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

        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->save();

        return redirect(route('customer.index'));
    }

    public function view($id)
    {
        $customer = Customer::find($id);

        // if (empty($customer)) {
        //     Flash::error('Customer not found');

        //     return redirect(route('customer.index'));
        // }

        return view('customer.view', compact('customer'));
    }

    public function edit($id){
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id){
        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->save();

        return redirect(route('customer.index'))->with('success', 'Customer updated');
    }
}
