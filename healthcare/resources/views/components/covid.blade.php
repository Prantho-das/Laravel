<div class="covidinfo" style="">
    <img data-toggle="modal" data-target="#staticBackdrop" src="{{asset('assets/media/covid-19.svg')}}"
        style="cursor:pointer">

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="close m-3 ml-auto" data-dismiss="modal" aria-label="Close"> <span class="cross"
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 pb-5">
                    <h3 class='text-center mb-3'>Latest Corona Update of Bangladesh</h3>
                    {{-- <h4 class='text-center' id=''>
                    @php
                        $time = "1619719183803";
                        echo date("Y-m-d H:i:s A", $time);
                    @endphp
                    </h4> --}}
                    <h5 class='text-center rounded bg-info mx-auto mb-4' style='width:auto;height:0.2rem;'></h5>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div style='height:200px; border:1px dashed red' class="card rounded p-2 align-items-center text-center shadow-md">
                                <img src="{{asset('assets/media/deadly.png')}}" class="img-fluid mb-2" alt="" width="70%">
                                <div class="card-body">
                                    <h5 class='text-center font-bold mb-2'>Death</h5>
                                    <h4 class='text-center' id='death'>Updating...</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div style='height:200px;border:1px dashed #00a79d' class="card rounded p-2 align-items-center text-center shadow-md">
                                <img src="{{asset('assets/media/fever.png')}}" class="img-fluid mb-2" alt="" width="70%">
                                <h5 class='text-center font-bold mb-2'>New Effected</h5>
                                <h4 class='text-center' id='newEffected'>Updating...</h4>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div style='height:200px;border:1px dashed #8dc63f ' class="card rounded p-2 align-items-center text-center shadow-md">
                                <img src="{{asset('assets/media/disease-prevention.png')}}" class="img-fluid mb-2"
                                    alt="" width="70%">
                                <h5 class='text-center font-bold mb-2'>New Recovered</h5>
                                <h4 class='text-center' id='recovered'>Updating...</h4>
                            </div>

                        </div>
                        <div class="col-md-3 col-12">
                            <div style='height:200px;border:1px dashed #27aae1' class="card rounded p-2 align-items-center text-center p-2 shadow-md">
                                <img src="{{asset('assets/media/fever (1).png')}}" class="img-fluid mb-2" alt="" width="70%">
                                <h5 class='text-center font-bold mb-2'>Total Effected</h5>
                                <h4 class='text-center' id='totalEffected'>Updating...</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
