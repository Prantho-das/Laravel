@extends('layouts.appMain')
@section('title')
Doctors-Patient
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection

@section('navbar')
    @include('include.adminNav')
@endsection

@section('main')
<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content content-narrow">
        <div class="block-header">
            <h3 class="block-title">Patient Edit</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action='{{route("patient.update",['patient'=>$pInfo->id])}}' method="POST" enctype="multipart/form-data">
                @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value='{{Request::route('id')}}'>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="title_label_style">First Name</label>
                                <input name='f_name' value='{{$pInfo->f_name}}' type="text" class="form-control input_form_style"
                                    placeholder="write">
                                @error('f_name') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="title_label_style">Last Name</label>
                                <input name='l_name' value='{{$pInfo->l_name}}' type="text" class="form-control input_form_style"
                                    placeholder="write">
                                @error('l_name') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="title_label_style">Phone No</label>
                                <input name='phone' value='{{$pInfo->phone}}' type="tel" class="form-control input_form_style"
                                    placeholder="+88">
                                @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="title_label_style">NID No</label>
                                <input name='nid' value='{{$pInfo->NID}}' type="text" class="form-control input_form_style"
                                    placeholder="Enter Your Valid NID">
                                @error('nid') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="title_label_style">Email</label>
                                <input name='email' value='{{$pInfo->email}}' type="email" class="form-control input_form_style"
                                    placeholder="write" readonly>
                                @error('email') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="title_label_style">Profile Pic</label>
                                <input value='{{$pInfo->avatar}}' type="file" id="myFile"
                                    name="avatar" class="form-control choose_file_style">
                                @error('avatar') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="col-md-2">
                                <img src="
                                @if ($pInfo->avatar)
                                {{ asset('storage/image/'.$pInfo->avatar) }}
                                @else
                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($pInfo->email)))}}
                                @endif"
                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Update</button>
                </form>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

@section('script')
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
<!-- Page JS Code -->
<script src="{{asset('assets/js/pages/halthcare_datatables.min.js')}}"></script>
{{-- @if (Session::has('msg'))
<script>
    // toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
            $('#addCasePayment').modal('show');
</script>
@endif --}}
@endsection
