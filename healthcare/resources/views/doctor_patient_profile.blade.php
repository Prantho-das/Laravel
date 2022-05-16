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
        @php
        $user=Auth::user()
        @endphp
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
                                            <li><span>Phone No : </span>
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
                                    <span>User ID : </span> <span class='badge badge-lg text-primary badge-outline-success'>
                                        {{$user->u_id?$user->u_id:"Record Not Found!"}} &nbsp;
                                    </span>
                                </li>
                                <li><span>Address : </span> {{$user->address?$user->address:"Record Not Found!"}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @livewire('avatar')
                </div>
            </div>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pEdit">Profile Edit</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pPassword">Password Change</a>
                    </li>
                    @if (auth()->user()->role==="DOCTOR")
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#specializaion">Specialization</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id='pEdit'>
                        <form action='{{route('profileEdit')}}' method="POST">
                            @csrf
                            <div class='row'>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                                        <input type="text"
                                            class="form-control {{$user->f_name?'is-valid':'is-invalid'}}" name='f_name'
                                            value='{{$user->f_name?$user->f_name:"Record Not Found!"}}'
                                            id="exampleFormControlInput1" placeholder="First Name">
                                        @error('f_name') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                        <input type="text"
                                            class="form-control {{$user->l_name?'is-valid':'is-invalid'}}" name='l_name'
                                            value='{{$user->l_name?$user->l_name:"Record Not Found!"}}'
                                            id="exampleFormControlInput1" placeholder="Last Name">
                                        @error('l_name') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                        <input type="tel" class="form-control {{$user->phone?'is-valid':'is-invalid'}}"
                                            name='phone' value='{{$user->phone?$user->phone:"Record Not Found!"}}'
                                            id="exampleFormControlInput1" placeholder="+88-">
                                        @error('phone') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleFormControlInput3"
                                        class="form-label {{$user->gender?'text-success':'text-danger'}}">Gender</label>
                                    <div class='d-md-flex mt-2'>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gender"
                                                value='Female' {{$user->gender==='Female'?"checked":""}}>
                                            <label class="form-check-label" for="gender">
                                                Female
                                            </label>
                                        </div>
                                        <div class="form-check ml-md-3">
                                            <input class="form-check-input" type="radio" name="gender" id="gender"
                                                value='Male' {{$user->gender==='Male'?"checked":""}}>
                                            <label class="form-check-label" for="gender">
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                    @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Age</label>
                                        <input class="js-datepicker form-control {{$user->age?'is-valid':'is-invalid'}}"
                                            type="date" id="example-datepicker1" name="age"
                                            max='{{\Carbon\Carbon::today()->format('Y-m-d')}}'
                                            value='{{$user->age?\Carbon\Carbon::parse($user->age)->format('Y-m-d'):\Carbon\Carbon::today()->format('Y-m-d')}}'
                                            placeholder="mm/dd/yy">
                                        @error('age') <span class="error text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Enter Your Address</label>
                                <textarea name="address" class="form-control {{$user->address?'is-valid':'is-invalid'}}"
                                    id="exampleFormControlTextarea1" rows="3">@php
                                        if ($user->address) {
                                            print stripslashes(trim($user->address));
                                        } @endphp</textarea>
                                @error('address') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <button class='btn btn-outline-info'>Update</button>
                        </form>
                    </div>
                    <div class="tab-pane" id='pPassword'>
                        <h3 class='text-center'>Change Your Password</h3>
                        <form action='{{route('profilePassword')}}' method="POST">
                            @csrf
                            <div class="col-md-6 mx-auto mb-3">
                                <label for="exampleInputPassword1" class="form-label">Current Password</label>
                                <input type="password" class="form-control" name='password_current'
                                id="exampleInputPassword1">
                                @error('password_current') <span
                                class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6 mx-auto mb-3">
                                <label for="exampleInputPassword1" class="form-label">New Password</label>
                                <input type="password" class="form-control" name='password' id="exampleInputPassword1">
                                @error('password') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6 mx-auto mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name='password_confirmation'
                                id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6 mx-auto mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                    @php
                        if (auth()->user()->role==='DOCTOR') {
                        $spelization=DB::table('specilization_of_doctors')
                        ->where('doctor_id',auth()->id())
                        ->first();
                        }
                    @endphp
                    @if (auth()->user()->role==='DOCTOR')
                        <div class="tab-pane" id='specializaion'>
                            <h3 class='text-center'>Specialization</h3>

                            <form action='{{route('doctor.specialization')}}' method="POST">
                                @csrf
                                <div class="row">
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="first_degree">1.Enter Your First Degree</label>
                                            <textarea class="form-control" name="highest_degree_one" id="first_degree" rows="3">{{$spelization?($spelization->highest_degree_one?$spelization->highest_degree_one:''):''}}</textarea>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="second_degree">2.Enter Your Second Degree</label>
                                            <textarea class="form-control" name="highest_degree_two" id="second_degree" rows="3">{{$spelization?($spelization->highest_degree_two?$spelization->highest_degree_two:''):''}}</textarea>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="third_degree">3.Enter Your Third Degree</label>
                                            <textarea class="form-control" name="highest_degree_three" id="third_degree" rows="3">{{$spelization?($spelization->highest_degree_three?$spelization->highest_degree_three:''):''}}</textarea>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="four_degree">4.Enter Your Fourth Degree</label>
                                            <textarea class="form-control" name="highest_degree_four" id="four_degree" rows="3">{{$spelization?($spelization->highest_degree_four?$spelization->highest_degree_four:''):''}}</textarea>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="specialization">Enter Your Specialization</label>
                                            <textarea class="form-control" name="specilization" id="specialization" rows="3">{{$spelization?($spelization->specilization?$spelization->specilization:''):''}}</textarea>
                                        </div>
                                    </div>
                                    <div class='col-12'>
                                        <button type="submit" class="btn btn-primary">Add Specialization</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

