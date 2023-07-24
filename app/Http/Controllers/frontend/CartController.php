<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

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

        return back();
    }
}
