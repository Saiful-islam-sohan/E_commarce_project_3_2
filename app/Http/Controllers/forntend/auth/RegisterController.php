<?php

namespace App\Http\Controllers\forntend\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterStoreRequest;

class RegisterController extends Controller
{
    public function RegisterPage()
    {
        return view('frontend.pages.auth.register');
    }
    public function RegisterStore(RegisterStoreRequest $request)
    {
        // dd($request->all());
        $user=User::create([
              'name'=>$request->name,
              'phone'=>$request->phone,
              'email'=>$request->email,
              'password'=>Hash::make($request->password)
        ]);
        $credentials =([
            'email'=>$request->email,
            'password' =>$request->password,
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('customerDasboard.page');
        }


    }
    public function loginPage()
    {
        return view('frontend.pages.customerDashboard.login');
    }
    public function loginStore(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $credentials =([
            'email'=>$request->email,
            'password' =>$request->password,
        ]);

        if (Auth::attempt($credentials,$request->filled('remember'))){
            $request->session()->regenerate();

            return redirect()->route('customerDasboard.page');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {

    Auth::logout();

    $request->session()->invalidate();
    return redirect()->route('customerLogin.page');
    }

}
