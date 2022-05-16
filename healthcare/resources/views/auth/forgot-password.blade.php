@extends('layouts.app')
@section('title')
{{ config('app.name') }} | Recover Password
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
                @include('include.errors')
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

                <form class="js-validation-signin" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="py-3">
                        <div class="form-group">
                            <input name="email" type="email" class="form-control form_control_style" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn_style">Next</button>
                        </div>
                    </div>
                </form>
                <div class="fotter_text">
                    <p><a href="{{url('login')}}" class="back_btn"><i class="fas fa-arrow-left"></i> Back</a></p>
                </div>
            </div>
            <div class="copyright text-center">
                <p>Copyright &#169; MediCare</p>
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
