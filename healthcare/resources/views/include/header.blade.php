<header id="page-header" class='PageHeader'>
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <button type="button" class="btn btn-sm btn-dual mr-2 sideBarButton" data-toggle="layout"
                data-action="sidebar_toggle">
                <i class="fa fa-fw fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->
            <!-- END Toggle Mini Sidebar -->
            @if (Auth::user()->role!=="PATIENT")
            <!-- END Open Search Section -->
            @livewire('search')
            <!-- END Search Form -->
            @endif
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            @if (auth()->user()->role!='ADMIN')
            @livewire('inbox-notify')
            @endif

            <!-- Notifications Dropdown -->
            <div class="dropdown d-inline-block ml-2">
         @livewire('all-notification')
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm"
        aria-labelledby="page-header-notifications-dropdown" >
        @livewire('all-notification-dropdown')
    </div>
</div>
            <!-- END Notifications Dropdown -->

            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="rounded" src="
                    @if (Auth::user()->avatar)
                        {{asset('storage/image/'.Auth::user()->avatar)}}
                        @else
                        https://s.gravatar.com/avatar/{{md5( strtolower( trim(Auth::user()->email)))}}
                        @endif
                        " alt="Header Avatar" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">{{ucfirst(trans(Auth::user()->f_name))}}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="
                    @if (Auth::user()->avatar)
                        {{asset('storage/image/'.Auth::user()->avatar)}}
                    @else
                        https://s.gravatar.com/avatar/{{md5( strtolower( trim(Auth::user()->email)))}}
                    @endif" alt="">
                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase">User Options</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{url("user_profile")}}">
                            <span>Profile</span>
                            <span>
                                <i class="si si-user ml-1"></i>
                            </span>
                        </a>
                        @if (Auth::user()->role==='ADMIN')
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{url('admin/setting')}}">
                            <span>Settings</span>
                            <i class="si si-settings"></i>
                        </a>
                        @endif
                        <form class="dropdown-item d-flex align-items-center justify-content-between"
                            action='{{route('logout')}}' method='post'>
                            @csrf
                            <button class='border-0 bg-transparent'>Log Out</button>
                            <i class="si si-logout ml-auto"></i>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->
</header>
