<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="{{url('patient/dashboard')}}">
            <span class="smini-hide">
                <span class="font-w700 font-size-h5">@include('include.logo')</span>
            </span>
        </a>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link
                 @if (Request::is('patient/dashboard*'))
                    active
                @endif
                " href="{{url('patient/dashboard')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link
                @if (Request::is('patient/case*'))
                    active
                @endif
                " href="{{url('patient/case')}}">
                    <i class='nav-main-link-icon fas fa-stethoscope'></i>
                    <span class="nav-main-link-name">Cases</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link
                @if (Request::is('patient/payment*'))
                    active
                @endif
                " href="{{url('patient/payment')}}">
                    <i class='nav-main-link-icon fas fa-clinic-medical'></i>
                    <span class="nav-main-link-name">Payment</span>
                </a>
            </li>
            <hr>
            <!-- <li class="nav-main-item">
                <a class="nav-main-link
                @if (Request::is('help'))
                    active
                @endif
                " href="{{url('help')}}">
                    <i class="nav-main-link-icon si si-info"></i>
                    <span class="nav-main-link-name">Help</span>
                </a>
            </li> -->
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
