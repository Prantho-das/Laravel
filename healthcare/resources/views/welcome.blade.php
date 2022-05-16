@extends('layouts.app')
@section('title')
{{ config('app.name') }}
@endsection
@section('body')

<!------------------------header html start here------------------------>
<header class="header-area sticky fixed-top bg-light">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <div class="container">
            @include('include.logo')
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#works">How It Works</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="register"
                            href="{{url(Str::lower("/".Auth::user()->role."/dashboard"))}}">Dashboard</a>
                    </li>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="register" href="{{route('register')}}">Register</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<!------------------------header html end here------------------------>
<!------------------------home html start here------------------------>
<section class="home " id="home">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="home-thumb push-150-t">
                    <img src="{{ asset('assets/media/images/home-header.svg') }}" class="img-fluid w-100"
                        alt="Home Main Image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="home-content">
                    <h2 class="push-150-t">Providing Quality Care with Patience. Safe and fast.</h2>
                    <p>Medicare is a digital healthcare service for an disease that helps you to check your diseases, advice, and
                        other services accessible to all.</p>
                    <a href="{{route('login')}}" class="btn btn-h">contact with us</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!------------------------home html end here------------------------>
<!------------------------about html start here------------------------>
<section class="about" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-thumb">
                    <img src="{{ asset('assets/media/images/about-us.png') }}" class="img-fluid w-100" alt="About Us">
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="about-content">
                    <h2 class="push-100-t">About Us</h2>
                    <p>We think it should be easy to get access to the care you need. Medicare is founded by doctors
                        with an ambition to give more people the opportunity to easily and safely check out skin disease
                        and diseases that they are worried about.</p>
                    <p>Through digital technology, Medicare offers the whole country the opportunity to get quick care
                        of its skin diseases. Since we collaborate with doctors, we get a good solution for you.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------about html end here------------------------>
<!------------------------We Treat start here------------------------>
<section class="treat" id="treat">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="treat-content">
                    <h2 class="push-50-t">We Treat Non-Emergency Conditions</h2>
                    <ul>
                        <li class="push-20-l"> Common Cold </li>
                        <li class="push-20-l"> Allergies</li>
                        <li class="push-20-l"> Constipation </li>
                        <li class="push-20-l"> Cough</li>
                        <li class="push-20-l"> Diarrhea</li>
                        <li class="push-20-l"> Ear Problems</li>
                        <li class="push-20-l"> Fever</li>
                        <li class="push-20-l"> Respiratory Problems</li>
                        <li class="push-20-l"> Sore throat</li>
                        <li class="push-20-l"> Headache</li>
                        <li class="push-20-l"> Vomiting</li>
                        <li class="push-20-l"> Rash and more...</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-thumb">
                    <img src="{{ asset('assets/media/images/NoPath - Copy (54).png') }}" class="img-fluid w-100"
                        alt="About Us">
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------We Treat end here------------------------>

<!------------------------how it works  html start here------------------------>
<section class="how-work" id='works'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>How It Works </h2>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="how-work-content">
                    <div class="work-icon">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <h3>Join with Us</h3>
                    <p>We work with few specialist for you to check out a disease you are worried about. You do not
                        need to book an appointment. Registration here and tell the staff that you want to check your problem.</p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="how-work-content">
                    <div class="work-icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <h3>Get your report</h3>
                    <p>We work with few specialist for you to check out a disease you are worried about. You do not
                        need to book an appointment. Registration here and tell the staff that you want to check your problem.</p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="how-work-content">
                    <div class="work-icon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <h3>We are here for you</h3>
                    <p>If the investigation shows that your disease can be dangerous, we take responsibility. You
                        will receive a referral to the right body for continued care, and our experienced specialist are always here to
                        answer your questions.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------how it works  html end here------------------------>
