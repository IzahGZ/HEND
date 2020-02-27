<?php

namespace App\Http\Controllers;

use App\Moq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class MoqController extends Controller
{
    public function index(){
        $moq = Moq::all();
        return view('moq.index', compact('moq'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('moq.delete',['id'=>$id]);
          return view('Moq/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Moq::destroy($id);
           return redirect(route('moq.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        return view('moq.create');
    }

    public function store(Request $request)
    {

        $moq = new Moq;
        $moq->name = $request->input('name');
        $moq->description = $request->input('description');
        $moq->min_quantity = $request->input('min_quantity');
        $moq->max_quantity = $request->input('max_quantity');
        $moq->save();

        return redirect(route('moq.index'));
    }

    public function view($id)
    {
        $moq = Moq::find($id);
        
        return view('moq.view', compact('moq'));
    }

    public function edit($id){
        $moq = Moq::find($id);
        return view('moq.edit', compact('moq'));
    }

    public function update(Request $request, $id){
        $moq = Moq::find($id);
        $moq->name = $request->input('name');
        $moq->description = $request->input('description');
        $moq->min_quantity = $request->input('min_quantity');
        $moq->max_quantity = $request->input('max_quantity');
        $moq->save();

        return redirect(route('moq.index'))->with('success', 'Moq updated');
    }
}
