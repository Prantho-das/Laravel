@extends('layouts.appMain')
@section('title')
Patient-Dashboard
@endsection
@section('style')
<style type="stylesheet">
    #formdiv {
      text-align: center;
    }
    #file {
      color: green;
      padding: 5px;
      border: 1px dashed #123456;
      background-color: #f9ffe5;
    }
    #img {
      width: 17px;
      border: none;
      height: 17px;
      margin-left: -20px;
      margin-bottom: 191px;
    }
    .upload {
      width: 100%;
      height: 30px;
    }
    .previewBox {
      text-align: center;
      position: relative;
      width: 150px;
      height: 150px;
      margin-right: 10px;
      margin-bottom: 20px;
      float: left;
    }
    .previewBox img {
      height: 150px;
      width: 150px;
      padding: 5px;
      border: 1px solid rgb(232, 222, 189);
    }
    .delete {
      color: red;
      font-weight: bold;
      position: absolute;
      top: 0;
      cursor: pointer;
      width: 20px;
      height:  20px;
      border-radius: 50%;
      background: #ccc;
    }
            </style>
<script>
    $('#add_more').click(function() {
              "use strict";
              $(this).before($("<div/>", {
                id: 'filediv'
              }).fadeIn('slow').append(
                $("<input/>", {
                  name: 'file[]',
                  type: 'file',
                  id: 'file',
                  multiple: 'multiple',
                  accept: 'image/*'
                })
              ));
            });

            $('#upload').click(function(e) {
              "use strict";
              e.preventDefault();

              if (window.filesToUpload.length === 0 || typeof window.filesToUpload === "undefined") {
                alert("No files are selected.");
                return false;
              }

              // Now, upload the files below...
              // https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications#Handling_the_upload_process_for_a_file.2C_asynchronously
            });

            deletePreview = function (ele, i) {
              "use strict";
              try {
                $(ele).parent().remove();
                window.filesToUpload.splice(i, 1);
              } catch (e) {
                console.log(e.message);
              }
            }

            $("#file").on('change', function() {
              "use strict";

              // create an empty array for the files to reside.
              window.filesToUpload = [];

              if (this.files.length >= 1) {
                $("[id^=previewImg]").remove();
                $.each(this.files, function(i, img) {
                  var reader = new FileReader(),
                    newElement = $("<div id='previewImg" + i + "' class='previewBox'><img /></div>"),
                    deleteBtn = $("<span class='delete' onClick='deletePreview(this, " + i + ")'>X</span>").prependTo(newElement),
                    preview = newElement.find("img");

                  reader.onloadend = function() {
                    preview.attr("src", reader.result);
                    preview.attr("alt", img.name);
                  };

                  try {
                    window.filesToUpload.push(document.getElementById("file").files[i]);
                  } catch (e) {
                    console.log(e.message);
                  }

                  if (img) {
                    reader.readAsDataURL(img);
                  } else {
                    preview.src = "";
                  }

                  newElement.appendTo("#filediv");
                });
              }
            });
</script>
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
            <h3 class="block-title">New Case</h3>
        </div>
        <!-- Dynamic Table Full -->
        <form action="{{url('patient/add_case')}}" method="POST" id="addCase" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" name="cat_id" value='{{$catId->id}}'>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="block rounded">
                        <div class="block-content block-content-full">
                            <div class="patient_add_new_case">
                                <h4 class='text-capitalize'>Describe the problem you are facing: </h4>
                                <div class="check_box_area">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea @if (Session::has('msg')) disabled @endif class="form-control"
                                                    rows="4" id="message" name="description"
                                                    placeholder="Please write here..."></textarea>
                                                @error('description') <span
                                                    class="error text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="block rounded">
                        <div class="block-content block-content-full">
                            <div class="case_details_area_bottom">
                                <div class="check_box_area">
                                    @if (count($question)>0)
                                    <h5>Please answer the questions: </h5>
                                    @forelse ($question as $item)
                                    <h6>{{$loop->iteration}} . {{$item->question_name}}</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea @if (Session::has('msg')) disabled @endif
                                                    class="form-control" rows="4" id="message"
                                                    name="{{$item->question_serial}}"
                                                    placeholder="Please write here..."></textarea>
                                                @error('{{$item->question_serial}}') <span
                                                    class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @empty

                                    @endforelse
                                    @endif
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                @if (Session::has('msg'))
                                                <button id="addbtn" class="text-left btn btn-success" disabled>
                                                    Case Added
                                                </button>
                                                @else
                                                <button id="addbtn" class="text-left add_btn_style" type="submit">
                                                    Add Case
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function preview_images(){
                                var total_file=document.getElementById("images").files.length;
                                    for(var i=0;i<total_file;i++){
                                        $('#image_preview').append("<div class='col-md-3'><img class='img-fluid' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
                                    }
                                }
                </script>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="block rounded">
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
                                    class="custom-file-input" data-show-upload="false" data-show-caption="true" multiple
                                    data-show-upload="true" multiple>
                                @error('images') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <label class="custom-file-label" for="customFile" name='submit_image'
                                    value="Upload Multiple Image"> <i class="fas fa-image"></i> Choose Multiple
                                    Image</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="addCasePayment" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_header_style">
                        <h5 class="modal-title" id="exampleModalLabel">Pay Now</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="needs-validation d-flex flex-column justify-content-center"
                            novalidate>
                            <img src="{{asset('assets/media/payment-method.png')}}"
                                class="img-fluid h-50 w-50 mb-4 m-auto" alt="payment-img">
                            @csrf
                            <input type="hidden" class="form-control" id='total_price' name='total_price'
                                @if(Session::has('msg')) value='{{session('msg')['casePrice']}}' @endif>
                            <input type="hidden" class="form-control" id='case_id' name='case_id'
                                @if(Session::has('msg')) value='{{session('msg')['case_id']}}' @endif>

                            <div class="form-group">
                                <input type="tel" value='{{auth()->user()->phone?auth()->user()->phone:''}}'
                                    class="form-control my-3" id='cus_mobile' onkeyup="validate()" name="cus_mobile"
                                    placeholder="Mobile Number" required>
                                <textarea class="form-control mb-3 rounded" id='cus_addr' onkeyup="validate()"
                                    name="cus_addr" placeholder="Address Please"
                                    required>{{auth()->user()->address?auth()->user()->address:''}}</textarea>
                                {{-- <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="INSTRALLMENT">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Pay In Instrallment
                                    </label>
                                </div> --}}
                                <button class="btn btn-primary rounded" disabled id="sslczPayBtn"
                                    token="if you have any token validation" postdata
                                    order="If you already have the transaction generated for current order"
                                    endpoint="/pay-via-ajax">Pay With SSLCOMMERZ
                                </button>
                                @php
                                if(Session::has('msg')){
                                $url="pay-with-instalment/".session('msg')['case_id'];
                                }
                                @endphp
                                @if(Session::has('msg'))
                                <a class='btn btn-success rounded' href="{{url($url)}}">
                                    Pay In Installment
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
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
@if (Session::has('msg'))
<script>
    $('#addCasePayment').modal('show');
</script>
@endif
<script>
    function validate () {
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
