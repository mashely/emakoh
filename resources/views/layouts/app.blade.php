<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

    
<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Apr 2022 19:50:52 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>fplan-kidigital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Digital Hospital" name="Digital Reminder" />
        <meta content="Hospital" name="Bluetick Technology" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!-- Layout config Js -->
        <script src="{{ asset('assets/js/layout.js')}}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />


    </head>

    <body>

      @yield('content')

    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{ asset('assets/js/plugins.js')}}"></script>
        {{-- notify --}}
        <script src="{{ asset('assets/notify/notify.js')}}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('assets/js/pages/password-addon.init.js')}}"></script>
    @stack('scripts')
    </body>


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Apr 2022 19:50:52 GMT -->
</html>