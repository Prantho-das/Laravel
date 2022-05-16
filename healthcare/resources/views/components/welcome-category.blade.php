<section class="pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>Our Price</h2>
                    <p>We calculate the patient fee you pay by looking at your health problem. What you pay depends on your Disease. Choose
                    your Disease to see fees that apply to you.</p>
                </div>
            </div>

            <div class="price-slider-active owl-carousel fix push-100">
                @forelse ($category as $item)
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-uppercase text-center">{{$item->category_name}}</h2>
                        <h6 class="card-price text-center">{{$item->case_price}} tk<span class="period">/per case</span>
                        </h6>
                        <hr>
                        <p>{{ \Illuminate\Support\Str::limit($item->category_description, 197, $end='...') }}</p>
                        <!-- <p>{{$item->category_description?$item->category_description:'N/A'}}</p> -->
                        <a href="{{url('login')}}" class="btn btn-block text-uppercase">Join Now</a>
                </div>
                </div>
                @empty
            </div>
            <h2 class='text-center text-warning mx-auto display-5'>We Are Working On It, Please Stay With Us<i class="fas fa-smile text-info"></i>
            </h2>
            @endforelse


        </div>
    </div>
</section>
