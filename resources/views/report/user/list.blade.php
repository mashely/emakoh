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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
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
                            <form method="POST" action="{{ route('user.get.report')}}" id="filter_form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="Start Date">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">End Date</label>
                                        <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="" selected>Please Choose Status</option>
                                           <option value="1">Active</option>
                                           <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Hospital</label>
                                        <select class="form-select" name="hospital">
                                            <option value="" selected>Please Choose Hospital</option>
                                            @foreach ($hospitals as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 20px">
                                    <div class="col-md-12 text-center">
                                        <button type="reset" class="btn btn-danger" style="margin-right: 10px"> <i class="las la-times"></i> Reset Fields</button>
                                        <button type="button" class="btn btn-primary" style="margin-right: 10px" id="filter_btn"> <i class="las la-search"></i> View Report</button>
                                        <button type="submit" class="btn btn-info"> <i class="las la-file-excel"></i> Generate Report</button>
                                    </div>
                                  
                                </div>
                            </form>
                            
                            <div class="table-responsive table-card mt-3 mb-1" id="search_result">
                               
                            </div>
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

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
<script>
    $(document).ready(function(){
        $('#filter_btn').on('click',function(e){
            e.preventDefault();
         var dataz =$('#filter_form').serialize();
            $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });

        $.ajax({
        type:'POST',
        url:"{{ route('user.filter')}}",
        data:dataz,
        success:function(data){
          $('#search_result').html(data);
        },
        error:function(err){
            console.log(err.responseText);
        },
        beforeSend : function(){
                    $('#filter_btn').html('<i class="las la-spinner la-pulse la-spin"></i> Loading ---');
                    $('#filter_btn').attr('disabled', true);
                },
                complete : function(){
                  $('#filter_btn').html('<i class="las la-search"></i> View Report');
                  $('#filter_btn').attr('disabled', false);
                }
      

        });
    });
    });

   
</script>
    
@endpush