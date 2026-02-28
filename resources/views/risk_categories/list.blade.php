@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Risk Categories</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
                            <li class="breadcrumb-item active">Risk Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">Risk Factor Categories</h4>
                    </div>
                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3 ">
                                <div class="col-sm-auto text-right">
                                    <div>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" data-bs-target="#catModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Add Category
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
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $cat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-M-Y',strtotime($cat->created_at)) }}</td>
                                            <td>{{ $cat->name }}</td>
                                            <td>{{ $cat->description }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" data-id="{{ $cat->id }}" data-name="{{ $cat->name }}" data-description="{{ $cat->description }}" data-bs-toggle="modal" data-bs-target="#catEditModal">
                                                    <i class="bx bx-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $cat->id }}">
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

        <div class="modal fade" id="catModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form id="cat_form">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div id="cat_alert"></div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" id="cat_btn" class="btn btn-success ms-auto">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="catEditModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form id="cat_edit_form">
                            <input type="hidden" name="category_id" id="edit_cat_id">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="edit_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="edit_description" rows="3"></textarea>
                            </div>
                            <div id="cat_edit_alert"></div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" id="cat_edit_btn" class="btn btn-success ms-auto">Update</button>
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
            document.getElementById('edit_cat_id').value = this.dataset.id;
            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_description').value = this.dataset.description || '';
        });
    });
    document.querySelectorAll('.delete-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            const id = this.dataset.id;
            if(!confirm('Delete this category?')) return;
            fetch("{{ route('risk_category.delete') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
                },
                body: JSON.stringify({category_id:id})
            }).then(r=>r.json()).then(resp=>{
                if(resp.success){ location.reload(); }
            });
        });
    });
    document.getElementById('cat_btn').addEventListener('click', function(){
        const form = document.getElementById('cat_form');
        const data = new FormData(form);
        fetch("{{ route('risk_category.create') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body:data
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('cat_alert');
            alertDiv.innerHTML = '';
            if(resp.success){
                alertDiv.innerHTML = '<div class="alert alert-success">'+resp.message+'</div>';
                setTimeout(()=>location.reload(),500);
            }else{
                alertDiv.innerHTML = '<div class="alert alert-danger">'+(resp.errors || 'Failed')+'</div>';
            }
        });
    });
    document.getElementById('cat_edit_btn').addEventListener('click', function(){
        const form = document.getElementById('cat_edit_form');
        const data = new FormData(form);
        fetch("{{ route('risk_category.update') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body:data
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('cat_edit_alert');
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

