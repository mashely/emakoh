@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Community Health Workers</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
                            <li class="breadcrumb-item active">CHWs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">Community Health Workers</h4>
                    </div>
                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3 ">
                                <div class="col-sm-auto text-right">
                                    <div>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" data-bs-target="#chwModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Add CHW
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap table-hover table-striped" id="table_id">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Registration Date</th>
                                            <th>Full Name</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chws as $chw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-M-Y',strtotime($chw->created_at)) }}</td>
                                            <td>{{ $chw->full_name }}</td>
                                            <td>{{ $chw->phone_number }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" data-id="{{ $chw->id }}" data-name="{{ $chw->full_name }}" data-phone="{{ $chw->phone_number }}" data-bs-toggle="modal" data-bs-target="#chwEditModal">
                                                    <i class="bx bx-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $chw->id }}">
                                                    <i class="bx bx-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chwModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title">Add CHW</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form id="chw_form">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" required>
                            </div>
                            <div id="chw_alert"></div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" id="chw_btn" class="btn btn-success ms-auto">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chwEditModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title">Edit CHW</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form id="chw_edit_form">
                            <input type="hidden" name="chw_id" id="edit_chw_id">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" id="edit_full_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="edit_phone_number" required>
                            </div>
                            <div id="chw_edit_alert"></div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" id="chw_edit_btn" class="btn btn-success ms-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            document.getElementById('edit_chw_id').value = this.dataset.id;
            document.getElementById('edit_full_name').value = this.dataset.name;
            document.getElementById('edit_phone_number').value = this.dataset.phone;
        });
    });
    document.querySelectorAll('.delete-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            const id = this.dataset.id;
            if(!confirm('Delete this CHW?')) return;
            fetch("{{ route('chw.delete') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
                },
                body: JSON.stringify({chw_id:id})
            }).then(r=>r.json()).then(resp=>{
                if(resp.success){ location.reload(); }
            });
        });
    });
    document.getElementById('chw_btn').addEventListener('click', function(){
        const form = document.getElementById('chw_form');
        const data = new FormData(form);
        fetch("{{ route('chw.create') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body:data
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('chw_alert');
            alertDiv.innerHTML = '';
            if(resp.success){
                alertDiv.innerHTML = '<div class="alert alert-success">'+resp.message+'</div>';
                setTimeout(()=>location.reload(),500);
            }else{
                alertDiv.innerHTML = '<div class="alert alert-danger">'+(resp.errors || 'Failed')+'</div>';
            }
        });
    });
    document.getElementById('chw_edit_btn').addEventListener('click', function(){
        const form = document.getElementById('chw_edit_form');
        const data = new FormData(form);
        fetch("{{ route('chw.update') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body:data
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('chw_edit_alert');
            alertDiv.innerHTML = '';
            if(resp.success){
                alertDiv.innerHTML = '<div class="alert alert-success">'+resp.message+'</div>';
                setTimeout(()=>location.reload(),500);
            }else{
                alertDiv.innerHTML = '<div class="alert alert-danger">'+(resp.errors || 'Failed')+'</div>';
            }
        });
    });
});
</script>
@endpush

