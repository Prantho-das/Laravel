@extends('layouts.appMain')
@section('title')
Doctor-Patient
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
            <h3 class="block-title">Patients</h3>
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
                            <th>Address</th>
                            {{-- <th>Total Cases</th> --}}

                            <th>Patient Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patient->doctorCase as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img src="@if ($item->avatar)
                                    {{asset('storage/image/'.$item->avatar)}}
                                    @else
                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->patientInfo->email)))}}
                                    @endif
                                    " class="rounded-circle m-r-15" style="width: 15%;"
                                    alt="{{$item->f_name}}-profile-image"><span><a style="color:{{$item->status===0?"red":""}}"
                                        href='{{url('user_profile/'.$item->patientInfo->u_id)}}'>{{$item->patientInfo->f_name}}
                                        {{$item->patientInfo->l_name}}</a></span>
                            </td>
                            <td>{{$item->patientInfo->email}}</td>
                            <td>{{$item->patientInfo->phone?"+88".$item->patientInfo->phone:"Record Not Found!"}}</td>
                            <td>{{$item->patientInfo->address}}</td>
                            {{-- <td>
                            @php
                            echo DB::table('assign_cases')
                            ->where('patient_id',auth()->id())
                            ->where('case_status',0)
                            ->count();
                            @endphp</td> --}}

                            <td><a href="{{url('user_profile/'.$item->patientInfo->u_id)}}" class="active_btn_style">View</a></td>
                        </tr>
                        @empty
                        @include('include.empty.notFound')
                        @endforelse
                    </tbody>
                </table>
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
