<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage(){
        return view('Admin.pages.auth.login');
    }

    public function login(Request $request){
               $validated=$request->validate([
                'email'=>'required|email',
                'password'=>'required|string:min:4'
               ]);

               $credentials=[
                'email'=>$request->email,
                'password'=>$request->password,
               ];

               if(Auth::attempt($credentials,$request->filled('remember'))){
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
               }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}
