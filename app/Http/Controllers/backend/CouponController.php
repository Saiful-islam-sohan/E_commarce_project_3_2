<?php

namespace App\Http\Controllers\backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CouponStorerequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons=Coupon::latest('id')->paginate();
        return view('Admin.pages.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('Admin.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStorerequest $request)
    {
        // dd($request->all());

        Coupon::create([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_till'=>$request->validity_till

        ]);

        Toastr::success('Coupon Create Successfully!!');
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon=Coupon::findorFail($id);
        return view('Admin.pages.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $coupon=Coupon::findorFail($id);
        $coupon->update([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_till'=>$request->validity_till
        ]);
        Toastr::success('Coupon update Successfully!!');
        return redirect()->route('coupons.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
