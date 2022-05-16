<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }} | Invoice</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <!-- END Icons -->

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

    <!-- Fonts and OneUI framework -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/halthcare.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
</head>

<body>
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content content-boxed">
            <!-- Invoice -->
            <div class="block">
                <div class="block-content block-content-narrow">
                    <div class="row ">
                        <div class="col-md-11"></div>
                        <div class="col-md-1 col-md-offset-11 hidden-print">
                            <button style="width: 85px; background-color: #e9e9e9;" class="form-control"
                                id="printPageButton" onclick="window.print()"><i class="si si-printer"></i>
                                Print</button>
                        </div>
                    </div>

                    <!-- Invoice Info -->
                    <div class="h1 text-center push-30-t push-30 hidden-print">#INVOICE</div>
                    <hr class="hidden-print">
                    <div class="row items-push-2x">
                        <!-- Company Info -->
                        <div class="col-xs-6 col-sm-4 col-lg-6">
                            @include('include.logo')
                            <address style="padding: 10px 15px">
                                {{$setting->email}}
                                <br />
                                @forelse ($setting->contact as $item)
                                <i class="si si-call-start"></i>{{'+880'.$item.", "}}
                                @empty
                                @endforelse
                                <br />
                                {{$setting->address}}
                            </address>
                        </div>
                        <!-- END Company Info -->

                        <!-- Client Info -->
                        <div class="col-xs-6 col-sm-4 col-lg-6 text-right">
                            <p class="h2 font-w400 push-5">{{$payment->name}}</p>
                            <address>
                                {{$payment->email}}<br>
                                (+88) {{$payment->phone}}<br>
                                {{$payment->address}}<br>
                            </address>
                        </div>
                        <!-- END Client Info -->
                    </div>
                    <!-- END Invoice Info -->
                </div>
                <!-- Table -->
                <div class="block-content">
                    <div class="row">
                        <table class="table m-b-0 table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Case ID</th>
                                    <th>Category</th>
                                    <th>Added Time</th>
                                    <th>Quantity</th>
                                    <th>Price (৳)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CASE-{{$payment->id}}</td>
                                    <td>{{$payment->caseAssign->category_name}}</td>
                                    <td>{{$payment->created_at?$payment->created_at:now()}}</td>
                                    <td>1</td>
                                    <td>{{$payment->amount}} <span>Tk</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-7"></div>
                        <div class="col-md-5 col-md-offset-7">
                            <table class="table table m-b-0 table-bordered table-striped table-vcenter">
                                <tbody>
                                    <tr>
                                        <td class="text-left">Subtotal</td>
                                        <td class="text-right">
                                            {{$payment->amount}} <span>TK</span>
                                        </td>
                                    </tr>
                                    @php
                                    $serviceCharge=0;
                                    @endphp
                                    <tr>
                                        <td class="text-left">Service Charge</td>
                                        <td class="text-right">
                                            {{$serviceCharge}} <span>TK</span>
                                        </td>
                                    </tr>
                                    @php
                                    $govVat=0;
                                    $total=((int)$payment->amount)+($serviceCharge)+($govVat);
                                    @endphp
                                    <tr>
                                        <td class="text-left">Govt. VAT</td>
                                        <td class="text-right">
                                            {{$govVat}} <span>TK</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <strong>Total</strong>
                                        </td>
                                        <td class="text-right grand_total">
                                            <input type="hidden" value="{{$total}}">
                                            {{$total}} <span>TK</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END Table -->

                <!-- Footer -->
                <hr>
                <p class="text-muted text-center"><small>Thank you so much for trusting us. We expected
                        To work with you again!</small></p>
                <!-- END Footer -->

                <!-- Footer -->
                <hr>
                <div class="text-center text-muted">Copyright &#169; <a class="font-w600" href="/"
                        target="_blank">{{ config('app.name') }}</a></span>
                </div> <br>
                <!-- END Footer -->

            </div>
            <!-- END Invoice -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- END Page Container -->
    <script src="{{ asset('assets/js/halthcare.core.min.js') }}"></script>
    <script src="{{ asset('assets/js/halthcare.app.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/halthcare_datatables.min.js') }}"></script>
</body>

</html>
