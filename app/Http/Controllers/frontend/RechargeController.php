<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\UserPaymentRequest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\RechargeRequest;
use App\Models\Payment;

class RechargeController extends Controller
{
    public function recharge() {
         return view('frontend.pages.payment.recharge');
    }

    public function RechargeStore(RechargeRequest $request) {
        //dd($request->all());

        UserPaymentRequest::create([
                  'request_amount' =>$request->request_amount,
        ]);
        Toastr::success('Request For Payment Recharge!!!!');
        return redirect()->route('customerDasboard.page');
     }

     public function FindToken()
     {
        $firstRequest = UserPaymentRequest::latest('id')->select('request_amount')->first();
        //dd($firstRequest);

        if ($firstRequest) {
            $requestAmount = $firstRequest->request_amount;

            // Now, you can use $requestAmount to retrieve records from the Payment table
            $payment = Payment::where('payment_amount', $requestAmount)->get();

            //dd($payments);
            return view('frontend.pages.payment.show',compact('payment'));

            // Use $payments as needed
        }
        else {
            // Toastr::error('Same Amount Card is not aviable!!!!');

        }


        //eturn $firstRequest;
       //return view('frontend.pages.payment.recharge',compact('payment'));

       //return view('frontend.pages.payment.show',compact('payment'));

     }


}
