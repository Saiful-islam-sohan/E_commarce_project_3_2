@extends('frontend.layouts.master')
@section('frontend_content')


<div class="checkout-area ptb-100">
    <div class="container">
        <form action="{{ route('customer.placeorder') }}" method="POST">
        <div class="row">
                @csrf
                <div class="col-lg-6">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <p>Full Name *</p>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-12">
                                    <p>Phone No. *</p>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <p>District *</p>
                                    <input type="text" name="district" placeholder="Enter Your district">
                                </div>

                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address" placeholder="Enter Your Address">
                                </div>

                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="order_note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($carts as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{asset('uploads/product_photos')}}/{{$item->options->product_image}}"</td>
                                        <td>
                                            <h5><a href="product-details.html">{{$item->name}}</a></h5> <span class="product-qty">x {{$item->qty}}</span>
                                        </td>
                                        <td>${{$item->price*$item->qty }}</td>
                                    </tr>
                                    @endforeach


                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal" colspan="2">${{$total_price}}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td colspan="2"><em>Free Shipping</em></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${{$total_price}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Payment</h5>
                            </div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3">
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On Delivery</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Bkash</label>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="#" class="btn btn-fill-out btn-block mt-30">Place Order</a> --}}
                        <button type="submit"> place order</button>
                    </div>
                </div>
            </div>

        </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page Area-->
@endsection

