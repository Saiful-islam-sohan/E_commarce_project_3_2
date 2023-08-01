<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function CustomarDasboard(){

        $user=Auth::user();
        return view('frontend.pages.customerDashboard.dashboard',compact('user'));
    }
}
