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
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#evaluatedCase">Add Category</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#inprogressCase">View Category</a></li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <form action='{{url('admin/category')}}' method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class='col-6 mx-auto mb-3'>
                                <input type="text" class="form-control" name="category_name"
                                    placeholder="Category Name">
                                @error('category_name') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <input type="integer" class="form-control" name="case_price" placeholder="Case Price">
                                @error('case_price') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <textarea type="text" class="form-control" name="category_description"
                                    placeholder="Category Description"></textarea>
                                @error('category_description') <span
                                    class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <input type="file" class="form-control" name="category_image"
                                    placeholder="Category Image">
                                @error('category_image') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <button class='btn btn-info'>
                                    Add Category
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Start Inprogress Cases -->
                    <div class="tab-pane" id="inprogressCase">
                        <table
                            class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Case Price</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category as $item)
                                <tr>
                                    <td style="color:{{$item->category_status===1?"red":""}}">{{$loop->iteration}}</td>
                                    <td style="color:{{$item->category_status===1?"red":""}}"> <img src="{{asset('storage/image/'.$item->category_img)}}" class="rounded-circle m-r-15" style="width: 40px;"
                                        alt="category-image"> {{$item->category_name}}</td>
                                    <td style="color:{{$item->category_status===1?"red":""}}">{{$item->case_price}}</td>
                                    <td style="color:{{$item->category_status===1?"red":""}}">{{Str::limit($item->category_description,20,'...')}}</td>
                                    <td style="color:{{$item->category_status===1?"red":""}}" class='text-center'>
                                        <span class='mr-2'>
                                            <a href="{{url('admin/category/'.encrypt($item->id).'/edit')}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </span>
                                        <span class=''>
                                            <a href="{{url('admin/category/'.encrypt($item->id))}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                        <span>
                                            <form class='d-inline'
                                                action="{{url('admin/category/'.encrypt($item->id))}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn fa fa-eye-slash text-danger"></button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <h5 class='text-center text-warning'>
                                        Sorry, Category Not Found!
                                    </h5>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End Inprogress Cases -->
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
