@extends('layouts.appMain')
@section('title')
MediCare | Help
@endsection

@section('navbar')
    @if (Auth::user()->role==="PATIENT")
        @include('include.patientNav')
    @elseif(Auth::user()->role==="DOCTOR")
        @include('include.doctorNav')
    @endif
@endsection
@section('main')
<main id="main-container">
    <div class="content content-narrow pt-5">
        <div class="block-header">
            <h3 class="block-title">Contact</h3>
        </div>
        <form class="row" method="POST" action='{{route("help.store")}}'>
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Full Name</label>
                <input value="{{old('name')?old('name'):''}}" type="text" name="name" class="form-control" id="inputEmail4">
                @error('name')
                <h6 class='text-danger mt-1'>{{$message}}</h6>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input value="{{old('email')?old('email'):''}}" type="email" name="email" class="form-control"
                    id="inputEmail4">
                @error('email')
                <h6 class='text-danger mt-1'>{{$message}}</h6>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="inputPassword4" class="form-label">Subject</label>
                <input value="{{old('subject')?old('subject'):''}}" type="text" name="subject" class="form-control"
                    id="inputPassword4">
                @error('subject')
                <h6 class='text-danger mt-1'>{{$message}}</h6>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-floating">
                    <label for="floatingTextarea2">Message</label>
                    <textarea class="form-control" name='message' placeholder="Leave a comment here" id="floatingTextarea2"
                        style="height: 100px"></textarea>
                    @error('message')
                    <h6 class='text-danger mt-1'>{{$message}}</h6>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</div>
@endsection
{{-- @if (Session::has('msg'))
@section('script')
<script>
    toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
</script>
@endsection
@endif --}}
