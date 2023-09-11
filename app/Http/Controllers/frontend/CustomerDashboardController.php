<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function CustomarDasboard(){

        $user=Auth::user();
        // $order_details=OrderDetails::select('user_id')->get();

        // $user_id=User::select('id')->get();





        $ordershow=OrderDetails::select('user_id','order_id','product_qty','product_price','updated_at')->get();
        $billingshow=Billing::select(['name','phone','district','address'])->get();


        return view('frontend.pages.customerDashboard.dashboard',compact('user','ordershow','billingshow'));
    }
}
