
@extends('layouts.appMain')
@section('title')
Doctor-Case
@endsection
@section('navbar')
@include('include.doctorNav')
@endsection
@section('main')
<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content content-narrow">

        <div class="block-header">
            <h3 class="block-title">Case Details</h3>
        </div>
        <!-- Dynamic Table Full -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="block rounded">
                    <div class="block-content block-content-full">
                        <div class="case_details_area">
                            <div class="row">
                                <div class="col-4">
                                    <div class="image_area text-center">
                                        <img src="
                                                @if ($caseDet->patientInfo->avatar)
                                                    {{asset('assets/storage/image/'.$caseDet->patientInfo->avatar)}}
                                                @else
                                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($caseDet->patientInfo->email)))}}
                                                @endif
                                                    " alt=" {{$caseDet->patientInfo->f_name}}">
                                        <h5>{{$caseDet->patientInfo->f_name}} {{$caseDet->patientInfo->f_name}}</h5>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="address_line_area case_details_style">
                                        <ul>
                                            <li><span>Email :</span>
                                                {{$caseDet->patientInfo->email?$caseDet->patientInfo->email:"NO"}}
                                            </li>
                                            <li><span>Phone :</span>
                                                {{$caseDet->patientInfo->phone?$caseDet->patientInfo->phone:"NO"}}
                                            </li>
                                            <li><span>Gender :</span>
                                                {{$caseDet->patientInfo->gender?$caseDet->patientInfo->gender:"NO"}}
                                            </li>
                                            <li><span>Age : </span>
                                                {{$caseDet->patientInfo->age?(\Carbon\Carbon::parse($caseDet->patientInfo->age)->age):"N/A"}}
                                            </li>
                                            <li><span>Total Case : </span>
                                                @php
                                                echo DB::table('assign_cases')
                                                ->where('patient_id',auth()->id())
                                                ->where('case_status',1)
                                                ->count();
                                                @endphp
                                            </li>
                                            <li><span>Added Time : </span>
                                                {{$caseDet->assignCase?(\Carbon\Carbon::parse($caseDet->assignCase->created_at))->format('H:iA, d/m/Y'):"N/A"}}
                                            </li>
                                            <li><span>Evaluated Time : </span>
                                               {{$caseDet->release_date?(\Carbon\Carbon::parse($caseDet->release_date)->format('H:iA, d/m/Y')):'Running'}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block rounded">
                    <div class="block-content block-content-full">
                        <div class="case_details_area_bottom">
                            <h5>Description</h5>
                            <p>
                                {{$caseDet->description?$caseDet->description:'Nothing Found'}}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="block rounded">
                    <div class="block-content block-content-full">
                        <div class="case_details_area_bottom">
                            <h5>Feedback</h5>
                            <ul>
                                <li class="evaluated"><span>Evaluated By : </span>
                                    @if ($caseDet->assignCase)
                                    {{$caseDet->assignCase->f_name}} {{$caseDet->assignCase->l_name}}
                                    @else
                                    Not Assigned Yet
                                    @endif
                                </li>
                                <li class="diagnosis"><span>Diagnosis : </span>
                                    @if ($caseDet->assignCase)
                                    @if ($caseDet->assignCase->case_status===0)
                                    Inprogress
                                    @elseif($caseDet->assignCase->case_status===1)
                                    Safe
                                    @elseif($caseDet->assignCase->case_status===2)
                                    Unclear
                                    @endif
                                    @else
                                    Not Assigned Yet
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="case_details_image_area">
                    @if ($caseDet->caseImg->count()!==0)
                    <a href={{url("media?case=".$caseDet->caseImg[0]->id)}}>
                        <img src="{{asset('storage/image/'.$caseDet->caseImg[0]->case_img)}}" class="img-fluid"
                            alt="Case Details Image">
                    </a>
                    <ul>
                        @foreach($caseDet->caseImg as $item)
                        <li>
                            <a href={{url("media?case=".$item->id)}}>
                                <img src="{{asset('storage/image/'.$item->case_img)}}" class="img-fluid"
                                    alt="Case Details Image">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <h5 class='text-center'>Picture not found for this case!</h5>
                    @endif
                </div>
                @if ($caseDet->assignCase)
                @livewire('inbox',['caseDet'=>$caseDet])
                @endif
                @if ($caseDet->assignCase)
                <x-prescription :caseDet='$caseDet' />
                @endif
            </div>
        </div>
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
@endsection
