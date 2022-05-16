<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        @include('include.logo')</span>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('doctor/dashboard*')?'active':""}}" href="{{url("doctor/dashboard")}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('doctor/case*')?'active':""}}" href="{{url('doctor/case')}}">
                    <i class='nav-main-link-icon fas fa-stethoscope'></i>
                    <span class="nav-main-link-name">Cases</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('doctor/patient*')?'active':""}}" href="{{url('doctor/patient')}}">
                    <i class='nav-main-link-icon fas fa-wheelchair'></i>
                    <span class="nav-main-link-name">Patients</span>
                </a>
            </li>
            <hr>
            <!-- <li class="nav-main-item">
                <a class="nav-main-link" href="{{url('help')}}">
                    <i class="nav-main-link-icon si si-info"></i>
                    <span class="nav-main-link-name">Help Center</span>
                </a>
            </li> -->
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
