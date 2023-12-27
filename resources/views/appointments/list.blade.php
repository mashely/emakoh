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
                            <div class="row g-4 mb-3 ">
                                <div class="col-sm-auto text-right">
                                    @if (Auth::user()->hasRole(2) || Auth::user()->hasRole(2))
                                    <div>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" >
                                            <i class="ri-add-line align-bottom me-1"></i> Add Reminder
                                        </button>
                                    </div>
                                    @endif
                                   
                                </div>
                            </div>
                            
                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap table-hover table-striped" id="table_id">
                                    <thead class="table-light">
                                        <tr>
                                            <th >#</th>
                                            <th>Registration Date</th>
                                            <th>Service Type</th>
                                            <th>Start Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appointments as $appointment)
                                        <tr>
                                            <td >{{ $loop->iteration }}</td>
                                            <td>{{ date('d-M-Y',strtotime($appointment->created_at)) }}</td>
                                            <td>{{ $appointment->service->name }}</td>
                                            <td>{{ date('d-M-Y',strtotime($appointment->start_date)) }}</td>
                                            <td>{{ date('d-M-Y',strtotime($appointment->end_date)) }}</td>
                                            <td>
                                                @if ($appointment->end_date > date('Y-m-d'))
                                                <span class="badge badge-soft-success text-uppercase">OPEN</span> 
                                                @else
                                                <span class="badge badge-soft-danger text-uppercase">CLOSED</span> 
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#showModal-edit" 
                                                data-id ={{ $appointment->id}} data-service ={{ $appointment->service->name }} data-service_id ={{ $appointment->service_id }}
                                                data-start_date ={{ $appointment->start_date }} data-end_date ={{ $appointment->end_date }}
                                                data-reason ={{ $appointment->edit_reason  }}
                                                ><i class="bx bx-edit"></i> Edit </button>
                                            </td>

                                            </tr>
                                            
                                        @endforeach
                                        {{-- <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                                </div>
                                            </th>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="customer_name">Mary Cousar</td>
                                            <td class="email">marycousar@velzon.com</td>
                                            <td class="phone">580-464-4694</td>
                                            <td class="date">06 Apr, 2021</td>
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                        data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> --}}
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

      
        <!-- end row -->

        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Add Reminder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form id="service">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Service Type</label>
                            <select name="service" class="form-select" id="" required>
                                <option value="" selected>Please select Service Type</option>
                                @foreach ($services as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email-field" class="form-label">Start date</label>
                            <input type="date" class="form-control" name="start_date" min="{{ date('Y-m-d')}}" required />
                        </div>
                        <div class="mb-3">
                            <label for="email-field" class="form-label">Return date</label>
                            <input type="date" class="form-control" name="end_date" min="{{ date('Y-m-d')}}" required />
                            <input type="hidden" name="patient_id" value="{{ $patient_id }}">
                        </div>
                        <div class="mb-3" id="service_alert">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="service_btn"> <i class=" bx bxs-save"></i> Add Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    $(document).ready(function(){
      $('#service').on('submit',function(e){
          e.preventDefault();
      
       var dataz =$(this).serialize();

      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
          });
      $.ajax({
      type:'POST',
      url:"{{ route('appointment.create')}}",
      data:dataz,
      success:function(response){
        console.log(response);
        $('#service_alert').html('<div class="alert alert-success">'+response.message+'</div>');
        setTimeout(function(){
            location.reload();
      },500);

      },
      error:function(response){
          console.log(response.responseText);
          if (jQuery.type(response.responseJSON.errors) == "object") {
            $('#service_alert').html('');
          $.each(response.responseJSON.errors,function(key,value){
              $('#service_alert').append('<div class="alert alert-danger">'+value+'</div>');
          });
          } else {
             $('#service_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
          }
      },
      beforeSend : function(){
                   $('#service_btn').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Submiting ---');
                   $('#service_btn').attr('disabled', true);
              },
              complete : function(){
                $('#service_btn').html('<i class="bx bx-save"></i> Add Service');
                $('#service_btn').attr('disabled', false);
              }
      });
  });
  });
</script>
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
    
@endpush