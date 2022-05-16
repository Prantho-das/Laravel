<div class="block rounded">
    <div class="block-content block-content-full">
        <div class="case_details_area">
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <h5>Prescription: </h5>
                        <hr>
                    </div>
                    @if (Auth::user()->role==='DOCTOR')
                    @if ($caseDet->assignCase->case_status!=1)
                    @if (DB::table('specilization_of_doctors')->where('doctor_id',auth()->id())->first())
                    <div class="form-group">
                        <form method="POST" action="{{route('doctorPrescription',['id'=>$caseId])}}">
                            @csrf
                            <h3>Disease Name</h3>
                            <textarea name='disease'
                                class="myPrescription form-control mb-3 @error('disease') is-invalid @enderror"
                                placeholder="Disease Names">{{$prescription?($prescription->disease ? $prescription->disease:'..'):''}}
                            </textarea>
                            <h3>Medicine Name</h3>
                            <textarea name='medicine'
                                class="myPrescription form-control @error('medicineInput') is-invalid @enderror"
                                rows="4" placeholder="Medicine..">{{$prescription?($prescription->medicine ? $prescription->medicine:'..'):''}}
                         </textarea>
                            <br>
                            <h3>Note</h3>
                            <textarea name='prescription' id='myNote'
                                class="form-control @error('medicine') is-invalid @enderror" rows="4"
                                placeholder="Note..">{{$prescription?($prescription->note ? $prescription->note:'..'):""}}
                            </textarea>
                            <br>
                            <button type="submit" class="add_btn_style">Prescribe</button>

                        </form>
                    </div>
                    @else
                    <h5 class='text-capitalize text-danger'>
                        Please fill up your Specialization & Degrees field from your profile.
                    </h5>
                    @endif
                    @endif
                    @if ($prescription)
                    <a target='_' href="{{url('prescriptionPreview',$prescription->case_id)}}"
                        style="color: #fff; margin:-5px 0px 0px 10px;" class='add_btn_style'>Preview</a>
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myNote').summernote({
        height: 120,
        toolbar: [
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
       ]
        });


        $('.myPrescription').summernote({
           placeholder:'Write...',
           height: 120,
        });
    </script>
</div>
