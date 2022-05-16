@extends('layouts.appMain')
@section('title')
Patient-Dashboard
@endsection
@section('navbar')
@include('include.patientNav')
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
                                                    {{asset('storage/image/'.$caseDet->patientInfo->avatar)}}
                                                @else
                                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($caseDet->patientInfo->email)))}}
                                                @endif
                                                 " alt=" {{$caseDet->patientInfo->f_name}}">
                                        <h5>{{$caseDet->patientInfo->f_name}} {{$caseDet->patientInfo->l_name}}</h5>
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
                                            {{-- <li><span>Evaluated Time : </span>
                                                {{$caseDet->release_date?(\Carbon\Carbon::parse($caseDet->release_date)->format('H:iA, d/m/Y')):'Running'}}
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block rounded">
                    <div class="block-content block-content-full">
                        <h5>Describe, Where is the problem located?</h5>
                        <p>
                            {{$caseDet->description?$caseDet->description:"No Description Found"}}
                        </p>
                        @if (count($question)>0)
                        <div class="case_details_area_bottom">
                            <h5>Answered Questions:</h5>
                            <div class="check_box_area">
                                @foreach ($question as $item)
                                <h6>{{$loop->iteration}}. {{$item->question_name}}</h6>
                                <p>
                                    @switch($item->question_serial)
                                    @case(1)
                                    {{$caseDet->symptom_one?$caseDet->symptom_one:'Nothing Found'}}
                                    @break
                                    @case(2)
                                    {{$caseDet->symptom_two?$caseDet->symptom_two:'Nothing Found'}}
                                    @break
                                    @case(3)
                                    {{$caseDet->symptom_three?$caseDet->symptom_three:'Nothing Found'}}
                                    @break
                                    @case(4)
                                    {{$caseDet->symptom_four?$caseDet->symptom_four:'Nothing Found'}}
                                    @break
                                    @case(5)
                                    {{$caseDet->symptom_five?$caseDet->symptom_five:'Nothing Found'}}
                                    @break
                                    @case(6)
                                    {{$caseDet->symptom_six?$caseDet->symptom_six:'Nothing Found'}}
                                    @break
                                    @case(7)
                                    {{$caseDet->symptom_seven?$caseDet->symptom_seven:'Nothing Found'}}
                                    @break
                                    @case(8)
                                    {{$caseDet->symptom_eight?$caseDet->symptom_eight:'Nothing Found'}}
                                    @break
                                    @case(9)
                                    {{$caseDet->symptom_nine?$caseDet->symptom_nine:'Nothing Found'}}
                                    @break
                                    @case(10)
                                    {{$caseDet->symptom_ten?$caseDet->symptom_ten:'Nothing Found'}}
                                    @break
                                    @default
                                    Nothing Found
                                    @endswitch
                                </p>
                                <hr>
                                {{-- {{?(('question_'.$array[$item->question_serial])===):''}}
                                {{'question_'.$array[0]}} --}}
                                @endforeach
                            </div>
                        </div>
                        @endif
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
                            @if ($caseDet->payment_status===0)
                            <div class="form-group">
                                <button class="btn btn-info" type="button" id="sslczPay" postdata=""
                                    class="btn btn-block btn--dark btn--rounded btn--w-icon" name="button">
                                    <i class="icon icon--arrow-right"></i>
                                    Pay With SSLCOMMERZ
                                </button>
                                <!-- END Page Content -->
                                <div class="modal fade" id="addCasePayment" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header modal_header_style">
                                                <h5 class="modal-title" id="exampleModalLabel">Pay Now</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    class="needs-validation d-flex flex-column justify-content-center"
                                                    novalidate>
                                                    <img src="{{asset('assets/media/payment-method.png')}}"
                                                        class="img-fluid h-50 w-50 mb-4 m-auto" alt="payment-img">
                                                    @csrf
                                                    <input type="hidden" class="form-control" id='total_price'
                                                        name='total_price' value={{$caseDet->categoryInfo->case_price}}>
                                                    <input type="hidden" class="form-control" id='case_id'
                                                        name='case_id' value='{{encrypt($caseDet->id)}}'>

                                                    <div class="form-group">
                                                        <input type="tel"
                                                            value='{{auth()->user()->phone?auth()->user()->phone:''}}'
                                                            class="form-control my-3" id='cus_mobile'
                                                            onkeyup="validate()" name="cus_mobile"
                                                            placeholder="Mobile Number" required>
                                                        <textarea class="form-control mb-3 rounded" id='cus_addr'
                                                            onkeyup="validate()" name="cus_addr"
                                                            placeholder="Address Please"
                                                            required>{{auth()->user()->address?auth()->user()->address:''}}</textarea>

                                                        <div class="form-check mb-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="INSTRALLMENT">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                Pay In Installment
                                                            </label>
                                                        </div>
                                                        <button class="btn btn-primary rounded" disabled
                                                            id="sslczPayBtn" token="if you have any token validation"
                                                            postdata
                                                            order="If you already have the transaction generated for current order"
                                                            endpoint="/pay-via-ajax">Pay With SSLCOMMERZ
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($caseDet->payment_status===1)
                            @if ($caseDet->paymentInfo->installment===1)
                            <div class="form-group">
                                <button class="btn btn-info" type="button" id="sslczPay" postdata=""
                                    class="btn btn-block btn--dark btn--rounded btn--w-icon" name="button">
                                    <i class="icon icon--arrow-right"></i>
                                    Pay With SSLCOMMERZ Installment ({{$caseDet->paymentInfo->due_amount}})
                                </button>
                            </div>
                            <div class="modal fade" id="addCasePayment" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal_header_style">
                                            <h5 class="modal-title" id="exampleModalLabel">Pay Now</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST"
                                                class="needs-validation d-flex flex-column justify-content-center"
                                                novalidate>
                                                <img src="{{asset('assets/media/payment-method.png')}}"
                                                    class="img-fluid h-50 w-50 mb-4 m-auto" alt="payment-img">
                                                @csrf
                                                <input type="hidden" class="form-control" id='total_price'
                                                    name='total_price' value="{{$caseDet->paymentInfo->due_amount}}">
                                                <input type="hidden" class="form-control" id='case_id' name='case_id'
                                                    value='{{encrypt($caseDet->id)}}'>

                                                <div class="form-group">
                                                    <input type="tel"
                                                        value='{{auth()->user()->phone?auth()->user()->phone:''}}'
                                                        class="form-control my-3" id='cus_mobile' onkeyup="validate()"
                                                        name="cus_mobile" placeholder="Mobile Number" required>
                                                    <textarea class="form-control mb-3 rounded" id='cus_addr'
                                                        onkeyup="validate()" name="cus_addr"
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <script>
                    function preview_images(){
                        var total_file=document.getElementById("images").files.length;
                            for(var i=0;i<total_file;i++){
                                $('#image_preview').append("<div class='col-md-3'><img class='img-fluid' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
                            }
                        }
                </script>
                <div class="case_details_image_area">
                    <div class="block rounded">
                        @if ($caseDet->assignCase)
                        @if ($caseDet->assignCase->case_status!==1)
                        <form action="{{route('case_pic_add',['id'=>$caseDet->id])}}" method="POST" id="addCase"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="block-content block-content-full">
                                <div class="case_details_image_area">
                                    <div class="row" id="image_preview">
                                    </div>
                                    <ul>
                                        <li><img src="{{asset('assets/media/photos/photo-camera-interface-symbol-for-button.svg')}}"
                                                class="img-fluid" alt="Case Details Image"></li>
                                    </ul>
                                </div>
                                <hr>
                                <h5>Select Some Clear Images</h5>
                                <div class="custom-file">
                                    <input id="images" name="images[]" type="file" onchange="preview_images();"
                                        class="custom-file-input" data-show-upload="false" data-show-caption="true"
                                        multiple data-show-upload="true" multiple>
                                    @error('images') <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <label class="custom-file-label" for="customFile" name='submit_image'
                                        value="Upload Multiple Image"> <i class="fas fa-image"></i> Choose Multiple
                                        Image</label>
                                </div>
                            </div>
                            <button type="submit" class='btn btn-info ml-3 mb-3'>Add Picture <i
                                    class="fa fa-picture-o" aria-hidden="true"></i></button>
                        </form>
                        @endif
                        @endif
                    </div>

                    <div class="block rounded p-2">
                        @if ($caseDet->caseImg->count()!==0)
                        <h5 class='text-center'>Included Images</h5>
                        <ul>
                            @foreach($caseDet->caseImg as $item)
                            <li>
                                <a href={{url("media?case=".$caseDet->caseImg[0]->id)}}>
                                    <img src="{{asset('storage/image/'.$item->case_img)}}" class="img-fluid"
                                        alt="Case Details Image">
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <h5 class='text-center'>Picture Not Found!</h5>
                        @endif
                    </div>
                </div>


                @if ($caseDet->assignCase)
                {{-- @if ($caseDet->assignCase->case_status===0||$caseDet->assignCase->case_status===2) --}}
                @livewire('inbox',['caseDet'=>$caseDet])
                {{-- @endif --}}
                @endif

                @if ($caseDet->assignCase)
                    @if ($caseDet->prescription)
                        @if ($caseDet->payment_status===1)
                            @if ($caseDet->paymentInfo->installment===0)
                                <div class="block rounded">
                                    <div class="block-content block-content-full">
                                        <div class="case_details_area_bottom">
                                            <h5>Prescription</h5>
                                            <a target='_' href="{{url('prescriptionPreview',$caseDet->id)}}" class='btn btn-success'>Preview</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
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
