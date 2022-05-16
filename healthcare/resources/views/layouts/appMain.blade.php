<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>MediCare | @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <script src="{{asset('assets/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/alpine.min.js')}}" defer></script>
    <script src="{{asset('assets/bootstrap/jquery-3.4.1.min.js')}}">
    </script>
    <script src="{{asset('assets/bootstrap/popper.min.js')}}">
    </script>
    <script src="{{asset('assets/bootstrap/bootstrap.min.js')}}">
    </script>

    <link href="{{asset('assets/editor/summernote-bs4.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/editor/summernote-bs4.min.js')}}"></script>

    <!--jquery-->
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">

    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/halthcare.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <style>
        .note-editable p img {
            width: 200px !important;
        }

        .inbox span img {
            width: 200px !important;
        }

        @media print {
            #printPageButton {
                display: none;
            }

            .print {
                display: block;
                overflow: hidden;
                background: none !important;
            }
        }
    </style>
    @yield('style')

    @livewireStyles
    @livewireScripts
</head>

<body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
        <!-- END Sidebar -->
        @yield('navbar')
        <!-- Header -->
        @include('include.header')
        <!-- END Header -->
        @yield('main')

        {{-- <script src="{{asset('assets/js/halthcare.core.min.js')}}"></script> --}}
        <script src="{{asset('assets/js/halthcare.app.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/halthcare_dashboard.min.js')}}"></script>
        <script src="{{asset('assets/js/Chart.min.js')}}"></script>
        <script src="{{asset('assets/js/toastr.min.js')}}"></script>
        @yield('script')
        @yield('script-chart')
        <script src="{{asset('assets/js/main.js')}}"></script>
        @if (Session:: has('msg'))
        <script>
            toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
        </script>
        @endif
        @error('email')
        <script>
            toastr["error"]("{{$message}}")
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
        </script>
        @enderror
        {{-- <script>(function(w, d) { w.CollectId = "607753845cb4bc656e2bc18b"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script> --}}
</body>

</html>
