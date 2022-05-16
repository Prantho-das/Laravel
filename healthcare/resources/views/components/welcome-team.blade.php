<section class="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>Meet the Doctor </h2>
                    <p>Our doctors are experts in their fields, with many years of experience providing high-quality care.</p>
                </div>
            </div>
            <div class="slider-active owl-carousel fix">
                @forelse ($team as $item)
                <div class="team-member">
                    <div class="team-img">
                        <img src="
                        @if ($item->avatar)
                        {{asset('storage/image/'.$item->avatar)}}
                    @else
                        https://ui-avatars.com/api/?name={{$item->f_name}}+{{$item->l_name}}&background=random&size=373.333
                    @endif" class="img-fluid rounded w-100" alt="{{$item->avatar}}">
                    </div>
                    <div class="team-content">
                        <h4>{{$item->f_name}} {{$item->l_name}}</h4>
                        <span>{{$item->specialization?$item->specialization->specilization:'N/A'}}</span>
                    </div>
                </div>
                @empty
                <h2 class='text-center text-warning mx-auto display-5'>We Are Working On It, Please Stay With Us.<i
                        class="fas fa-smile text-info"></i>
                </h2>
                @endforelse
            </div>
        </div>
    </div>
</section>
