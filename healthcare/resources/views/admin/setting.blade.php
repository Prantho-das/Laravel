@extends('layouts.appMain')
@section('title')
Admin-Case
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
            <h3 class="block-title">Website Settings</h3>
        </div>
        <!-- Dynamic Table Full -->
        @php
        $user=Auth::user()
        @endphp
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pEdit">Front End
                            Setting</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id='pEdit'>
                        <form action='{{route('setting.update',['setting'=>1])}}' method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class='row'>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                                        <input type="text"
                                            class="form-control {{$setting->title?'is-valid':'is-invalid'}}"
                                            name='title' value='{{$setting->title?$setting->title:"Record Not Found!"}}'
                                            id="exampleFormControlInput1" placeholder="Title">
                                        @error('title') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Logo</label>
                                        <input type="file"
                                            class="form-control {{$setting->logo?'is-valid':'is-invalid'}}" name='logo'
                                            value='{{$setting->logo?$setting->logo:"Record Not Found!"}}'
                                            id="exampleFormControlInput1" placeholder="Logo">
                                        @error('logo') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control {{$setting->email?'is-valid':'is-invalid'}}"
                                            name='email' value='{{$setting->email?$setting->email:"Record Not Found!"}}'
                                            id="exampleFormControlInput1" placeholder="email">
                                        @error('email') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleFormControlInput1" class="form-label">Contact</label>
                                            <div class="mb-3">
                                                <input type="contact" type="tel"
                                                    class="form-control {{$setting->contact?'is-valid':'is-invalid'}}"
                                                    name='contact[]'
                                                    value='{{$setting->contact[0]?$setting->contact[0]:"Record Not Found!"}}'
                                                    id="exampleFormControlInput1" placeholder="First Number">
                                                @error('contact') <span
                                                    class="error text-danger">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="contact" type="tel"
                                                    class="form-control {{$setting->contact?'is-valid':'is-invalid'}}"
                                                    name='contact[]'
                                                    value='{{$setting->contact[1]?$setting->contact[1]:"Record Not Found!"}}'
                                                    id="exampleFormControlInput1" placeholder="Second Number">
                                                @error('contact') <span
                                                    class="error text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <textarea class="form-control {{$setting->address?'is-valid':'is-invalid'}}" name="address" id=""
                                                rows="3">{{$setting->address?$setting->address:"Please Fill Up"}}</textarea>
                                        </div>
                                        @error('address') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-group inputDynamic">
                                            <label for="">Social</label>
                                            @forelse ($setting->social as $item)
                                            <input type="url" class="form-control mb-3 {{$item?'is-valid':'is-invalid'}}"
                                                name='social[]' value='{{$item?$item:"Record Not Found!"}}'
                                                placeholder="Social">
                                            @empty
                                            @endforelse
                                                <i class="fa fa-plus btn btn-sm btn-primary my-2 newField" aria-hidden="true"></i>
                                        </div>
                                        @error('social') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="css-input switch switch-sm switch-primary">
                                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                            <input type="checkbox" id="login1-remember-me" name="covidNews" {{$setting->covidNews=='on'?'checked':''}}>
                                            <span>
                                                Covid Status
                                            </span>
                                        </label>
                                        @error('covidNews') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-group">
                                          <label for="">Reassign Day</label>
                                          <input type="number" min='1' value='{{$setting->reassignDay?$setting->reassignDay:1}}'
                                            class="form-control" name="reassignDay" id="" aria-describedby="helpId" placeholder="Reassign Day">
                                        </div>
                                        @error('reassignDay') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class='btn btn-outline-info'>Update</button>
                        </form>
                    </div>
                </div>
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
<script>
    $(document).ready(function () {
        $('.newField').click(function(){
            $('.inputDynamic').append(`<input type="url" class="form-control mb-3 {{$item?'is-valid':'is-invalid'}}" name='social[]'
                value='' placeholder="Social Link">`);
        })
    });
</script>
@endsection
