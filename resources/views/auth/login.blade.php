@extends('layouts.app')
@section('content')
<style>
    #fp-logo{
        color: white;
        font-size: 25px;
        font-weight: 900;
    }
</style>
  <!-- auth-page wrapper -->
  <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="#" class="d-block">
                                                <i id="fp-logo">fplan-kidigital </i>
                                                {{-- <img src="assets/images/logo-light.png" alt="" height="18"> --}}
                                            </a>
                                        </div>
                                        <div class="mt-auto">
                                            <div class="mb-3">
                                                <i class="ri-double-quotes-l display-4 text-success"></i>
                                            </div>

                                            <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active"
                                                        aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1"
                                                        aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2"
                                                        aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner text-center text-white-50 pb-5">
                                                    <div class="carousel-item active">
                                                        <p class="fs-15 fst-italic">" Time and health are two precious assets that we don’t recognize and appreciate until they have been depleted. "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" A good laugh and a long sleep are the best cures in the doctor’s book."</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Physical fitness is the first requisite of happiness. "</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end carousel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Welcome Back</h5>
                                        <p class="text-muted">Sign in to continue to fplankidigital.</p>
                                    </div>

                                    <div class="mt-4">
                                        <form id="user_auth">

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username / Email </label>
                                                <input type="email" class="form-control" id="username" name="username" placeholder="Enter username / Email" required>
                                            </div>

                                            <div class="mb-3">

                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" name="remember" type="checkbox" value="1" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                <div class="float-end">
                                                    <a href="{{ route('forgot.password')}}" class="text-muted">Forgot password?</a>
                                                </div>
                                            </div>

                                            <div class="mb-3" id="user_auth_alert">

                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" name="submit" id="user_btn" type="submit"> <i class="bx bx-lock-open-alt"></i> Sign In</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script> Designed ,Developed and Maintained by Fp Kidijitali</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#user_auth').on('submit',function(e){
            e.preventDefault();
         var dataz =$(this).serialize();
            $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        $.ajax({
        type:'POST',
        url:"{{ route('authentication')}}",
        data:dataz,
        success:function(response){
            console.log(response);
          $.notify(response.message,'success');
          setTimeout(function(){
            window.location.href=response.url;
          },500);
        },
        error:function(response){
            console.log(response.responseText);
            if (jQuery.type(response.responseJSON.errors) == "object") {
              $('#user_auth_alert').html('');
            $.each(response.responseJSON.errors,function(key,value){
                $('#user_auth_alert').append('<div class="alert alert-danger">'+value+'</div>');
            });
            } else {
               $('#user_auth_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
            }
        },
        beforeSend : function(){
            $('#user_btn').html('<span class="las la-spinner las-pulse las-spin"></span> Authenticating ---');
            $('#user_btn').attr('disabled', true);
        },
       complete : function(){
            $('#user_btn').html('<span class="bx bx-lock-open-alt"></span> Sign In');
            $('#user_btn').attr('disabled', false);
        }
        });
    });
    });
  </script>

@endpush
