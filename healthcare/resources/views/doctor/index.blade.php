@extends('layouts.appMain')
@section('title')
Doctor-Dashboard
@endsection
@section('navbar')
@include('include.doctorNav')
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
                                            <h5>Total Cases</h5>
                                            <h4 class="color_text_1">{{$total}}</h4>
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
                                            <h4 class="color_text_2">{{$evaluted}}</h4>
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
                                            <h4 class="color_text_3">{{$pending}}</h4>
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


        <!-- Customers and Latest Orders -->
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="dashboard_table_area">
                    <h5>Case Activity</h5>
                    <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead class="thead-light">
                            <tr>
                                <th>Patient Name</th>
                                <th>Assign Date</th>
                                <th>Evaluate Date</th>
                                <th>Satus</th>
                                <th>Case Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patient->doctorCase as $item)
                            <tr>
                                <td><img src="
                                @if ($item->patientInfo->avatar)
                                {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                @else
                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                @endif" class="rounded-circle m-r-15" style="width: 15%;"
                                        alt="{{$item->patientInfo->f_name}}-profile-image"><span><a
                                            href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>{{$item->patientInfo->f_name." ".$item->patientInfo->l_name}}</a></span>
                                </td>
                                <td>
                                    {{$item->assign_date?(\Carbon\Carbon::parse($item->assign_date))->format('H:iA, d/m/Y'):"NO"}}
                                </td>
                                <td>
                                    {{$item->release_date?(\Carbon\Carbon::parse($item->release_date))->format('H:iA, d/m/Y'):"NO"}}
                                </td>

                                <td>
                                    @if ($item->case_status===0)
                                    Running
                                    @elseif($item->case_status===1)
                                    Safe
                                    @elseif($item->case_status===2)
                                    Unclear
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('case_details/'.encrypt($item->id))}}"
                                        class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                            @empty
                            @include('include.empty.notFound');
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Customers and Latest Orders -->
    </div>
    <!-- END Page Content -->
</main>
@endsection
