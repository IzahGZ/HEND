<?php

namespace App\Http\Controllers;

use App\SystemStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SystemStatusController extends Controller
{
    public function index(){
        $systemStatus = SystemStatus::all();
        return view('SystemStatus.index', compact('systemStatus'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('systemStatus.delete',['id'=>$id]);
          return view('SystemStatus/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = SystemStatus::destroy($id);
           return redirect(route('systemStatus.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        return view('SystemStatus.create');
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

        $systemStatus = new SystemStatus;
        $systemStatus->name = $request->input('name');
        $systemStatus->description = $request->input('description');
        $systemStatus->colour = $request->input('colour');
        $systemStatus->save();

        return redirect(route('systemStatus.index'));
    }

    public function view($id)
    {
        $systemStatus = SystemStatus::find($id);

        // if (empty($customer)) {
        //     Flash::error('Customer not found');

        //     return redirect(route('customer.index'));
        // }

        return view('systemStatus.view', compact('systemStatus'));
    }

    public function edit($id){
        $systemStatus = SystemStatus::find($id);
        return view('systemStatus.edit', compact('systemStatus'));
    }

    public function update(Request $request, $id){
        $systemStatus = SystemStatus::find($id);
        $systemStatus->name = $request->input('name');
        $systemStatus->description = $request->input('description');
        $systemStatus->colour = $request->input('colour');
        $systemStatus->save();

        return redirect(route('systemStatus.index'))->with('success', 'SystemStatus updated');
    }
}
