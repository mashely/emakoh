@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Hospitals</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hospitals</a></li>
                            <li class="breadcrumb-item active">Hospitals</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">Hospitals</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3 ">
                                <div class="col-sm-auto text-right">
                                    <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" data-bs-target="#showModal" >
                                                <i class="ri-add-line align-bottom me-1"></i> Add Hospital
                                            </button>

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap table-hover table-striped" id="table_id">
                                    <thead class="table-light">
                                        <tr>
                                            <th >#</th>
                                            <th>Registration Date</th>
                                            <th>Hospital Name</th>
                                            <th>Address</th>
                                            <th>Contact Person</th>
                                            <th>Status</th>
                                            <th>Reminders</th>
                                            <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hospitals as $hospital)
                                        <tr>
                                            <td >{{ $loop->iteration }}</td>
                                            <td>{{ date("d-M-Y",strtotime($hospital->created_at)) }}</td>
                                            <td>{{ $hospital->name}}</td>
                                            <td >R-{{ $hospital->region?->name ?? 'N/A' }} <br>
                                                D-{{ $hospital->district?->name ?? 'N/A' }} <br>
                                                W-{{ $hospital->ward?->name ?? 'N/A' }}
                                            </td>
                                            <td >F:N-{{ $hospital->personel?->name ?? 'N/A' }} <br>
                                                P:N -{{ $hospital->personel?->phone_number ?? 'N/A' }}
                                            </td>
                                            <td>
                                                @if ($hospital->status == "Active")
                                                <span class="badge badge-soft-success text-uppercase">Active</span>
                                                @else
                                                <span class="badge badge-soft-danger text-uppercase">InActive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('hospital.reminders',$hospital->id )}}">
                                                <button class="btn btn-primary"><i class=" bx bx-list-ul"></i> Reminders </button>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#showModal-edit"
                                                data-id ={{ $hospital->id}} data-name ={{ $hospital->name }}
                                                data-region ={{ $hospital->region->name   }}  data-district ={{ $hospital->district->name   }}
                                                data-region_id ={{ $hospital->region_id  }}  data-district_id ={{ $hospital->district_id  }}
                                                data-ward ={{ $hospital->ward->name }}  data-ward_id ={{ $hospital->ward_id }} data-location ={{ $hospital->location }}
                                                data-contact_person ={{ $hospital->personel->name }} data-msisdn ={{ $hospital->personel->phone_number }}
                                                data-designation ={{ $hospital->personel->designation }}
                                                ><i class="bx bx-edit"></i> Edit </button>
                                            </td>

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->


        <!-- end row -->

       <!-- Modal -->
    <!--end modal -->
        <!-- end row -->

        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Add Hospital</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="card-body form-steps">
                    <form id="registration_form">
                        <div id="custom-progress-bar" class="progress-nav mb-4">
                            <div class="progress" style="height: 1px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false">2</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false">3</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                                <div>
                                    <div class="mb-4">
                                        <div>
                                            <h5 class="mb-1 text-center">General Information</h5>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital"> Hospital Name <span id="required-field">*</span> </label>
                                        <input type="text" class="form-control" name="name"  placeholder="Enter Hospital name">
                                    </div>
                                    <!-- Hospital contact and email removed -->
                                    <P style="margin-top: 15px;"><b>NOTE: Those field marked with <span id="required-field">*</span> are mandatory field</b></P>

                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Address</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                                <div>
                                    <div class="mb-4">
                                        <div>
                                            <h5 class="mb-1 text-center">Address Information</h5>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Region <span id="required-field">*</span> </label>
                                        <select class="form-select" name="region" id="region_id" >
                                            <option value="">Please Choose Region</option>
                                            @foreach ($regions as $item)
                                            <option value="{{ $item->reg_code }}">{{ $item->reg_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">District <span id="required-field">*</span> </label>
                                        <select class="form-select" name="district" id="district_id">
                                            <option value="" selected>Please Choose District</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Ward <span id="required-field">*</span> </label>
                                        <select name="ward" class="form-select"  id="ward_id">
                                            <option value="" selected>Please Choose Ward</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label" for="gen-info-description-input">Physical Location</label>
                                        <textarea class="form-control" placeholder="Enter Description" id="gen-info-description-input" name="location" rows="2"></textarea>
                                    </div>
                                    <P style="margin-top: 15px;"><b>NOTE: Those field marked with <span id="required-field">*</span> are mandatory field</b></P>

                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab" ><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="pills-success-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Contact</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                                <div>
                                    <div class="mb-4">
                                        <div>
                                            <h5 class="mb-1 text-center">Contact Person</h5>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Name <span id="required-field">*</span> </label>
                                        <input type="text" class="form-control" name="person_name"  placeholder="Enter Full name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Phone Number <span id="required-field">*</span> </label>
                                        <input type="number" class="form-control" name="phone_number"  placeholder="Enter Phone Number">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Designation</label>
                                        <input type="text" class="form-control" name="designation"  placeholder="Enter Designition">
                                    </div>
                                    <div class="mb-3" id="register_alert">
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-info-desc-tab" ><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Address</button>
                                        <button type="button" id="register_btn" class="btn btn-success btn-label right ms-auto nexttab
    nexttab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                    </div>
                                    <P style="margin-top: 15px;"><b>NOTE: Those field marked with <span id="required-field">*</span> are mandatory field</b></P>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}

    <div class="modal fade" id="showModal-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Hospital Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="card" style="margin-top: -10px">
                <div class="card-body form-steps">
                    <form id="update_form">
                        {{-- <div class="text-center pt-3 pb-4 mb-1">
                            <img src="assets/images/logo-dark.png" alt="" height="17">
                        </div> --}}
                        <div class="step-arrow-nav mb-4">

                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true">General</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false">Address</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Contact Person</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Hospital Name</label>
                                        <input type="text" class="form-control" name="name"  id="name">
                                        <input type="hidden" name="hospital_id" id="hospital_id">
                                    </div>
                                    <!-- Hospital contact and email removed -->
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Address info</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade " id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Region</label>
                                        <select class="form-select" name="region" id="region_id" >
                                            <option id="region" value="" selected></option>
                                            @foreach ($regions as $item)
                                            <option value="{{ $item->id }}">{{ $item->reg_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">District</label>
                                        <select class="form-select" name="district" id="district_id">
                                            <option id="district" selected></option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Ward</label>
                                        <select name="ward" class="form-select"  id="ward_id">
                                            <option id="ward" selected></option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label" for="gen-info-description-input">Physical Location</label>
                                        <textarea class="form-control" id="location" name="location" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General Info</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="pills-experience-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Contact Person Info</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-experience" role="tabpanel">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Name</label>
                                        <input type="text" class="form-control" name="person_name"  id="contact_person">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Phone Number</label>
                                        <input type="number" class="form-control" name="phone_number"  id="msisdn">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Designation</label>
                                        <input type="text" class="form-control" name="designation"  id="designation">
                                    </div>
                                    <div class="mb-3" id="update_alert">
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="steparrow-description-info-tab" ><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Address</button>
                                    <button type="submit" id="update_btn" class="btn btn-success btn-label right ms-auto nexttab
nexttab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Update</button>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
</div>



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
        $('#register_btn').on('click',function(e){
            e.preventDefault();

         var dataz =$("#registration_form").serialize();

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        $.ajax({
        type:'POST',
        url:"{{ route('hospital.create')}}",
        data:dataz,
        success:function(response){
          $('#register_alert').html('<div class="alert alert-success">'+response.message+'</div>');
          setTimeout(function(){
            window.location.href="{{ route('hospitals.list')}}";
        },500);

        },
        error:function(response){
            console.log(response.responseText);
            if (jQuery.type(response.responseJSON.errors) == "object") {
              $('#register_alert').html('');
            $.each(response.responseJSON.errors,function(key,value){
                $('#register_alert').append('<div class="alert alert-danger">'+value+'</div>');
            });
            } else {
               $('#register_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
            }
        },
        beforeSend : function(){
                     $('#register_btn').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Submiting ---');
                     $('#register_btn').attr('disabled', true);
                },
                complete : function(){
                  $('#register_btn').html('<i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Submit');
                  $('#register_btn').attr('disabled', false);
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

<script>
       $('.edit-btn').on('click',function(){
        var id         =$(this).data('id');
        var name    =$(this).data('name');
        var region   =$(this).data('region');
        var district   =$(this).data('district');
        var ward       =$(this).data('ward');
        var location   =$(this).data('location');
        var contact_person   =$(this).data('contact_person');
        var msisdn        =$(this).data('msisdn');
        var designation   =$(this).data('designation');
        var region_id     =$(this).data('region_id');
        var district_id   =$(this).data('district_id');
        var ward_id       =$(this).data('ward_id');

        $('#hospital_id').val(id);
        $('#name').val(name);
        $('#region').html(region);
        $('#district').html(district);
        $('#ward').html(ward);
        $('#location').val(location);
        $('#contact_person').val(contact_person);
        $('#designation').val(designation);
        $('#msisdn').val(msisdn);
        $('#region').val(region_id);
        $('#district').val(district_id);
        $('#ward').val(ward_id);
    });
</script>
<script>
    $(document).ready(function(){
      $('#update_form').on('submit',function(e){
          e.preventDefault();

       var dataz =$("#update_form").serialize();

      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
          });
      $.ajax({
      type:'POST',
      url:"{{ route('hospital.update')}}",
      data:dataz,
      success:function(response){
        $('#update_alert').html('<div class="alert alert-success">'+response.message+'</div>');
        setTimeout(function(){
         location.reload();
      },500);

      },
      error:function(response){
          console.log(response.responseText);
          if (jQuery.type(response.responseJSON.errors) == "object") {
            $('#update_alert').html('');
          $.each(response.responseJSON.errors,function(key,value){
              $('#update_alert').append('<div class="alert alert-danger">'+value+'</div>');
          });
          } else {
             $('#update_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
          }
      },
      beforeSend : function(){
                   $('#update_btn').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Submiting ---');
                   $('#update_btn').attr('disabled', true);
              },
              complete : function(){
                $('#update_btn').html('<i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Submit');
                $('#update_btn').attr('disabled', false);
              }
      });
  });
  });
</script>

@endpush
