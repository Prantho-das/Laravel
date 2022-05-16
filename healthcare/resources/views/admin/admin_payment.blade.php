@extends('layouts.appMain')
@section('title')
Admin-Payment
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
            <h3 class="block-title">All Transaction</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Patient Email</th>
                                    <th>Phone</th>
                                    <th>Total Amount</th>
                                    <th>Paymode</th>
                                    <th>Transac. Id</th>
                                    <th>Transac. Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($orders as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href='{{url('user_profile/'.$item->u_id)}}'>{{$item->name?$item->name:''}}</a></td>
                                    <td>{{$item->email?$item->email:''}}</td>
                                    <td>{{$item->phone?$item->phone:''}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>@php
                                            $mystring = $item->paymode;
                                            $first = strtok($mystring, '-');
                                            echo $first;
                                        @endphp
                                    </td>
                                    <td>{{$item->transaction_id}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('H:iA, d/m/Y')}}</td>
                                    <td>
                                        <a href='{{url('case_details/'.encrypt($item->case_id))}}' class="btn btn-info">View</a>
                                        <a class='btn btn-info rounded mx-3' href='{{url('payment/invoice/'.$item->transaction_id)}}'>
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center'>
                                        Sorry, Tansection Not Found!
                                    </h5>
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
    <!-- Page Content -->
    <div class="content content-narrow">
        <div class="block-header">
            <h3 class="block-title">Payment</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <x-admin-payment />
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
