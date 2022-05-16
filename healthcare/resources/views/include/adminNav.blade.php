<nav id="sidebar" class="MainSideBar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        @include('include.logo')
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/dashboard')?'active':''}}" href="{{url('admin/dashboard')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name text-capitalize">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/case*')?'active':''}}" href="{{url('admin/case')}}">
                    <i class='nav-main-link-icon fas fa-stethoscope'></i>
                    <span class="nav-main-link-name text-capitalize">Cases</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/doctor*')?'active':''}}" href="{{url('admin/doctor')}}">
                    <i class='nav-main-link-icon fas fa-user-md'></i>
                    <span class="nav-main-link-name text-capitalize">Doctors</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/patient*')?'active':''}}" href="{{url('admin/patient')}}">
                    <i class='nav-main-link-icon fas fa-wheelchair'></i>
                    <span class="nav-main-link-name text-capitalize">Patients</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/category*')?'active':''}}" href="{{url('admin/category')}}">
                    <i class='nav-main-link-icon fas fa-book-dead'></i>
                    <span class="nav-main-link-name text-capitalize">Category</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/symptom*')?'active':''}}" href="{{url('admin/symptom')}}">
                    <i class="nav-main-link-icon fa fa-question" aria-hidden="true"></i>
                    <span class="nav-main-link-name text-capitalize">Symptom</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/payment')?'active':''}}" href="{{url('admin/payment')}}">
                    <i class="nav-main-link-icon si si-credit-card"></i>
                    <span class="nav-main-link-name text-capitalize">Payment</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/subscription')?'active':''}}" href="{{url('admin/subscription')}}">
                    <i class="nav-main-link-icon si si-star"></i>
                    <span class="nav-main-link-name text-capitalize">subscription</span>
                </a>
            </li>
            {{-- <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/setting')?'active':''}}" href="{{url('admin/setting')}}">
                    <i class="nav-main-link-icon si si-settings"></i>
                    <span class="nav-main-link-name text-capitalize">Settings</span>
                </a>
            </li> --}}
            <hr>
            <!-- <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/email*')?'active':''}}" href="{{url('admin/email')}}">
                    <i class="nav-main-link-icon si si-info"></i>
                    <span class="nav-main-link-name text-capitalize">Help Center</span>
                </a>
            </li> -->

        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
<!-- END Sidebar -->
