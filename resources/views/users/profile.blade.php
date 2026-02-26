@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('app.my_profile') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('app.account') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('app.profile') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">{{ __('app.user_information') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.full_name') }}</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.email') }}</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.phone') }}</label>
                            <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.gender') }}</label>
                            <input type="text" class="form-control" value="{{ $user->gender ? $user->gender->name : '' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.role') }}</label>
                            <input type="text" class="form-control" value="{{ $user->roles && $user->roles->userRole ? $user->roles->userRole->name : '' }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
