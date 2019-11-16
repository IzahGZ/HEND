<?php

namespace App\Http\Controllers;

use App\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class UomController extends Controller
{
    public function index(){
        $uom = Uom::all();
        return view('Uom.index', compact('uom'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('uom.delete',['id'=>$id]);
          return view('Uom/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Uom::destroy($id);
           return redirect(route('uom.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        return view('Uom.create');
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

        $uom = new Uom;
        $uom->code = $request->input('code');
        $uom->name = $request->input('name');
        $uom->save();

        return redirect(route('uom.index'));
    }

    public function view($id)
    {
        $uom = Uom::find($id);

        // if (empty($customer)) {
        //     Flash::error('Customer not found');

        //     return redirect(route('customer.index'));
        // }

        return view('uom.view', compact('uom'));
    }

    public function edit($id){
        $uom = Uom::find($id);
        return view('uom.edit', compact('uom'));
    }

    public function update(Request $request, $id){
        $uom = Uom::find($id);
        $uom->code = $request->input('code');
        $uom->name = $request->input('name');
        $uom->save();

        return redirect(route('uom.index'))->with('success', 'Uom updated');
    }
}
