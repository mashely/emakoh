@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('app.client_page_title') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('app.client_register_breadcrumb') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('app.client_registration') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">{{ __('app.client_registration') }}</h4>
                    </div><!-- end card header -->
                    <div class="card-body form-steps">
                        <form class="vertical-navs-step" id="patient_reg">
                            <div class="row gy-5">
                                <div class="col-lg-3">
                                    <div class="nav flex-column custom-nav nav-pills" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link done" id="v-pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button" role="tab" aria-controls="v-pills-bill-info" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step1_basic_info') }}
                                            </span>
                                            {{ __('app.basic_information') }}
                                        </button>
                                        <button class="nav-link" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step2_address') }}
                                            </span>
                                            {{ __('app.address') }}
                                        </button>
                                        <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step3_service') }}
                                            </span>
                                            {{ __('app.service') }}
                                        </button>
                                    </div>
                                    <!-- end nav -->
                                </div> <!-- end col-->
                                <div class="col-lg-9">
                                    <div class="px-lg-4">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.client_basic_information') }}</h5>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="row g-3">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="firstName" class="form-label"> {{ __('app.first_name') }} <i id="required-field"> * </i> </label>
                                                                <input type="text" class="form-control" id="firstName" placeholder="{{ __('app.first_name') }}" name="first_name" required>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="lastName" class="form-label">{{ __('app.middle_name') }}</label>
                                                                <input type="text" class="form-control" id="middleName" placeholder="{{ __('app.middle_name') }}" name="middle_name">
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="username" class="form-label">{{ __('app.last_name') }} <i id="required-field"> * </i></label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="lastName" placeholder="{{ __('app.last_name') }}" name="last_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="DOB" class="form-label">{{ __('app.date_of_birth') }} <i id="required-field"> * </i></label>
                                                                <input type="date" class="form-control" id="dob" name="dob" max="{{ date('Y-m-d')}}">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <!-- ID Type and ID Number removed -->

                                                        <P><b>{{ __('app.note_required_fields') }}</b></P>

                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
    nexttab" data-nexttab="v-pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>{{ __('app.go_to_address') }}</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade " id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.client_address') }}</h5>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="row g-3">
                                                        <!-- Region/District/Ward selection removed -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="Location">{{ __('app.physical_location') }} <i id="required-field"> * </i></label>
                                                            <textarea name="location" rows="7" class="form-control" placeholder="{{ __('app.write_physical_address') }}"></textarea>
                                                        </div>

                                                    </div>

                                                    <hr class="my-4 text-muted">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.phone_number') }} <i id="required-field"> * </i></label>
                                                            <input type="number" class="form-control" placeholder="{{ __('app.enter_phone_number') }}" name="phone_number">
                                                        </div>

                                                    </div>
                                                    <P style="margin-top: 15px;"><b>{{ __('app.note_required_fields') }}</b></P>

                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('app.back_to_basic_info') }}</button>
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
    nexttab" data-nexttab="v-pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> {{ __('app.go_to_service') }}</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.type_of_service') }}</h5>
                                                </div>

                                                <div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <label for="cc-number" class="form-label">{{ __('app.type_of_service_label') }} <i id="required-field"> * </i></label>
                                                            <select name="service" class="form-select" id="">
                                                                <option value="" selected>{{ __('app.please_select_type_of_service') }}</option>
                                                                @foreach ($services as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="cc-expiration" class="form-label">{{ __('app.start_date_label') }} <i id="required-field"> * </i></label>
                                                            <input type="date" class="form-control" name="start_date" min="{{ date('Y-m-d')}}" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="cc-cvv" class="form-label">{{ __('app.end_date_label') }} <i id="required-field"> * </i></label>
                                                            <input type="date" class="form-control" name="end_date" min="{{ date('Y-m-d')}}" required>
                                                        </div>
                                                        <div class="col-md-12" id="patient_alert"></div>
                                                    </div>
                                                    <P style="margin-top: 15px;"><b>{{ __('app.note_required_fields') }}</b></P>

                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('app.back_to_address_info') }}</button>
                                                    <button type="button" id="patient_btn" class="btn btn-success btn-label right ms-auto nexttab
    nexttab" ><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> {{ __('app.submit_client') }}</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                </div>
                                <!-- end col -->

                                {{-- <div class="col-lg-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fs-14 text-primary mb-0"><i class="ri-shopping-cart-fill align-middle me-2"></i> Your cart</h5>
                                        <span class="badge bg-danger rounded-pill">3</span>
                                    </div>
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Product name</h6>
                                                <small class="text-muted">Brief description</small>
                                            </div>
                                            <span class="text-muted">$12</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Second product</h6>
                                                <small class="text-muted">Brief description</small>
                                            </div>
                                            <span class="text-muted">$8</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Third item</h6>
                                                <small class="text-muted">Brief description</small>
                                            </div>
                                            <span class="text-muted">$5</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between bg-light">
                                            <div class="text-success">
                                                <h6 class="my-0">Discount code</h6>
                                                <small>−$5 Discount</small>
                                            </div>
                                            <span class="text-success">−$5</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total (USD)</span>
                                            <strong>$20</strong>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- end row -->
                        </form>
                    </div>
                </div>
                <!-- end -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll(".form-steps").forEach(function (n) {
        n.querySelectorAll(".nexttab").forEach(function (t) {
            n.querySelectorAll('button[data-bs-toggle="pill"]').forEach(function (e) {
                e.addEventListener("show.bs.tab", function (e) {
                    e.target.classList.add("done");
                });
            }),
                t.addEventListener("click", function () {
                    var e = t.getAttribute("data-nexttab");
                    document.getElementById(e).click();
                });
        }),
            n.querySelectorAll(".previestab").forEach(function (r) {
                r.addEventListener("click", function () {
                    for (var e = r.getAttribute("data-previous"), t = r.closest("form").querySelectorAll(".custom-nav .done").length, o = t - 1; o < t; o++)
                        r.closest("form").querySelectorAll(".custom-nav .done")[o] && r.closest("form").querySelectorAll(".custom-nav .done")[o].classList.remove("done");
                    document.getElementById(e).click();
                });
            });
        var l = n.querySelectorAll('button[data-bs-toggle="pill"]');
        l.forEach(function (o, r) {
            o.setAttribute("data-position", r),
                o.addEventListener("click", function () {
                    var e;
                    o.getAttribute("data-progressbar") &&
                        ((e = document.getElementById("custom-progress-bar").querySelectorAll("li").length - 1), (e = (r / e) * 100), (document.getElementById("custom-progress-bar").querySelector(".progress-bar").style.width = e + "%")),
                        0 < n.querySelectorAll(".custom-nav .done").length &&
                            n.querySelectorAll(".custom-nav .done").forEach(function (e) {
                                e.classList.remove("done");
                            });
                    for (var t = 0; t <= r; t++) l[t].classList.contains("active") ? l[t].classList.remove("done") : l[t].classList.add("done");
                });
        });
    });
</script>
<script>
      $(document).ready(function(){
        $('#patient_btn').on('click',function(e){
            e.preventDefault();

         var dataz =$("#patient_reg").serialize();

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        $.ajax({
        type:'POST',
        url:"{{ route('client.create')}}",
        data:dataz,
        success:function(response){
          console.log(response);
         // return;
          $('#patient_alert').html('<div class="alert alert-success">'+response.message+'</div>');
          setTimeout(function(){
            window.location.href="{{ route('clients.list')}}";
        },500);

        },
        error:function(response){
            console.log(response.responseText);
            if (jQuery.type(response.responseJSON.errors) == "object") {
              $('#patient_alert').html('');
            $.each(response.responseJSON.errors,function(key,value){
                $('#patient_alert').append('<div class="alert alert-danger">'+value+'</div>');
            });
            } else {
               $('#patient_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
            }
        },
        beforeSend : function(){
                     $('#patient_btn').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Submiting ---');
                     $('#patient_btn').attr('disabled', true);
                },
                complete : function(){
                  $('#patient_btn').html('<i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Submit');
                  $('#patient_btn').attr('disabled', false);
                }
        });
    });
    });
</script>
<script>

        $(document).ready(function(){
            $('#region_id').change(function(){
            var region_id = $('#region_id').val();
            if(region_id != ' '){
            $.ajax({
                url:"{{ url('/get_district')}}" +'/' + region_id,
                data:{'_method':'GET'},
                dataType: 'json',
                success:function(data){
                  $('#district_id').html(data);
                }
            });
            }
            });
        });

        $(document).ready(function(){
            $('#district_id').change(function(){
            var district_id = $('#district_id').val();
            if(district_id != ' '){
            $.ajax({
                url:"{{ url('/get_ward')}}" +'/' + district_id,
                data:{'_method':'GET'},
                dataType: 'json',
                success:function(data){
                  $('#ward_id').html(data);
                }
            });
            }
            });
        });
</script>

@endpush
