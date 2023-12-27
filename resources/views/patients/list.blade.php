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
                            <div class="row g-4 mb-3 ">
                                <div class="col-sm-auto text-right">
                                    @if (Auth::user()->hasRole(2) || Auth::user()->hasRole(3))
                                    <div>
                                        <a href="{{ route('client.form')}}">
                                            <button type="button" class="btn btn-success add-btn" >
                                                <i class="ri-add-line align-bottom me-1"></i> Add Client
                                            </button>
                                        </a>
                                       
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
                                            <th>Client ID</th>
                                            <th>Client Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>ID Details</th>
                                            <th>Status</th>
                                            <th>Appoitments</th>
                                            <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                        <tr>
                                            <td >{{ $loop->iteration }}</td>
                                            <td>{{ date('d-M-Y',strtotime($client->created_at)) }}</td>
                                            <td>{{ $client->patient_id}}</td>
                                            <td >{{ $client->first_name.' '.$client->last_name}}</td>
                                            <td >{{ $client->gender->name }}</td>
                                            <td >{{ age($client->dob)}}</td>
                                            <td >
                                                @if ($client->id_type)
                                                I:T-{{ $client->idType->name }} <br>
                                                I:N -{{ $client->id_number }}  
                                                @else
                                                I:T-{{ "Not Specified (N/A)" }} <br>
                                                I:N -{{ $client->id_number }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($client->status == "Active")
                                                <span class="badge badge-soft-success text-uppercase">Active</span> 
                                                @else
                                                <span class="badge badge-soft-danger text-uppercase">InActive</span> 
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('client.reminders',$client->id )}}">
                                                <button class="btn btn-primary"><i class=" bx bx-list-ul"></i> Reminders </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('client.edit',$client->id )}}">
                                                <button class="btn btn-info btn-sm" title="Edit"><i class="bx bx-edit"></i> Edit </button>
                                                </a>
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

        <!-- Modal -->
        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you Sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal -->

    </div>
    <!-- container-fluid -->
</div>
@endsection