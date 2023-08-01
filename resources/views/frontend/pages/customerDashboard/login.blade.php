@extends('frontend.layouts.master')

@section('frontend_content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Login
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Login</h3>
                                    </div>
                                    <form action="{{route('customerLoginStore')}}" method="post">
                                        @csrf
                                        <div class="account-form form-style">


                                            <p>User Email Address <span class="text-danger">*</span></p>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <p>Password <span class="text-danger">*</span></p>
                                            <input type="Password" name="password" class="form-control @error('email') is-invalid @enderror">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                           <img src="{{asset('user')}}/assets/imgs/login.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
