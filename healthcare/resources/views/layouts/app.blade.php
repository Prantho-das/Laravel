<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!--End Google Font -->

    <!--Css start here-->
    <link rel="stylesheet" href="{{asset('assets/vendors/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontCss/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">

    @yield('stylesheet')
    <style>
        /*==========================================================================Chrome Frame
        prompt==========================================================================*/
        .chromeframe {
            margin: 0.2em 0;
            background: #ccc;
            color: #000;
            padding: 0.2em 0;
        }

        /*==========================================================================Author's custom
        styles==========================================================================*/
        #loader-wrapper {
            position: fixed;
            top:
                0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999999;
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top:
                50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #3498db;
            -webkit-animation: spin 2s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation:
                spin 2s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
            z-index: 1001;
        }

        #loader:before {
            content: "";
            position:
                absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #e74c3c;
            -webkit-animation: spin 3s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation:
                spin 3s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
        }

        #loader:after {
            content: "";
            position: absolute;
            top:
                15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color:
                #f9c922;
            -webkit-animation: spin 1.5s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 1.5s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                /*
        Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);
                /* IE 9 */
                transform: rotate(0deg);
                /* Firefox 16+, IE
        10+, Opera */
            }

            100% {
                -webkit-transform: rotate(360deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform:
                    rotate(360deg);
                /* IE 9 */
                transform: rotate(360deg);
                /* Firefox 16+, IE 10+, Opera */
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);
                /* IE 9 */
                transform: rotate(0deg);
                /* Firefox 16+, IE 10+, Opera */
            }

            100% {
                -webkit-transform: rotate(360deg);
                /* Chrome, Opera 15+,
        Safari 3.1+ */
                -ms-transform: rotate(360deg);
                /* IE 9 */
                transform: rotate(360deg);
                /* Firefox 16+, IE 10+, Opera
        */
            }
        }

        #loader-wrapper .loader-section {
            position: fixed;
            top: 0;
            width: 51%;
            height: 100%;
            background: #222222;
            z-index:
                1000;
            -webkit-transform: translateX(0);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: translateX(0);
            /* IE 9 */
            transform: translateX(0);
            /* Firefox 16+, IE 10+, Opera */
        }

        #loader-wrapper .loader-section.section-left {
            left:
                0;
        }

        #loader-wrapper .loader-section.section-right {
            right: 0;
        }

        /* Loaded */
        .loaded #loader-wrapper .loader-section.section-left {
            -webkit-transform: translateX(-100%);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform:
                translateX(-100%);
            /* IE 9 */
            transform: translateX(-100%);
            /* Firefox 16+, IE 10+, Opera */
            -webkit-transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355,
                    1.000);
        }

        .loaded #loader-wrapper .loader-section.section-right {
            -webkit-transform: translateX(100%);
            /* Chrome, Opera 15+,
        Safari 3.1+ */
            -ms-transform: translateX(100%);
            /* IE 9 */
            transform: translateX(100%);
            /* Firefox 16+, IE 10+, Opera
        */
            -webkit-transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .loaded #loader {
            opacity: 0;
            -webkit-transition: all 0.3s ease-out;
            transition:
                all 0.3s ease-out;
        }

        .loaded #loader-wrapper {
            visibility: hidden;
            -webkit-transform: translateY(-100%);
            /* Chrome, Opera
        15+, Safari 3.1+ */
            -ms-transform: translateY(-100%);
            /* IE 9 */
            transform: translateY(-100%);
            /* Firefox 16+, IE 10+,
        Opera */
            -webkit-transition: all 0.3s 1s ease-out;
            transition: all 0.3s 1s ease-out;
        }

        /* JavaScript Turned Off */
        .no-js #loader-wrapper {
            display: none;
        }
    </style>

</head>

<body>

    @yield('body')

    <!-- END Page Container -->
    <script src="{{asset('assets/bootstrap/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/font-awesome.js')}}"></script>
    @yield('script')
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
</body>

</html>
