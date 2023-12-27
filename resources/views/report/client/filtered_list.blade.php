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
    </tbody>
</table>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );
</script>