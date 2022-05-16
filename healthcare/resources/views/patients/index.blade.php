@extends('layouts.appMain')
@section('title')
Patient-Dashboard
@endsection
@section('navbar')
@include('include.patientNav')
@endsection
@section('main')
<main id="main-container">

        <!-- Page Content -->
        <div class="content content-narrow">
            <!-- Stats -->
            <div class="row">
                <div class="col-md-4">
                    <div class="dashboard_all_you_need">
                        <p class="text-capitalize">Do you face any problem?</p>
                        <button type="button" class="add_btn_style" data-toggle="modal" data-target="#exampleModal">Start Now</button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6 col-xl-4">
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
                                                <h4 class="color_text_2">{{$data['evaluted']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6 col-xl-4">
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
                                                <h4 class="color_text_3">{{$data['pending']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                            <a class="dashboard_main_tab_box" href="javascript:void(0)">
                                <div class="dashboard_main_tab_box_conten">
                                    <div class="row">
                                        <div class="col-4 pr-0">
                                            <div class="dashboard_tab_icon color_icon_3">
                                                <i class="nav-main-link-icon far fa-hospital"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="dashboard_tab_text">
                                                <h5>Total Due Payment</h5>
                                                <h4 class="color_text_3">
                                                {{$due=DB::table('payments')->where('installment',1)->where("patient_id",auth()->user()->id)->sum('due_amount')}}

                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Stats -->

            {{-- <!-- Dashboard Charts -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded block-mode-loading-oneui">
                        <div class="block-header block-header-default">
                            <h5 class="block-title">Case</h5>
                        </div>
                        <div class="block-content p-0 text-center">
                            <div class="pt-3" style="height: 400px;"><canvas class="js-chartjs-dashboard-earnings"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Dashboard Charts --> --}}

            <!-- Customers and Latest Orders -->
            <br>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="dashboard_table_area">
                        <h5>Case Activity</h5>
                        <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Case Added Time</th>
                                    <th>Case Assign Time</th>
                                    <th>Case Evaluate Time</th>
                                    <th>Doctor</th>
                                    <th>Diagonis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['Case'] as $case)
                                    @include('include.table.patientDashboard',$case)
                                @empty
                                    @include('include.empty.notFound')
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Customers and Latest Orders -->
        </div>
        <!-- END Page Content -->

        @include('include.patientCaseModal')



    </main>
    @php
    $unpaid=DB::table('caselists')
    ->where('patient_id',Auth::user()->id)
    ->where('payment_status',0)->count('id');
    @endphp
@endsection
@if ($unpaid>0)
@section('script')
<script>
    toastr["error"]("You Have {{$unpaid}} Case please pay it")
</script>
@endsection
@endif
