@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Clients Records</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Records</a></li>
                            <li class="breadcrumb-item active">Clients Records</li>
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
                        <h4 class="card-title mb-0 text-center">Clients Records</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <form method="POST" action="{{ route('client.get.report')}}" id="filter_form">
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

       <!-- Modal -->
    <!--end modal -->
        <!-- end row -->
     
    {{-- edit modal --}}

 
    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('scripts')


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
        url:"{{ route('client.filter')}}",
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