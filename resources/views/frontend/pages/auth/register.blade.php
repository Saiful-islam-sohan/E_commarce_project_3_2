@extends('frontend.layouts.master')



@section('frontend_content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Register
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Create an Account</h3>
                                    </div>
                                    <form action="{{ route('registerStore') }}" method="post">
                                        @csrf
                                        <div class="account-form form-style">
                                            <p>User Name <span class="text-danger">*</span></p>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <p>User Phone <span class="text-danger">*</span></p>
                                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
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
                                            <p>Confirm Password <span class="text-danger">*</span></p>
                                            <input type="Password" name="password_confirmation" class="form-control @error('email') is-invalid @enderror">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <button type="submit" class="btn btn-danger">Register</button>
                                            <div class="text-center mt-3">
                                                <a href="{{route('customerLogin.page')}}">Or Login</a>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-muted text-center">Already have an account? <a href="#">Sign in now</a></div>
                                </div>
                            </div>
                        </div>
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
