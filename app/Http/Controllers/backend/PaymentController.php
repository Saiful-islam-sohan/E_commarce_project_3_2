<?php

namespace App\Http\Controllers\backend;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $payments=Payment::latest('id')->paginate();
        return view('Admin.pages.Payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.Payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentStoreRequest $request)
    {
       // dd($request->all());
       Payment::create([
            'payment_name'=>$request->payment_name,
            'payment_amount'=>$request->payment_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_till'=>$request->validity_till

       ]);
       Toastr::success('Payment Create Successfully!!');
       return redirect()->route('payment.index');
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
        $payment=Payment::findorFail($id);
        return view('Admin.pages.Payment.edit',compact('payment'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentUpdateRequest $request, string $id)
    {
        //dd($request->all());
        $payment=Payment::findorFail($id);
        $payment->update([
            'payment_name'=>$request->payment_name,
            'payment_amount'=>$request->payment_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_till'=>$request->validity_till
        ]);
        Toastr::success('Payment update Successfully!!');
        return redirect()->route('payment.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment=Payment::find($id)->delete();
        Toastr::success('Payment Delete Successfully!!');
        return redirect()->route('payment.index');
    }
}
