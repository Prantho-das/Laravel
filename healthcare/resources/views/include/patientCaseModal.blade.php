<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header modal_header_style">
                        <h5 class="modal-title" id="exampleModalLabel">Select Problem Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @php
                               $category= DB::table('doctor_categories')->where('category_status',0)->get();
                            @endphp
                        @forelse ($category as $catItem)
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('storage/image/'.$catItem->category_img) }}" class="card-img-top img-fluid" alt="Catagory Image{{$catItem->category_img}}" style="height: 290px;">
                                <div class="card-body">
                                    <h5 class="card-title">{{$catItem->category_name}}</h5>
                                    <p class="card-text text-justify">{{$catItem->category_description}}</p>
                                    <a href="{{url('patient/add_case/'.encrypt($catItem->id))}}" class="btn btn-primary">Add Case</a>
                                </div>
                            </div>
                        </div>
                        @empty
                            <h2 class='text-center text-warning mx-auto display-5'>We Are Working On It, Please Stay With Us<i
                                    class="fas fa-smile text-info"></i>
                            </h2>
                        @endforelse
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel_btn_style" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
