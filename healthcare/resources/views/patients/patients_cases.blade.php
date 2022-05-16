@extends('layouts.appMain')
@section('title')
Patient-Case
@endsection
@section('navbar')
@include('include.patientNav')
@endsection
@section('main')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content content-narrow">
        <div class="block-header">
            <h3 class="block-title">Cases</h3>
            <button type="button" class="add_btn_style" data-toggle="modal" data-target="#exampleModal">Add
                Case</button>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#history">History</a></li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="history">
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
                                @forelse ($Case as $case)
                                @include('include.table.patientDashboard',$case)
                                @empty
                                @include('include.empty.notFound')
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
{{-- @if (Session::has('msg'))
@section('script')
<script>
    toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
            $('#addCasePayment').modal('show');
</script>
@endsection
@endif --}}
