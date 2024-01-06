<table class="table align-middle table-nowrap table-hover table-striped" id="table_id">
    <thead class="table-light">
        <tr>
            <th >#</th>
            <th>Registration Date</th>
            <th>Hospital Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Contact Person</th>
            <th>Status</th>
            <th>Staffs</th>
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
            <td >P:N-{{ $hospital->phone_number }} <br>
                E:A -{{ $hospital->email }}
            </td>
            <td >R-{{ $hospital->region->reg_name }} <br>
                D-{{ $hospital->district->dis_name }} <br>
                W-{{ $hospital->ward->ward_name }}
            </td>
            <td >F:N-{{ $hospital->personel->name }} <br>
                P:N -{{ $hospital->personel->phone_number }}
            </td>
            <td>
                @if ($hospital->status == "Active")
                <span class="badge badge-soft-success text-uppercase">Active</span>
                @else
                <span class="badge badge-soft-danger text-uppercase">InActive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('hospital.staff',$hospital->id )}}">
                <button class="btn btn-primary"><i class=" bx bx-user"></i> Staff </button>
                </a>
            </td>
            <td>
                <a href="{{ route('hospital.reminders',$hospital->id )}}">
                <button class="btn btn-primary"><i class=" bx bx-list-ul"></i> Reminders </button>
                </a>
            </td>
            <td>
                <button class="btn btn-info btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#showModal-edit"
                data-id ={{ $hospital->id}} data-name ={{ $hospital->name }}
                data-phone_number ={{ $hospital->phone_number }} data-email ={{ $hospital->email }}
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
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );
</script>
