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
            <h3 class="block-title">Symptoms</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <ul class="nav nav-tabs-new2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#evaluatedCase">Add Symptom</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#inprogressCase">Symptom List</a></li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="evaluatedCase">
                        <form action='{{url('admin/symptom')}}' method="POST">
                            @csrf
                            <div class='col-6 mx-auto mb-3'>
                                <div class="form-group">
                                    <select class="form-control" name="category_id"
                                        style="width: 100%;" data-placeholder="Choose one.." tabindex="-1" aria-hidden="true">
                                        <option disabled selected>Select One Category</option>
                                        @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <input type="text" class="form-control" name="question_name"
                                    placeholder="Symptom Name">
                                @error('question_name') <span class="error text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class='col-6 mx-auto mb-3'>
                                <button class='btn btn-info'>
                                    Add Symptom
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Start Inprogress Cases -->
                    <div class="tab-pane" id="inprogressCase">
                       @livewire('question-list')
                    </div>
                    <!-- End Inprogress Cases -->
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
@endsection
