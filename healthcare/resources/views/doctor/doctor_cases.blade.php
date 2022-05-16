@extends('layouts.appMain')
@section('title')
Doctor-Case
@endsection
@section('navbar')
    @include('include.doctorNav')
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
                            Cases</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pendingCase">Pending Cases</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Assign Time</th>
                                    <th>Evaluated Time</th>
                                    <th>Doctor</th>
                                    <th>Diagonis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($evaluted as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="@if ($item->avatar)
                                                                    {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                                                    @else
                                                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                                                    @endif
                                                                    " class="rounded-circle m-r-15" style="width: 15%;"
                                            alt="{{$item->f_name}}-profile-image"><span><a style="color:{{$item->status===0?"red":""}}"
                                                href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>{{$item->patientInfo->f_name}} {{$item->patientInfo->l_name}}</a></span>
                                    </td>
                                    <td>
                                        {{$item->updated_at?(\Carbon\Carbon::parse($item->updated_at))->format('H:iA, d/m/Y'):"NO"}}
                                    </td>
                                    <td>
                                        {{$item->release_date?(\Carbon\Carbon::parse($item->release_date))->format('H:iA, d/m/Y'):"NO"}}
                                    </td>
                                    <td>{{Auth::user()->f_name}}</td>
                                    <td>
                                        @if ($item->case_status===1)
                                        <a href="{{url('doctor/case_evaluated/'.encrypt($item->case_id))}}"
                                            class="btn btn-sm btn-success">Safe</a>
                                        @else
                                        <a href="{{url('doctor/case_details/'.encrypt($item->case_id))}}"
                                            class="unclear_btn_style">Unclear
                                            Picture</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>Sorry, Record Not Found!</h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="pendingCase">
                        <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
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
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="@if ($item->avatar)
                                            {{asset('storage/image/'.$item->patientInfo->avatar)}}
                                            @else
                                            https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                            @endif
                                            " class="rounded-circle m-r-15" style="width: 15%;"
                                            alt="{{$item->f_name}}-profile-image"><span><a style="color:{{$item->status===0?"red":""}}"
                                                href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>{{$item->patientInfo->f_name}}
                                                {{$item->patientInfo->l_name}}</a></span>
                                    </td>
                                    <td>{{$item->patientInfo->email}}</td>
                                    <td>
                                        {{$item->patientInfo->phone?"+88".$item->patientInfo->phone:"No Number"}}
                                    <td>
                                        {{\Carbon\Carbon::parse($item->assign_date)->format('H:iA, d/m/Y')}} </td>
                                    <td>
                                        <a href="{{url('doctor/case_details/'.encrypt($item->case_id))}}"
                                            class="active_btn_style">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>Sorry, Record Not Found!</h5>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
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
{{-- @if (Session::has('msg'))
<script>
    toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
</script>
@endif --}}
@endsection
