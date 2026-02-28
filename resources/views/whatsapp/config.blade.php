@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">WhatsApp</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
                            <li class="breadcrumb-item active">WhatsApp</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">Add WhatsApp Configurations</h4>
                    </div>
                    <div class="card-body">
                        <form id="wa_form">
                            <div class="mb-3">
                                <label class="form-label">Phone Number ID</label>
                                <input type="text" class="form-control" name="phone_number_id">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Access Token</label>
                                <input type="text" class="form-control" name="access_token">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Verify Token</label>
                                <input type="text" class="form-control" name="verify_token">
                            </div>
                            <div id="wa_alert"></div>
                            <button type="button" id="wa_btn" class="btn btn-primary"><i class="bx bxl-telegram"></i> Save settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Whatsapp Channel Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap table-hover table-striped" id="table_id">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Channel</th>
                                        <th>Phone Number ID</th>
                                        <th>Access Token</th>
                                        <th>Verify Token</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($configs as $cfg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cfg->channel }}</td>
                                        <td>{{ $cfg->phone_number_id }}</td>
                                        <td>{{ substr($cfg->access_token,0,4) }} ***</td>
                                        <td>{{ substr($cfg->verify_token,0,4) }}***</td>
                                        <td>
                                            <input type="checkbox" class="form-check-input wa-activate" data-id="{{ $cfg->id }}" {{ $cfg->is_active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm wa-edit" data-id="{{ $cfg->id }}" data-phone="{{ $cfg->phone_number_id }}" data-token="{{ $cfg->access_token }}" data-verify="{{ $cfg->verify_token }}" data-bs-toggle="modal" data-bs-target="#waEditModal"><i class="bx bx-edit"></i></button>
                                            <button class="btn btn-danger btn-sm wa-delete" data-id="{{ $cfg->id }}"><i class="bx bx-trash"></i></button>
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
        <div class="modal fade" id="waEditModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title">Edit WhatsApp Config</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form id="wa_edit_form">
                            <input type="hidden" name="config_id" id="edit_config_id">
                            <div class="mb-3">
                                <label class="form-label">Phone Number ID</label>
                                <input type="text" class="form-control" name="phone_number_id" id="edit_phone_id">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Access Token</label>
                                <input type="text" class="form-control" name="access_token" id="edit_access_token">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Verify Token</label>
                                <input type="text" class="form-control" name="verify_token" id="edit_verify_token">
                            </div>
                            <div id="wa_edit_alert"></div>
                            <button type="button" id="wa_edit_btn" class="btn btn-primary">Update</button>
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
document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('wa_btn').addEventListener('click', function(){
        const form = document.getElementById('wa_form');
        const data = new FormData(form);
        fetch("{{ route('whatsapp.config.store') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body:data
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('wa_alert');
            alertDiv.innerHTML = '';
            if(resp.success){
                alertDiv.innerHTML = '<div class="alert alert-success">'+resp.message+'</div>';
                setTimeout(()=>location.reload(),500);
            }else{
                alertDiv.innerHTML = '<div class="alert alert-danger">'+(resp.errors || 'Failed')+'</div>';
            }
        });
    });
    document.querySelectorAll('.wa-edit').forEach(function(btn){
        btn.addEventListener('click', function(){
            document.getElementById('edit_config_id').value = this.dataset.id;
            document.getElementById('edit_phone_id').value = this.dataset.phone;
            document.getElementById('edit_access_token').value = this.dataset.token;
            document.getElementById('edit_verify_token').value = this.dataset.verify;
        });
    });
    document.getElementById('wa_edit_btn').addEventListener('click', function(){
        const form = document.getElementById('wa_edit_form');
        const data = new FormData(form);
        fetch("{{ route('whatsapp.config.update') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body:data
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('wa_edit_alert');
            alertDiv.innerHTML = '';
            if(resp.success){
                alertDiv.innerHTML = '<div class="alert alert-success">'+resp.message+'</div>';
                setTimeout(()=>location.reload(),500);
            }else{
                alertDiv.innerHTML = '<div class="alert alert-danger">'+(resp.errors || 'Failed')+'</div>';
            }
        });
    });
    document.querySelectorAll('.wa-activate').forEach(function(cb){
        cb.addEventListener('change', function(){
            const id = this.dataset.id;
            fetch("{{ route('whatsapp.config.activate') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
                },
                body: JSON.stringify({config_id:id})
            }).then(r=>r.json()).then(resp=>{
                if(resp.success){ location.reload(); }
            });
        });
    });
    document.querySelectorAll('.wa-delete').forEach(function(btn){
        btn.addEventListener('click', function(){
            const id = this.dataset.id;
            if(!confirm('Delete this configuration?')) return;
            fetch("{{ route('whatsapp.config.delete') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
                },
                body: JSON.stringify({config_id:id})
            }).then(r=>r.json()).then(resp=>{
                if(resp.success){ location.reload(); }
            });
        });
    });
});
</script>
@endpush

