<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('Login.index');
    }

    public function register(){
        return view('Login.register');
    }

    public function storeRegistration(Request $request){
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        
        // return view('Login.register');
    }
}