<!------------------------services html start here------------------------>
<section class="services">
    <div class="container">
        <div class="dotted"></div>
        <div class="row">
            <div class="col-lg-3 text-center">
                <div class="services-content">
                    <div class="number">
                        <h3>1</h3>
                    </div>
                    <h4>Register</h4>
                    <p>Before you can start the survey, you need to register here. Note that we only examine diseases.</p>
                </div>
            </div>
            <div class="col-lg-3 text-center">
                <div class="services-content">
                    <div class="number">
                        <h3>2</h3>
                    </div>
                    <h4>Submit your problem</h4>
                    <p>Take your image and submit. It only takes 10 minutes, and you do not need to book an
                        appointment.</p>
                </div>
            </div>
            <div class="col-lg-3 text-center">
                <div class="services-content">
                    <div class="number">
                        <h3>3</h3>
                    </div>
                    <h4>Get Result</h4>
                    <p>Within 48 hours, when one of our specialist has examined the images, you will get your
                        result.</p>
                </div>
            </div>
            <div class="col-lg-3 text-center">
                <div class="services-content">
                    <div class="number">
                        <h3>4</h3>
                    </div>
                    <h4>Log in to see the result</h4>
                    <p>Log in here on the website to see the results of the survey, and get valuable information about
                        skin health.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------services  html end here------------------------>
<!------------------------team   html start here------------------------>
<x-welcome-team/>
<!------------------------team  html end here------------------------>
<!------------------------Price html start here------------------------>
<x-welcome-category/>
<!------------------------Price html end here------------------------>
<!------------------------apply-now  html start here------------------------>
<section class="apply-now">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="apply-now-content">
                    <div class="dots">
                        <span> </span>
                        <span> </span>
                        <span> </span>
                        <span> </span>
                    </div>
                    <ul>
                        <li class="text-1">You don’t need to book an appointment.</li>
                        <li class="text-2">Submit the picture of your disease or note.</li>
                        <li class="text-3">Response within 48 hours</li>
                        <li class="text-4">Get the affordable price with us.</li>
                    </ul>
                    <a href="/register" class="btn btn-a">Start Now</a>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="apply-now-img">
                    <img src="{{ asset('assets/media/images/process.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------apply-now html end here------------------------>
<!------------------------Subscription start here------------------------>
<section class="newsletter">
    <div class="container">
        <form action="{{route('subscription')}}" method='post'>
            @csrf
            <div class="row">
                <div class="col-lg-5">
                    <h3 class="push-15-t font-weight-normal font-primary">Subscribe to Our Newsletter</h3>
                </div>
                <div class="col-lg-4">
                        <input type="email" name='email' id="inputEmail" class="form-control" placeholder="john@mail.com" required=""
                            style="line-height: 3.2rem;">
                            <h5 class='text-light'>
                            @error('email')
                            {{$message}}
                            @enderror
                            </h5>

                </div>
                <div class="col-lg-3">
                    <button class="btn btn-block text-uppercase bg-white" type="submit"><i
                            class="fas fa-envelope-open-text"></i> Subscribe</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!------------------------Subscription End here------------------------>
<!------------------------Covid start here------------------------>
@if ($setting->covidNews==='on')
<x-covid />
@endif
<!------------------------Covid end here------------------------>
<!------------------------footer    html start here------------------------>
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-content">
                    <div class="footer-title">
                        <h4>@include('include.logo')</h4>
                    </div>
                    <p align='justify'>Medicare is a digital healthcare service for an disease that helps you to check your diseases, advice, and
                    other services accessible to all.</p>
                    <div class="social-link">
                        @forelse ($setting->social as $item)
                        <a href="{{$item}}" target="_">
                            <img src="https://www.google.com/s2/favicons?domain={{$item}}"
                                class="img-fluid rounded" alt="">
                        </a>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footer-content">
                    <div class="footer-title">
                        <h4>Sitemap</h4>
                    </div>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About us</a></li>
                        <li><a href="#works">How It Works</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footer-content">
                    <div class="footer-title">
                        <h4>Support</h4>
                    </div>
                    <ul>
                        <li><a href="#">FAQS</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Policy</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Documentation</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-content">
                    <div class="footer-title">
                        <h4>Contact Us</h4>
                    </div>
                    <ul>
                        <li><a href="#">{{$setting->address}}</a></li>
                        @forelse ($setting->contact as $item)
                        <li>
                            <a href="tel:{{'+88'.$item}}">
                                {{'+88'.$item}}
                            </a>
                        </li>
                        @empty
                        @endforelse
                        <li><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="copyright text-center">
                    <p>Copyright &#169; {{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!------------------------footer end here------------------------>
@endsection
