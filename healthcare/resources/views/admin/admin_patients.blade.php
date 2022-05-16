@extends('layouts.appMain')
@section('title')
Doctors-Admin
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
            <h3 class="block-title">Patients</h3>
            <button type="button" class="add_btn_style" data-toggle="modal" data-target="#exampleModal">Add
                Patients</button>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>User ID</th>
                            <th>Total Cases</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patient as $item)
                        <tr>
                            <td class="text-center" style="color:{{$item->status===0?"red !important;":""}}">{{$loop->iteration}}</td>
                            <td><img src="@if ($item->avatar)
                                {{asset('storage/image/'.$item->avatar)}}
                                @else
                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->email)))}}
                                @endif" class="rounded-circle m-r-15" style="width: 40px;height:40px;"
                                    alt="{{$item->f_name}}-profile-image"><span><a
                                        style="color:{{$item->status===0?"red":""}}" href='{{url('user_profile/'.$item->u_id)}}'>{{$item->f_name." ".$item->l_name}}</a></span>
                            </td>

                            <td class="text-center" style="color:{{$item->status===0?"red":""}}">{{$item->email}}</td>
                            <td class="text-center" style="color:{{$item->status===0?"red":""}}">{{$item->phone?"+88".$item->phone:"N/A"}}</td>
                            <td class="text-center" style="color:{{$item->status===0?"red":""}}"><a style="color:{{$item->status===0?"red":""}}" href='{{url('user_profile/'.$item->u_id)}}'>{{$item->u_id}}</a>
                            </td>
                            <td class="text-center" style="color:{{$item->status===0?"red":""}}">{{count($item->patientCaseNumber)}}</td>
                            <td class="text-center" style="color:{{$item->status===0?"red":""}}">
                                <a href="{{url('admin/patient/'.encrypt($item->id).'/edit')}}" data-toggle="tooltip"
                                    data-placement="left" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt mr-2"></i>
                                </a>
                                <a href='{{url('user_profile/'.$item->u_id)}}'><i class="fa fa-eye"
                                        aria-hidden="true"></i></a>
                                <form class='d-inline' action="{{url('admin/patient/'.encrypt($item->id))}}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn fa fa-eye-slash text-danger" data-toggle="tooltip"
                                        data-placement="right" title="Delete"></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <h5 class='text-center'>Sorry, Patient Not Found!</h5>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal_header_style">
                    <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="js-validation-signin" method="POST" action="{{ route('patient.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="title_label_style">First Name</label>
                                    <input name='f_name' type="text"
                                        class="form-control input_form_style @error('f_name') is-invalid @enderror"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="title_label_style">Last Name</label>
                                    <input name='l_name' type="text"
                                        class="form-control input_form_style @error('l_name') is-invalid @enderror "
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="title_label_style">NID</label>
                                    <input name='NID' type="text"
                                        class="form-control input_form_style @error('NID') is-invalid @enderror"
                                        placeholder="NID no">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="title_label_style">Email</label>
                                    <input name='email' type="email"
                                        class="form-control input_form_style @error('email') is-invalid @enderror"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="title_label_style">Password</label>
                                    <input name='password' type="password"
                                        class="form-control input_form_style @error('password') is-invalid @enderror"
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="title_label_style">Confirm Password</label>
                                    <input name='password_confirmation' type="password"
                                        class="form-control input_form_style" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel_btn_style" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="form_add_btn_style">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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
@endsection
