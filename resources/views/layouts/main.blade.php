<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Apr 2022 19:38:35 GMT -->
<head>

    <meta charset="utf-8" />
    <title>edigital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Digital Hospital" name="Digital Reminders" />
    <meta content="Hospital" name="Bluetick Technology" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">
      <!-- gridjs css -->

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>


    <!-- jsvectormap css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />

    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('assets/swtalrt/sweetalert.css')}}">

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
    <style>
      #required-field{
        color: red;
      }
    </style>


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('layouts.header')
        <!-- ========== App Menu ========== -->
       @include('layouts.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

           @yield('content')
            <!-- End Page-content -->

           @include('layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->


    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src=" {{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src=" {{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src=" {{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src=" {{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src=" {{ asset('assets/js/plugins.js') }}"></script>
    <script src=" {{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>


    {{-- <!-- apexcharts -->
         {{-- sweet alert --}}
    <script src="{{ asset('assets/swtalrt/jquery.sweet-alert.custom.js')}}"></script>
    <script src="{{ asset('assets/swtalrt/sweetalert.js')}}"></script>

    <!-- Vector map-->
    {{-- <script src=" {{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src=" {{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script> 

    <!--Swiper slider js-->
    <script src=" {{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    {{-- notify --}}
    <script src="{{ asset('assets/notify/notify.js')}}"></script>


    {{-- datatable --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    {{-- end of table --}}

    {{-- e-chart --}}
     <!-- echarts js -->
     <script src="{{ asset('assets/libs/echarts/echarts.min.js')}}"></script>
        
     <!-- echarts init -->
     <script src="{{ asset('assets/js/pages/echarts.init.js')}}"></script>

    <!-- App js -->
    <script src=" {{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready( function () {
        $('#table_id').DataTable();
        } );
    </script>
   
    @stack('scripts')

    <script>

    function disable_user(id){
      var csrf_tokken =$('meta[name="csrf-token"]').attr('content');
      swal({
      title: "Disable User",
      text: "Are you sure you want to Disable this User?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#0D6855",
      confirmButtonText: "Yes, Disable",
      closeOnConfirmation: false
    },
    function(){
      $.ajax({
            url: "{{ route('disable.user')}}", 
            method: "POST",
            data: {my_id:id,'_token':csrf_tokken},
            success: function(response)
           {  
            $.notify(response.message,'success');
            setTimeout(function(){
             location.reload();
            },1000);
            },
            error: function(response){
                console.log(response.responseText);
                $.notify(response.responseJson.errors,'error');  
            }
        });
    }
    );
  }

    function enable_user(id){
      var csrf_tokken =$('meta[name="csrf-token"]').attr('content');
      swal({
      title: "Enable User",
      text: "Are you sure you want to Enable this User?",
      type: "success",
      showCancelButton: true,
      confirmButtonColor: "#0D6855",
      confirmButtonText: "Yes, Enable",
      closeOnConfirmation: false
    },
    function(){
      $.ajax({
            url: "{{ route('enable.user')}}", 
            method: "POST",
            data: {my_id:id,'_token':csrf_tokken},
            success: function(response)
           {  
            $.notify(response.message,'success');
            setTimeout(function(){
             location.reload();
            },1000);
            },
            error: function(response){
                console.log(response.responseText);
                $.notify(response.responseJson.errors,'error');  
            }
        });
    }
    );
  }
    </script>
   
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Apr 2022 19:42:32 GMT -->
</html>