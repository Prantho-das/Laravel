@extends('layouts.appMain')
@section('title')
Admin-Case
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
            <h3 class="block-title">Subscriber List</h3>
        </div>
        <!-- Dynamic Table Full -->
        <!-- Dynamic Table Full -->
        <div class="block">
        <form action="{{route('subscription.store')}}" method="POST">
        @csrf
            <div class="block-content block-content-full">
                <table class="table" id="subscription">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Action <input type="checkbox" class="" id="emailSubscriptionAll"></th>
                            <th>Email</th>
                            <th>Subscription Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($subscription as $item)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>
                              <center>
                              <input type="checkbox" class="" name="email[]" id="emailSubscription" value="{{$item->email}}">
                              </center>
                            </td>
                            <td>{{$item->email}}</td>
                            <td>{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</td>
                        </tr>
                    @empty
                        <h5 class='text-center'>Sorry, Symptom Not Found!</h5></tr>
                    @endforelse
                </table>
                    <a class='btn btn-info float-right' href={{route('subscription.create')}}>Export To Exel</a>
                    </tbody>
            </div>
            <div class="block-content block-content-full py-5">
                <div class="block-header"><h5>Send to Selected Subscriber</h5></div>
                <textarea id='mytextarea' name='message' class="form-control @error('message') is-invalid @enderror" rows="4" name="text" placeholder="Aaaa.."></textarea>
                <button class='btn btn-success btn-lg' type="submit">Send</button>
            </div>
        </form>
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
<!-- Page JS Code -->
<script src="{{asset('assets/js/pages/halthcare_datatables.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#subscription').DataTable();
    });
    $(document).ready(function () {
    $("#emailSubscriptionAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
});
    });
        $('#mytextarea').summernote({
            height: 150,
            toolbar: [
            ['font', ['bold']],
            ['color', ['color']],
            ['insert', ['picture']],
        ],
        });
</script>
@endsection
