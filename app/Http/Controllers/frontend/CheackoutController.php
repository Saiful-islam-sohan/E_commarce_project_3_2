<?php

namespace App\Http\Controllers\frontend;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OrderStoreRequest;
use App\Mail\PurchaseConfirm;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheackoutController extends Controller
{
    public function cheackoutPage()
    {

        $carts=Cart::content();
        $total_price = Cart::subtotal();
        return view('frontend.pages.cheackoutpage',compact('carts','total_price'));
    }


  public function placeOrder(Request $request)
  {
    //dd($request->all());
    $billing = Billing::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'district' => $request->district,
        'address' => $request->address,
        'order_notes' => $request->order_notes,
    ]);

    $order=Order::create([
          'user_id'=>Auth::id(),
          'billing_id'=>$billing->id,

          'discount_amount'=>Session::get('coupon')['discount_amount'] ?? 0,
          'coupon_name'=>Session::get('coupon')['name'] ?? '',

    ]);



     //Order details table data insert using cart_items helpers
     foreach (Cart::content() as $cart_item) {
        OrderDetails::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'product_id' => $cart_item->id,
            'product_qty' => $cart_item->qty,
            'product_price' => $cart_item->price,
        ]);

        // Update product table with decrement quantity
        Product::findOrFail($cart_item->id)->decrement('product_stock', $cart_item->qty);
    }
    // forceDelete from cart table
    Cart::destroy();
    Session::forget('coupon');

    $order = Order::whereId($order->id)->with(['billing', 'orderdetails'])->get();

    Mail::to($request->email)->send(new PurchaseConfirm($order));

    Toastr::success('Your Order placed successfully!!!!','Success');

    return redirect()->route('cartPage');

  }
}
