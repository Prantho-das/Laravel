@extends('layouts.appMain')
@section('title')
Admin-Category
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
            <h3 class="block-title">View Category</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <div class='col-6 mx-auto mb-3'>
                            <input type="text" class="form-control" value='{{$category->category_name}}' readonly
                                name="category_name" placeholder="Category Name">
                        </div>
                        <div class='col-6 mx-auto mb-3'>
                                <input type="integer" class="form-control" name="case_price" placeholder="Case Price" value='{{$category->case_price}}' readonly>
                        </div>
                        <div class='col-6 mx-auto mb-3'>
                            <textarea class="form-control" disabled>{{trim($category->category_description)}}</textarea>
                        </div>
                        <div class='col-6 mx-auto mb-3'>
                            <img src="{{asset('storage/image/'.$category->category_img)}}" class="rounded w-25 m-r-15"
                                alt="category-image">
                        </div>
                        <div class='col-6 mx-auto mb-3'>
                            <a href='{{url('admin/category/'.encrypt($category->id).'/edit')}}' class='btn btn-warning'>
                                Edit Category
                            </a>
                        </div>
                        </form>
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
{{-- @if (Session::has('msg'))
@section('script')
<script>
    // toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
            $('#addCasePayment').modal('show');
</script>
@endsection
@endif --}}
