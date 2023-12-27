@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">CLient Reminders</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reminders</a></li>
                            <li class="breadcrumb-item active">CLient Reminders</li>
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
                        <h4 class="card-title mb-0 text-center">CLient Reminders</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <form method="POST" action="{{ route('reminder.get.report')}}" id="filter_form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="Start Date">Start Date (From)</label>
                                        <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Start Date (to)</label>
                                        <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Return Date (From)</label>
                                        <input type="date" name="return_start_date" class="form-control" placeholder="Start Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Return Date (to)</label>
                                        <input type="date" name="return_end_date" class="form-control" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Gender</label>
                                        <select class="form-select" name="gender" >
                                            <option value="" selected>Please Choose Gender</option>
                                            @foreach ($gender as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Marital Status</label>
                                        <select class="form-select" name="marital_status" >
                                            <option value="" selected>Please Choose Marital Status</option>
                                            @foreach ($marital_status as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Hospital</label>
                                        <select class="form-select" name="hospital_id">
                                            <option value="" selected>Please Choose Hospital</option>
                                            @foreach ($hospitals as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Services</label>
                                        <select class="form-select" name="service" >
                                            <option value="" selected>Please Choose Service</option>
                                            @foreach ($services as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Reminder Status</label>
                                        <select class="form-select" name="reminder_status" >
                                            <option value="" selected>Please Choose Status</option>
                                            <option value="OPEN">OPEN</option>
                                            <option value="CLOSED">CLOSED</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">Region</label>
                                        <select class="form-select" name="region" id="region_id" >
                                            <option value="" selected>Please Choose Region</option>
                                            @foreach ($regions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Start Date">District</label>
                                        <select class="form-select" name="district" id="district_id">
                                            <option value="" selected>Please Choose District</option>
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

      
        <!-- end row -->

      
        <!-- end row -->

    {{-- edit modal --}}
    <div class="modal fade" id="showModal-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Reminder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form id="service_update">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Service Type</label>
                        <select name="service" class="form-select" id="" required>
                            <option id="service_selected" selected></option>
                            @foreach ($services as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="form-label">Start date</label>
                        <input type="date" id="start_date" class="form-control" name="start_date" min="{{ date('Y-m-d')}}" required />
                    </div>
                    <div class="mb-3">
                        <label for="email-field" class="form-label">Return date</label>
                        <input type="date" id="end_date" class="form-control" name="end_date" min="{{ date('Y-m-d')}}" required />
                        <input type="hidden" name="reminder_id" id="reminder_id">
                    </div>
                    <div class="mb-3">
                        <label for="email-field" class="form-label">Edit Reason</label>
                        <textarea name="reason" id="reason" class="form-control" cols="10" placeholder="Write reason ......"></textarea>
                    </div>
                    <div class="mb-3" id="service_alert_update">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="service_btn_update"> <i class=" bx bxs-save"></i> Add Service</button>
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
        var id         =$(this).data('id');
        var service    =$(this).data('service');
        var service_id =$(this).data('service_id');
        var start_date =$(this).data('start_date');
        var end_date   =$(this).data('end_date');
        var reason   =$(this).data('reason');

        $('#reminder_id').val(id);
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        $('#reason').val(reason);
        $('#service_selected').html(service);
        $('#service_selected').val(service_id);
    });

    $(document).ready(function(){
      $('#service_update').on('submit',function(e){
          e.preventDefault();
      
       var dataz =$(this).serialize();

      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
          });
      $.ajax({
      type:'POST',
      url:"{{ route('appointment.update')}}",
      data:dataz,
      success:function(response){
        console.log(response);
        $('#service_alert_update').html('<div class="alert alert-success">'+response.message+'</div>');
        setTimeout(function(){
            location.reload();
      },500);

      },
      error:function(response){
          console.log(response.responseText);
          if (jQuery.type(response.responseJSON.errors) == "object") {
            $('#service_alert_update').html('');
          $.each(response.responseJSON.errors,function(key,value){
              $('#service_alert_update').append('<div class="alert alert-danger">'+value+'</div>');
          });
          } else {
             $('#service_alert_update').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
          }
      },
      beforeSend : function(){
                   $('#service_btn_update').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Updating ---');
                   $('#service_btn_update').attr('disabled', true);
              },
              complete : function(){
                $('#service_btn_update').html('<i class="bx bx-save"></i> Update');
                $('#service_btn_update').attr('disabled', false);
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
        url:"{{ route('reminder.filter')}}",
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