<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $users = User::all();
        return view('User.index', compact('users'));
    }

    function create(){
        $user_types = UserType::all();
        return view('User.create', compact('user_types'));
    }

    public function store(Request $request){
        $users = User::all();
        $duplicate = $users->where('email',$request->input('email'));
        if(count($duplicate) == 0){
            $default_password = "hend_".$request->input('email');
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $default_password;
            $user->user_type = $request->input('user_type');
            $user->save();

            return redirect(route('user.index'));
        }

        else{
            return back()->with('error','Email is already used!');

        }
        
    }

    public function getModalReset($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('user.reset',['id'=>$id]);
          return view('User/modal_confirmation', compact('error','model', 'confirm_route'));

      }

    public function getReset($id = null)
    {
        $user = User::find($id);
        $default_password = "hend_".$user->email;
        $user->password = $default_password;
        $user->save();
        return redirect(route('user.index'))->with('success', 'Successfully changed password to default');

    }
}
