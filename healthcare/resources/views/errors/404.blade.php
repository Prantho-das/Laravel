@extends('layouts.app')
@section('title')
404 Error
@endsection
@section('body')
<!-- Error Content -->
<section class="error  push-100-t">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="error-content">
                    <img src="{{ asset('assets/media/images/404/opps.svg') }}" class="img-fluid w-60" alt="Opps Image">
                    <h3 class="push-30-t">We can’t seem to find a page you are looking for...</h3>
                    <a href="#" class="btn btn-h push-50-t">Back to Home</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="error-thumb">
                    <img src="{{ asset('assets/media/images/404/404.svg') }}" class="img-fluid w-100" alt="404 Image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END Error Content -->
@endsection
