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
        <!-- Customers and Latest Orders -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard_table_area">
                    <h5>Paid Cases</h5>
                    <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Case ID</th>
                                <th>Case Add Time</th>
                                <th>Category</th>
                                <th>Transection ID</th>
                                <th>Total Amount</th>
                                <th>Due Amount</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pcase as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>CASE-{{$item->id}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                                <td>{{$item->categoryInfo->category_name}}</td>
                                <td>{{$item->paymentInfo->transaction_id}}</td>
                                <td>{{$item->categoryInfo->case_price}}</td>
                                <td>
                                    <span class="badge badge-pill
                                        {{$item->paymentInfo->due_amount?"badge-warning":"badge-success"}}
                                        ">
                                        {{$item->paymentInfo->due_amount?$item->paymentInfo->due_amount:"No Due"}}
                                    </span>
                                    @if ($item->payment_status===1)
                                    @if ($item->paymentInfo->installment===1)
                                        <button class="btn btn-info" type="button" id="sslczPay" postdata=""
                                            class="btn btn-block btn--dark btn--rounded btn--w-icon" name="button">
                                            <i class="icon icon--arrow-right"></i> Pay Now
                                        </button>
                                    <div class="modal fade" id="addCasePayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header modal_header_style">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pay Now</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" class="needs-validation d-flex flex-column justify-content-center" novalidate>
                                                        <img src="{{asset('assets/media/payment-method.png')}}" class="img-fluid h-50 w-50 mb-4 m-auto"
                                                            alt="payment-img">
                                                        @csrf
                                                        <input type="hidden" class="form-control" id='total_price' name='total_price'
                                                            value="{{$item->paymentInfo->due_amount}}">
                                                        <input type="hidden" class="form-control" id='case_id' name='case_id'
                                                            value='{{encrypt($item->id)}}'>

                                                        <div class="form-group">
                                                            <input type="tel" value='{{auth()->user()->phone?auth()->user()->phone:''}}'
                                                                class="form-control my-3" id='cus_mobile' onkeyup="validate()" name="cus_mobile"
                                                                placeholder="Mobile Number" required>
                                                            <textarea class="form-control mb-3 rounded" id='cus_addr' onkeyup="validate()" name="cus_addr"
                                                                placeholder="Address Please"
                                                                required>{{auth()->user()->address?auth()->user()->address:''}}</textarea>
                                                            <button class="btn btn-primary rounded" disabled id="sslczPayBtn"
                                                                token="if you have any token validation" postdata
                                                                order="If you already have the transaction generated for current order"
                                                                endpoint="/pay-via-ajax">Pay With SSLCOMMERZ
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('patient/case_details/'.encrypt($item->id))}}"
                                        class="btn btn-info" target="_">Details</a>
                                    <a class='btn btn-info rounded mx-3' href='{{url('payment/invoice/'.$item->paymentInfo->transaction_id)}}' target="_">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <center>
                                    <h5 class='text-center'>Sorry, Record Not Found!</h5>
                                </center>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Customers and Latest Orders -->
    </div>
    <div class="content content-narrow">
        <!-- Customers and Latest Orders -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard_table_area">
                    <h5>Unpaid Cases</h5>
                    <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Case ID</th>
                                <th>Case Add Time</th>
                                <th>Category</th>
                                <th>Due Amount</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($case as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>CASE-{{$item->id}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                                <td>{{$item->categoryInfo->category_name}}</td>
                                <td>{{$item->categoryInfo->case_price}}</td>
                                <td>
                                    <a href="{{url('patient/case_details/'.encrypt($item->id))}}"
                                        class="btn btn-info">Details</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                               <center>
                                <h5 class='text-center'>Sorry, Record Not Found!</h5>
                            </center>
                            </tr>
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
<script>
    function validate() {
    var cus_addr = $('#cus_addr').val();
    var cus_mobile = $('#cus_mobile').val();
    if (cus_addr.length > 0 && cus_mobile.length > 0) {
    $('#sslczPayBtn').removeAttr('disabled');
    } else {
    $('#sslczPayBtn').attr('disabled', true);
    }
    }
</script>
@endsection
