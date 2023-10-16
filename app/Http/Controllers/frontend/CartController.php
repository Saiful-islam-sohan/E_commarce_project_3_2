<?php

namespace App\Http\Controllers\frontend;

use Cart;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\UserBalance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class CartController extends Controller
{
    public function cartPage()
    {
        $carts=Cart::content();
        $total_price=Cart::subtotal();

        //return $carts;
        return view('frontend.pages.shopping-cart',compact('carts','total_price'));
    }

    public function addTocart(Request $request)
    {
       //dd($request->all());
        $product_slug=$request->product_slug;
        $order_qty=$request->order_qty;

        $product=Product::whereSlug($product_slug)->first();

        //return $product;
        Cart::add([

            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->product_price,
            'weight'=>'0',
            'qty'=>$order_qty,
            'options'=>[
                'product_image'=>$product->product_image
            ]
        ]);

        Toastr::success('Cart Add Successfully!!');

        return back();
    }

    public function removeFromCart($cart_id)
    {
            Cart::remove($cart_id);
            Toastr::success('Cart Remove Successfully!!');

            return back();

    }


    // public function payment(Request $request)
    // {
    //     //dd($request->all());
    //        if(!Auth::check())
    //        {
    //         Toastr::error('You Must Login First!!');
    //         return redirect()->route('customerLogin.page');

    //        }
    //        //dd($request->all());

    //        $total_amount=OrderDetails::sum('product_price');

    //       //dd($total_amount);

    //        $check = Payment::where('payment_name', $request->payment_name)
    //        ->select('payment_amount')
    //        ->first();
    //       //dd($check);

    //     if($check !=null){


    //             $check_validity =  $check->validity_till > Carbon::now()->format('Y-m-d');
    //             // if coupon date is not expried
    //             if($check_validity){
    //                // check coupon discount type
    //                //new add   database
    //                UserBalance::create([
    //                 'payment_amount' =>$check,
    //                 'order_amount'=>$total_amount,
    //                 'balance'=>$check-$total_amount

    //                ]);





    //                //end the databese work





    //                 Session::put('coupon', [
    //                     'name' => $check->payment_name,
    //                     //'discount_amount' => round((Cart::subtotalFloat() * $check->discount_amount)/100),
    //                     'cart_total' => Cart::subtotal(),
    //                     'balance' => round(Cart::subtotal() - (Cart::subtotal() * $check->payment_amount)/100)
    //                 ]);
    //                 Toastr::success('Payment Successfully Applied!!');
    //                 return redirect()->back();
    //             }else{
    //                 Toastr::error('Payment Date Expire!!!', 'Info!!!');
    //                 return redirect()->back();
    //             }


    //         // else{
    //         //     Toastr::error('Insufficient Balance');
    //         //     return redirect()->route('customerDasboard.page');

    //         // }

    //         // Check coupon validity

    //     }else{
    //         Toastr::error('Invalid Action/Payment! Check, Empty Cart');
    //         return redirect()->back();
    //     }




    //}

    // public function payment(Request $request)
    // {
    //     //dd($request->all());
    //     if (!Auth::check()) {
    //         Toastr::error('You Must Login First!!');
    //         return redirect()->route('customerLogin.page');
    //     }

    //     $total_amount = OrderDetails::sum('product_price');

    //     $check = Payment::where('payment_name', $request->payment_name)
    //         ->select('payment_amount')
    //         ->first();

    //        // dd($check);
    //         if($total_amount>$check->payment_amount)
    //         {
    //             if ($check !== null) {
    //                 $amount = $check->payment_amount - $total_amount;

    //                 // Check coupon validity here if needed

    //                 // Store user balance
    //                 UserBalance::create([
    //                     'payment_amount' => $check->payment_amount,
    //                     'order_amount' => $total_amount,
    //                     'balance' => $amount,
    //                 ]);

    //                 Session::put('coupon', [
    //                     'name' => $check->payment_name,
    //                     'cart_total' => Cart::subtotal(),
    //                     'balance' => round(Cart::subtotal() - (Cart::subtotal() * $check->payment_amount) / 100),
    //                 ]);

    //                 Toastr::success('Payment Successfully Applied!!');
    //                 return redirect()->back();
    //             } else {
    //                 Toastr::error('Invalid Action/Payment! Check, Empty Cart');
    //                 return redirect()->back();
    //             }
    //         }
    //         else
    //         {
    //             Toastr::error('Insufficient Balance');
    //              return redirect()->route('customerDasboard.page');
    //         }


    // }



    // final payment option use this controller

    public function payment(Request $request)
    {
        if (!Auth::check()) {
            Toastr::error('You Must Login First!!');
            return redirect()->route('customerLogin.page');
        }

        // if (Auth::check()) {
            // Get the user ID of the currently logged-in user
            $user_id = Auth::user()->id;
            //dd($user_id);
        // }

        //dd($user_id);

        $total_amount = OrderDetails::where('user_id',$user_id)->sum('product_price');

        //dd($total_amount);

        // Check if payment_name exists before querying it
        $check = Payment::where('payment_name', $request->payment_name)->select('payment_amount')->first();

        if ($check === null) {
            Toastr::error('Invalid Action/Payment! Check, Empty Cart');
            return redirect()->back();
        }

        if ($total_amount >= $check->payment_amount) {
            Toastr::error('Insufficient Balance');
            return redirect()->route('customerDasboard.page');
        }

        $amount =$check->payment_amount-$total_amount;

        // Check coupon validity here if needed

        // Store user balance
        UserBalance::create([
            'payment_amount' => $check->payment_amount,
            'order_amount' => $total_amount,
            'balance' => $amount,
        ]);

        Session::put('coupon', [
            'name' => $check->payment_name,
            'cart_total' => Cart::subtotal(),
            'balance' => round(Cart::subtotal() - (Cart::subtotal() * $check->payment_amount) / 100),
        ]);

        Toastr::success('Payment Successfully Applied!!');
        return redirect()->back();



    }





}
