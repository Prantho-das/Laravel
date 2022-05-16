@extends('layouts.appMain')
@section('title')
Doctor-Case
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
            <h3 class="block-title">Email</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">

            <div class="block-content block-content-full">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($email as $item)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$item->full_name}}
                                    </td>
                                    <td>{{$item->subject}}</td>
                                    <td>
                                        {{\Carbon\Carbon::parse($item->created_at)->format('H:iA, d/m/Y')}}
                                    </td>
                                    <td>
                                        <a href="{{url('admin/email/show/'.encrypt($item->id))}}"
                                            class="btn btn-sm btn-success">
                                            <i class="fa fa-share" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{url('admin/email/delete/'.$item->id)}}"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center text-warning'>
                                        Sorry, Email Not Found!
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
