@extends('layouts.appMain')
@section('title')
Admin-Dashboard | {{ config('app.name') }}
@endsection
@section('navbar')
    @include('include.adminNav')
@endsection
@section('main')
<main id="main-container">
    <!-- Page Content -->
    <div class="content content-narrow">
        <!-- Stats -->
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_1">
                                            <i class="nav-main-link-icon fas fa-user-injured"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Total Patients</h5>
                                            <h4 class="color_text_1">{{$data['patient']}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_2">
                                            <i class='nav-main-link-icon fas fa-user-md'></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Evaluated Cases</h5>
                                            <h4 class="color_text_2">{{$data['eCase']}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_3">
                                            <i class="nav-main-link-icon fas fa-procedures"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Pending Cases</h5>
                                            <h4 class="color_text_3">{{$data['pcase']}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_4">
                                            <i class='nav-main-link-icon fas fa-user-md'></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Total Doctor</h5>
                                            <h4 class="color_text_4">{{$data['doctor']}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_5">
                                            <i class="nav-main-link-icon far fa-hospital"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Total Income</h5>
                                            <h4 class="color_text_5">{{$data['earnTotal']}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_4">
                                            <i class="nav-main-link-icon far fa-hospital"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Due Amount</h5>
                                            {{-- <h4 class="color_text_5">{{$data['earnTotal']}}</h4> --}}
                                            <h4>{{$due=DB::table('payments')->where('installment',1)->sum('due_amount')}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4">
                        <a class="dashboard_main_tab_box" href="javascript:void(0)">
                            <div class="dashboard_main_tab_box_conten">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <div class="dashboard_tab_icon color_icon_6">
                                            <i class="nav-main-link-icon fas fa-user-nurse"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dashboard_tab_text">
                                            <h5>Total Visitor</h5>
                                            <h4 class="color_text_6">{{$data['visitor']}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard_all_you_need">
                    <p>All you need to know about MediCare!</p>
                    <a href="{{url('/')}}" class="view_more_design">Know More</a>
                </div>
            </div>
        </div>
        <!-- END Stats -->

        <!-- Dashboard Charts -->
       <x-earning-chart />
        <!-- END Dashboard Charts -->

        <!-- Customers and Latest Orders -->
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="dashboard_table_area">
                    <h5>Case Activity</h5>
                    <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer" style="overflow: scroll;">
                        <thead class="thead-light">
                            <tr>
                                <th>Patient Name</th>
                                <th>Added Time</th>
                                <th>Evaluated Time</th>
                                <th>Status</th>
                                <th>Doctor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data['case'] as $item)
                            <tr>
                                <td>
                                    <img src="@if ($item->patientInfo->avatar)
                                        {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                        @else
                                        https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                        @endif" class="rounded-circle m-r-15" style="width: 40px; height:40px;"
                                        alt="{{$item->f_name}}-profile-image"><span><a style="color:{{$item->status===0?"red":""}}"
                                            href='{{url('user_profile/'.$item->u_id)}}'>{{$item->patientInfo->f_name}} {{$item->patientInfo->l_name}}</a></span>
                                </td>
                                <td>
                                    {{$item->assign_date?(\Carbon\Carbon::parse($item->assign_date))->format('H:iA, d/m/Y'):"NO"}}
                                </td>
                                <td>
                                    {{$item->release_date?(\Carbon\Carbon::parse($item->release_date))->format('H:iA, d/m/Y'):"NO"}}
                                </td>
                                @if ($item->case_status==1)
                                <td>
                                    Evaluted
                                </td>
                                @elseif($item->case_status==0)
                                <td>
                                    Running
                                </td>
                                @elseif($item->case_status==2)
                                <td>
                                    Unclear
                                </td>
                                @endif
                                <td>{{$item->doctorInfo->f_name}} {{$item->doctorInfo->l_name}}</td>
                            </tr>
                            @empty
                            <tr>
                                <h5 class='text-center text-warning'>
                                    Sorry, Case Not Found!
                                </h5>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <x-patientGender/>
        </div>

    </div>
    <!-- END Page Content -->
</main>
@endsection

