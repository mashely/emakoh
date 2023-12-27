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
                
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );
</script>