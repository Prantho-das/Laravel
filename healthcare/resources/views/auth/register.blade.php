@extends('layouts.app')
@section('title')
{{ config('app.name') }} | Sign Up
@endsection
@section('body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5 p-0">
            <div class="form_main_area">
                @include('include.logo')
                <div class="signup_area">
                    <h1>Sign Up</h1>
                    <p>Medicare is a digital MediCare service for a skin disease that helps you to check your skin
                        diseases, advice, and other services accessible to all.</p>
                </div>
                @include('include.errors')
                <form class="js-validation-signin" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="py-3">
                        <div class="form-group">
                            <input name='f_name' type="text"
                                class="form-control @error('f_name') is-invalid @enderror form_control_style"
                                placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input name='l_name' type="text"
                                class="form-control form_control_style @error('l_name') is-invalid @enderror "
                                placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input name='NID' type="text"
                                class="form-control form_control_style @error('NID') is-invalid @enderror"
                                placeholder="NID no">
                        </div>
                        <div class="form-group">
                            <input name='email' type="email"
                                class="form-control form_control_style @error('email') is-invalid @enderror"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input name='phone' type="tel"
                                class="form-control form_control_style @error('phone') is-invalid @enderror"
                                placeholder="Phone No.">
                        </div>
                        <div class="form-group">
                            <input name='password' type="password"
                                class="form-control form_control_style @error('password') is-invalid @enderror"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input name='password_confirmation' type="password" class="form-control form_control_style"
                                placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn_style">Sign Up</button>
                        </div>
                    </div>
                </form>
                <div class="fotter_text">
                    <p>Already have an account? <a href="{{route('login')}}">Sign In</a></p>
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
