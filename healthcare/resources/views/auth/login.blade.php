@extends('layouts.app')
@section('title')
{{ config('app.name') }} | Login
@endsection
@section('body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5 p-0">
            <div class="form_main_area">
                <div class="logo">
                    <a class="font-w600 text-dual" href="{{url('/')}}">@include('include.logo')
                    </a>
                </div>
                <div class="welcom_area">
                    <h1>Hello <br>Welcome Back</h1>
                    <p>Medicare is a digital MediCare service for a skin disease that helps you to check your skin
                        diseases, advice, and other services accessible to all.</p>
                </div>
                @include('include.errors')
                <form class="js-validation-signin" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="py-3">
                        <div class="form-group">
                            <input name="email" type="text" class="form-control form_control_style" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control form_control_style"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='remember_me' class="ml-2">
                            <input id="remember_me" type="checkbox" name="remember">
                            Remember me
                        </label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn_style">Login</button>
                        </div>
                    </div>
                </form>
                <div class="fotter_text">
                    <p>Don't have an account? <a href="{{url('register')}}">Sign up</a> <br>
                        @if (Route::has('password.request'))
                        <a href="{{url('forgot-password')}}">Forgot password?</a></p>
                    @endif
                </div>
                <div class="copyright text-center">
                    <p>Copyright &#169; MediCare</p>
                </div>
            </div>
        </div>
        <div class="col-md-7 p-0 d-none d-lg-block d-xl-block d-sm-none ">
            <div class="bg_image_area">
                <img src="{{ asset('assets/media/login.jpg') }}" class="img-fluid" alt="bg image">
            </div>
        </div>
    </div>

</div>
@endsection
