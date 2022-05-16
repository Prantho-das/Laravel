@extends('layouts.appMain')
@section('title')
User-Profile
@endsection
@section('navbar')
    @if (Auth::user()->role === "ADMIN")
        @include('include.adminNav')
    @elseif(Auth::user()->role === "PATIENT")
        @include('include.patientNav')
    @elseif(Auth::user()->role === "DOCTOR")
        @include('include.doctorNav')
    @endif
@endsection
@section('main')
<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content content-narrow">
        <div class="block-header">
            <h3 class="block-title">Profile</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="profile_left">
                            <div class="row">
                                <div class="col-4">
                                    <div class="image_area text-center">
                                        <img src="
                                                @if ($user->avatar)
                                                    {{asset('storage/image/'.$user->avatar)}}
                                                @else
                                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($user->email)))}}
                                                @endif
                                        " alt="">
                                        <h5>{{$user->f_name}} {{$user->l_name}}</h5>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="address_line_area">
                                        <ul>
                                            <li><span>Gender :</span> {{$user->gender?$user->gender:"Record Not Found!"}}
                                            </li>
                                            <li><span>Age : </span>
                                                {{$user->age?(\Carbon\Carbon::parse($user->age)->age):"Record Not Found!"}}
                                            </li>
                                            <li><span>Phone No. : </span>
                                                {{$user->phone?'+88'.$user->phone:"Record Not Found!"}}</li>
                                            <li><span>Email : </span> {{$user->email}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="address_line_area">
                            <ul>
                                <li>
                                    <span>User ID : </span> <span class='text-primary badge badge-lg badge-outline-success'>
                                        {{$user->u_id?$user->u_id:"Record Not Found!"}}&nbsp; &nbsp;
                                    </span>
                                </li>
                                <li><span>Address : </span> {{$user->address?$user->address:"Record Not Found!"}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pEdit">Case Activity</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <table class="table m-b-0 table-bordered table-striped table-center js-dataTable-full">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Case Submit Time</th>
                                <th>Doctor</th>
                                <th>Case Assign Time</th>
                                <th>Diagonis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($evaluted as $case)
                            <tr>
                                <td>
                                    <b class='text-center'>
                                        {{$loop->iteration}}
                                    </b>
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($case->caseList->created_at)->format('H:iA, d/m/Y')}}
                                </td>
                                <td>{{$case->doctorInfo->f_name}} {{$case->doctorInfo->l_name}}</td>
                                <td>
                                    {{\Carbon\Carbon::parse($case->created_at)->format('H:iA, d/m/Y')}}
                                </td>
                                <td>
                                    <a href="{{url('case_details/'.encrypt($case->id))}}"
                                        class="btn btn-sm btn-info">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            @include('include.empty.notFound')
                            @endforelse
                        </tbody>
                    </table>
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
