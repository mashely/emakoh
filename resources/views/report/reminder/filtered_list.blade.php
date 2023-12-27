<table class="table align-middle table-nowrap table-hover table-striped" id="table_id">
    <thead class="table-light">
        <tr>
            <th >#</th>
            <th>Registration Date</th>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Hospital Name</th>
            <th>Service Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
    </thead>
    <tbody>
        @foreach ($reminders as $reminder)
        <tr>
            <td >{{ $loop->iteration }}</td>
            <td>{{ date('d-M-Y',strtotime($reminder->created_at)) }}</td>
            <td>{{ $reminder->patient->patient_id }}</td>
            <td>{{ $reminder->patient->first_name.' '.$reminder->patient->last_name }}</td>
            <td>{{ $reminder->hospital->name }}</td>
            <td>{{ $reminder->service->name }}</td>
            <td>{{ date('d-M-Y',strtotime($reminder->start_date)) }}</td>
            <td>{{ date('d-M-Y',strtotime($reminder->end_date)) }}</td>
            <td>
                @if ($reminder->status == "OPEN")
                <span class="badge badge-soft-success text-uppercase">OPEN</span> 
                @else
                <span class="badge badge-soft-danger text-uppercase">CLOSED</span> 
                @endif
            </td>
            
            <td>
                <button class="btn btn-info btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#showModal-edit" 
                data-id ={{ $reminder->id}} data-service ={{ $reminder->service->name }} data-service_id ={{ $reminder->service_id }}
                data-start_date ={{ $reminder->start_date }} data-end_date ={{ $reminder->end_date }}
                data-reason ={{ $reminder->edit_reason  }}
                ><i class="bx bx-edit"></i> Edit </button>
            </td>

            </tr>
            
        @endforeach
      
    </tbody>
</table>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );
</script>