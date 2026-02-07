<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function index(){
        return view('admin.login');
    }

    // Authenticate admin
    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
           if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
         
            if(Auth::guard('admin')->user()->role != "admin"){
             Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'You are not authorized to access this page.');

          }
            return redirect()->route('admin.dashboard');
           }else{
            return redirect()->route('admin.login')->with('error','Either email or password is incorrect.');
           }
        }else{
            return redirect()->route('admin.login')
            ->withInput()
            ->withErrors($validator);
        }

    }

     //This method will show register page
    public function register(){
        return view('register');
    }

    public function processRegister(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'admin';
            $user->save();

            return redirect()->route('admin.login')->with('success', 'You have registed successfully.');

        }else{
            return redirect()->route('register')
            ->withInput()
            ->withErrors($validator);
        }
    }

     public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
