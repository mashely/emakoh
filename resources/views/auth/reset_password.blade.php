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
                                <div class="row justify-content-center g-0">
                                    <div class="col-lg-6">
                                        <div class="p-lg-5 p-4 auth-one-bg h-100">
                                            <div class="bg-overlay"></div>
                                            <div class="position-relative h-100 d-flex flex-column">
                                                <div class="mb-4">
                                                    <a href="#" class="d-block">
                                                        <i id="fp-logo">fplan-kidigital </i>
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
                                            <h5 class="text-primary">Reset Password</h5>
                                            <p class="text-muted">Reset Forgetten Password.</p>

                                            <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                                Enter your registered email and your new password.
                                            </div>
                                            <div class="p-2">
                                                <form id="reset_password">
                                                    <div class="mb-4">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Enter registered email" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password">
                                                    </div>
                                                    <div class="md-4" id="reset_alert">

                                                    </div>
                                                    
                                                    <div class="text-center mt-4">
                                                        <button class="btn btn-success w-100" id="reset_btn" type="submit"> <i class="las la-arrow-circle-right"></i> Submit</button>
                                                    </div>
                                                </form><!-- end form -->
                                            </div>
    
                                            <div class="mt-5 text-center">
                                                <p class="mb-0">Wait, I remember my password... <a href="{{ route('/')}}" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
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
           @include('layouts.footer')
            <!-- end Footer -->
        </div>
    
@endsection

@push('scripts')
    <script type="text/javascript">
    $(document).ready(function(){
        $('#reset_password').on('submit',function(e){
            e.preventDefault();
         var dataz =$(this).serialize();
            $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
  
        $.ajax({
        type:'POST',
        url:"{{ route('reset.password')}}",
        data:dataz,
        success:function(response){
            console.log(response);
            $('#reset_alert').append('<div class="alert alert-success">'+response.message+'</div>');
            setTimeout('window.location="{{ route('/')}}"',500);
         
        },
        error:function(response){
            console.log(response.responseText);
            if (jQuery.type(response.responseJSON.errors) == "object") {
              $('#reset_alert').html('');
            $.each(response.responseJSON.errors,function(key,value){
                $('#reset_alert').append('<div class="alert alert-danger">'+value+'</div>');
            });
            } else {
               $('#reset_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
            }
        },
        beforeSend : function(){
            $('#reset_btn').html('<span class="las la-spinner las-pulse las-spin"></span> Submiting ---');
            $('#reset_btn').attr('disabled', true);
        },
       complete : function(){
            $('#reset_btn').html('<span class=" las la-arrow-circle-right"></span> Submit');
            $('#reset_btn').attr('disabled', false);
        }
        });
    });
    });
  </script>
    
@endpush
