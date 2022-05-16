@extends('layouts.app')
@section('title')
{{ config('app.name') }} | Reset Password
@endsection
@section('body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5 p-0">
            <div class="form_main_area">
                @include('include.logo')
                <div class="recover_confirm">
                    <h1>Recover your <br>Password</h1>
                </div>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form class="js-validation-signin" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="py-3">
                        <div class="form-group">
                            <input type="email" name='email' class="form-control form_control_style" placeholder="Enter Email" value="{{old('email', $request->email)}}" required autofocus readonly>
                        </div>
                        <div class="form-group">
                            <input type="password" name='password' class="form-control form_control_style" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name='password_confirmation' class="form-control form_control_style"
                                placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn_style">Confirm</button>
                        </div>
                    </div>
                </form>
                <div class="fotter_text">
                    <p><a href="{{url('forgot-password')}}" class="back_btn"><i class="fas fa-arrow-left"></i> Back</a></p>
                </div>
                <div class="copyright text-center">
                    <p>Copyright &#169; MediCare</p>
                </div>
            </div>

        </div>
        <div class="col-md-7 p-0">
            <div class="bg_image_area">
                <img src="{{asset('assets/media/login.jpg')}}" class="img-fluid" alt="bg image">
            </div>
        </div>
    </div>
</div>
@endsection
