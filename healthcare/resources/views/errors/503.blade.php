@extends('layouts.app')
@section('title')
    Healthcare | Maintanance On
@endsection
@section('body')
    <!-- Error Content -->
    <div class="content bg-white text-center pulldown overflow-hidden">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <!-- Error Titles -->
                    <h1 class="smini-hide">
                        <i class="font-size-h1 fa fa-circle-notch text-primary"></i> <span
                            class="font-w700 font-size-h1">Healthcare</span>
                    </h1>
                    <h1 class="animated fadeInUp"> <i class="fa fa-cog fa-spin"></i> </h1>
                    <h1 class="font-s128 font-w300 text-primary animated bounceInDown">Sorry, we’re down for maintenance.
                    </h1>
                    <h2 class="h3 font-w300 push-50 animated fadeInUp">We’ll be back shortly!</h2>
                    <!-- END Error Titles -->
    
                    <!-- Search Form -->
                    <form class="form-horizontal push-50" action="base_pages_search.html" method="post">
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
                                <div class="input-group input-group-lg">
                                    <input class="form-control" type="text" placeholder="Search application..">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Search Form -->
                </center>
            </div>
        </div>
    </div>
    <!-- END Error Content -->
    
    <!-- Error Footer -->
    <div class="content pulldown text-muted text-center">
        Would you like to let us know about it?<br>
        <a class="link-effect" href="javascript:void(0)">Report it</a> or <a class="link-effect" href="index.html">Go Back
            to Dashboard</a>
    </div>
    <!-- END Error Footer -->
@endsection
@section('script')
    <script src="{{asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
@endsection