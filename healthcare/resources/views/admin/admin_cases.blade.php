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
            <h3 class="block-title">Cases</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#evaluatedCase">Evaluated
                            Case</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#inprogressCase">Inprogress
                            Case</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pendingCase">Pending Case</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ReassignCase">Reassign Case</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <table
                            class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Added Time</th>
                                    <th>Evaluated Time</th>
                                    <th>Doctor</th>
                                    <th>Diagonis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($evaluted as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>
                                        <img src="
                                            @if ($item->patientInfo->avatar)
                                            {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                            @else
                                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                            @endif
                                            " class="rounded-circle m-r-15" style="width: 40px;height:40px;"
                                            alt="{{$item->patientInfo->f_name}}-profile-image"><span><a
                                                href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>
                                                {{$item->patientInfo->f_name}} {{$item->patientInfo->l_name}}
                                            </a>
                                        </span>
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($item->assign_date)->format('H:iA, d/m/Y')}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($item->updated_at)->format('H:iA, d/m/Y')}}
                                    </td>
                                    <td>{{$item->doctorInfo->f_name}} {{$item->doctorInfo->l_name}}</td>
                                    @if ($item->case_status==1)
                                    <td>
                                        <a href="{{url('admin/case_details/'.encrypt($item->case_id))}}"
                                            class="active_btn_style">Safe</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{url('admin/case_details/'.encrypt($item->case_id))}}"
                                            class="active_btn_style">Unclear</a>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>Sorry, Case Not Found!</h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Start Inprogress Cases -->
                    <div class="tab-pane" id="inprogressCase">
                        <table
                            class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Added Date</th>
                                    <th>Assigned Doctor</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inProgress as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>
                                        <img src="
                                                                                @if ($item->patientInfo->avatar)
                                                                                {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                                                                @else
                                                                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                                                                @endif
                                                                                " class="rounded-circle m-r-15" style="width: 40px;height:40px;"
                                            alt="{{$item->patientInfo->f_name}}-profile-image"><span><a
                                                href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>
                                                {{$item->patientInfo->f_name}} {{$item->patientInfo->l_name}}
                                            </a>
                                        </span>
                                    </td>
                                    <td>{{$item->patientInfo->email}}</td>
                                    <td>
                                        {{$item->patientInfo->phone?$item->patientInfo->phone:'N/A'}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($item->assign_date)->format('H:iA, d/m/Y')}}
                                    </td>
                                    <td>{{$item->doctorInfo->f_name}} {{$item->doctorInfo->l_name}}</td>
                                    <td>
                                        <a href="{{url('admin/case_details/'.encrypt($item->case_id))}}"
                                            class="active_btn_style">View</a> </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>Sorry, Case Not Found!</h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End Inprogress Cases -->

                    <!-- Start Pending Cases -->
                    <div class="tab-pane" id="pendingCase">
                        <table
                            class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Added Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pending as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>
                                        <img src="
                                            @if ($item->patientInfo->avatar)
                                            {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                            @else
                                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                            @endif
                                            " class="rounded-circle m-r-15" style="width: 40px;height:40px;"
                                            alt="{{$item->patientInfo->f_name}}-profile-image"><span><a
                                                href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>
                                                {{$item->patientInfo->f_name}} {{$item->patientInfo->l_name}}
                                            </a>
                                        </span>
                                    </td>
                                    <td>{{$item->patientInfo->email}}</td>
                                    <td>
                                        {{$item->patientInfo->phone?$item->patientInfo->phone:'N/A'}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($item->created_at)->format('H:iA, d/m/Y')}}
                                    </td>
                                    <td><a href="{{url('admin/case_details/'.encrypt($item->id))}}"
                                            class="active_btn_style">View</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>
                                        Sorry, Case Not Found!
                                    </h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End Pending Cases -->
                    <!-- Start Reassign Cases -->
                    <div class="tab-pane" id="ReassignCase">
                        <table
                            class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Doctor Name</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Assign Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reassign as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>
                                        <img src="
                                            @if ($item->doctorInfo->avatar)
                                            {{asset('storage/image/'.$item->doctorInfo->avatar)}}
                                            @else
                                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->doctorInfo->email)))}}
                                            @endif
                                            " class="rounded-circle m-r-15" style="width: 40px;height:40px;"
                                            alt="{{$item->doctorInfo->f_name}}-profile-image"><span><a
                                                href='{{url('user_profile/'.$item->doctorInfo->u_id)}}'>
                                                {{$item->doctorInfo->f_name}} {{$item->doctorInfo->l_name}}
                                            </a>
                                        </span>
                                    </td>
                                     <td>
                                        <span><a href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>
                                                {{$item->patientInfo->f_name}}
                                            </a>
                                        </span>
                                    </td>
                                    <td>
                                        {{$item->doctorInfo->email}}
                                    </td>
                                    <td>
                                        {{$item->doctorInfo->phone?$item->doctorInfo->phone:'N/A'}}
                                    </td>
                                    <td>
                                        <span>{{\Carbon\Carbon::parse($item->assign_date)->format('d/m/Y')}} <br>
                                        {{\Carbon\Carbon::parse($item->assign_date)->diffForHumans()}}</span>
                                    </td>
                                    <td>
                                        <a href="{{url('admin/case_reassign_mail/'.$item->doctor_id)}}"
                                            class="btn btn-warning">Warn Him</a>
                                        <a href="{{url('admin/case_reassign/'.$item->id)}}"
                                            class="active_btn_style">Reassign</a>
                                        <a href="{{url('admin/case_details/'.encrypt($item->id))}}"
                                        class="active_btn_style">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>
                                        Sorry, Case Not Found!
                                    </h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End Reassign Cases -->
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
@endsection
