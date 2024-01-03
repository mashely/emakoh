@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">System Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">System Users</a></li>
                            <li class="breadcrumb-item active">System Users</li>
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
                        <h4 class="card-title mb-0 text-center">System Users</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3 ">
                                <div class="col-sm-auto text-right">
                                    <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" data-bs-target="#showModal" >
                                                <i class="ri-add-line align-bottom me-1"></i> Add User
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
                                            <th>Staff Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)


                                            @if ($user->hasRole(1))
                                            <tr>
                                                <td >{{ $loop->iteration }}</td>
                                                <td>{{ date('d-M-Y',strtotime($user->created_at)) }}</td>
                                                <td>{{ $user->name}}</td>
                                                <td>{{ $user->gender->name}}</td>
                                                <td>{{ $user->email}}</td>
                                                <td>{{ $user->phone}}</td>
                                                <td>{{ $user->roles->userRole->name }}</td>
                                                <td>
                                                    @if ($user->active == 1)
                                                    <span class="badge badge-soft-success text-uppercase">Active</span>
                                                    @else
                                                    <span class="badge badge-soft-danger text-uppercase">InActive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#showModal-edit" data-id="{{ $user->id}}"
                                                        data-name ="{{ $user->name }}" data-phone="{{ $user->phone }}"
                                                        ><i class="bx bx-edit"></i> Edit </button>
                                                        @if ($user->active == 1)
                                                        <button class="btn btn-warning btn-sm" title="Disable" id="{{$user->id}}" onclick="disable_user(id)"> <span class="bx bxs-user-minus"></span>Disable</button>
                                                        @else
                                                        <button class="btn btn-success btn-sm" title="Enable" id="{{$user->id}}" onclick="enable_user(id)"> <span class="bx bxs-user-check "></span>Enable</button>
                                                        @endif
                                                </td>
                                                </tr>

                                            @endif


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
                    <h5 class="modal-title" id="exampleModalLabel">Add System User(Admins)</h5>
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
                                        <label class="form-label" for="hospital">First Name <span id="required-field">*</span></label>
                                        <input type="text" class="form-control" name="first_name"  placeholder="Enter First name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name"  placeholder="Enter Middle Name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Last Name <span id="required-field">*</span></label>
                                        <input type="text" class="form-control" name="last_name"  placeholder="Enter Last Name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Gender <span id="required-field">*</span></label>
                                        <select name="gender" class="form-select" id="">
                                            <option value="" selected>Please Select Gender</option>
                                            @foreach ($gender as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                        <label class="form-label" for="hospital">Phone Number <span id="required-field">*</span></label>
                                       <input type="number" name="phone_number" class="form-control" placeholder="Phone Number">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Email/Username <span id="required-field">*</span></label>
                                       <input type="email" name="email" class="form-control" placeholder="Email Address">
                                    </div>
                                    <P style="margin-top: 15px;"><b>NOTE: Those field marked with <span id="required-field">*</span> are mandatory field</b></P>

                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab" ><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="pills-success-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Password</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                                <div>
                                    <div class="mb-4">
                                        <div>
                                            <h5 class="mb-1 text-center">Password & Role</h5>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Role <span id="required-field">*</span></label>
                                        <select name="role_id" class="form-select" id="">
                                            <option value="" selected>Please Select Role</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Password <span id="required-field">*</span></label>
                                        <input type="password" class="form-control" name="password"  placeholder="Enter Password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="hospital">Confirm Password <span id="required-field">*</span></label>
                                        <input type="password" class="form-control" name="confirm_password"  placeholder="Enter Password">
                                    </div>
                                    <div class="mb-3" id="register_alert">
                                    </div>
                                    <P style="margin-top: 15px;"><b>NOTE: Those field marked with <span id="required-field">*</span> are mandatory field</b></P>

                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-info-desc-tab" ><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Address</button>
                                        <button type="button" id="register_btn" class="btn btn-success btn-label right ms-auto nexttab
    nexttab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form id="edit_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email-field" class="form-label">Name</label>
                            <input type="text" id="full_name" class="form-control" name="name" required />
                        </div>
                        <div class="mb-3">
                            <label for="email-field" class="form-label">Gender</label>
                            <select name="gender" class="form-select" id="">
                                @foreach ($gender as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email-field" class="form-label">Phone Number</label>
                            <input type="number" id="phone_number" class="form-control" name="phone_number" required />
                            <input type="hidden" name="user_id" id="user_id">
                        </div>
                        <div class="mb-3" id="update_alert">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="update_btn"> <i class=" bx bxs-save"></i> Update</button>
                        </div>
                    </div>
                </form>
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
        url:"{{ route('user.create')}}",
        data:dataz,
        success:function(response){
          $('#register_alert').html('<div class="alert alert-success">'+response.message+'</div>');
          setTimeout(function(){
            location.reload();
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
    $('.edit-btn').on('click',function(){
        var id =$(this).data('id');
        var name =$(this).data('name');
        var phone =$(this).data('phone');

        $('#user_id').val(id);
        $('#full_name').val(name);
        $('#phone_number').val(phone);
    });

    $(document).ready(function(){
        $('#edit_form').on('submit',function(e){
            e.preventDefault();

         var dataz =$(this).serialize();

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        $.ajax({
        type:'POST',
        url:"{{ route('user.update')}}",
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
                     $('#update_btn').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Updating ---');
                     $('#update_btn').attr('disabled', true);
                },
                complete : function(){
                  $('#update_btn').html('<i class="bx bxs-save"></i> Update');
                  $('#update_btn').attr('disabled', false);
                }
        });
    });
    });
</script>

@endpush
