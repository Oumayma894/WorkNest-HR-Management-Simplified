<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show login page
    public function index() {
        return view('login');
    }

    // Authenticate user
   public function authenticate(Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect()->route('signin')
            ->withInput()
            ->withErrors($validator);
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();

        // Check if the logged in user has the 'employee' role
        if ($user->role === 'employee') {
            return redirect()->route('employee.employeedash');
        } else {
            Auth::logout(); // Log the user out if not employee
            return redirect()->route('login')
                ->withErrors(['email' => 'Only employees are allowed to log in here.']);
        }
    }

    return redirect()->route('login')
        ->withErrors(['email' => 'Either email or password is incorrect.']);
}



    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
