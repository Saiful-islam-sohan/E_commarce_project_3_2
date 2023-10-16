@extends('frontend.layouts.master')

@push('')

@endpush

@section('frontend_content')

<h3 style="diplay:flex;justify-content:center;color:tomato ;margin-left:300px; margin-bottom:25px">rechage amount and  code generate</h3>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <form action="{{route('RechargeStore')}}" method="post">
                @csrf
                <input type="text" name="request_amount" placeholder="Payment Request For admin" class="form-control">
                <button type="submit" class="submit submit-auto-width" style="margin-top: 20px">Request</button>
            </form>
        </div>
    </div>
</div>




@endsection
