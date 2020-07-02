<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('Login.index');
    }

    public function LogInstore(Request $request){

        $input = $request->all();
        // $this->validate($request, [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
        
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->where('password', $password)->get();
        // dd(isset($user));
        if(isset($user)){
            if(auth()->attempt($user_data)){
                // dd("success");
                return redirect()->intended('index');
            }
            else{
                return back()->with('error', 'Wrong Login Details');
            }
        }
        
    }

    public function destroy()
    {
        auth()->logout();
        
        return redirect()->to('/Login');
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

        $customer = new Customer;
        $customer->login_id = $user->id;
        $customer->name = $request->input('name');
        $customer->position = $request->input('position');
        $customer->student_no = $request->input('student_no');
        $customer->school = $request->input('school');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('contact_number');
        $customer->office_no = $request->input('office_number');
        $customer->save();
        auth()->login($user);

        return view('Login.index');
    }
}
