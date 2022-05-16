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
            <h3 class="block-title">Category</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#evaluatedCase">Edit Category</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <form action='{{url('admin/category/'.encrypt($category->id))}}' method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class='col-6 mx-auto mb-3'>
                                <input value='{{$category->category_name}}' type="text" class="form-control" name="category_name"
                                    placeholder="Category Name">
                                @error('category_name') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <input type="integer" class="form-control" name="case_price" placeholder="Case Price"
                                    value='{{$category->case_price}}'>
                                @error('case_price') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <textarea type="text" class="form-control" name="category_description" placeholder="Category Description">{{Str::of($category->category_description)->trim()}}</textarea>
                                @error('category_description') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <input value type="file" class="form-control" name="category_image" placeholder="Category Image">
                                @error('category_image') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <img src="{{asset('storage/image/'.$category->category_img)}}" class="rounded w-25 m-r-15" alt="category-image">
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <button class='btn btn-info'>
                                    Update Category
                                </button>
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
