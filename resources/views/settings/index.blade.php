@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">System Settings</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">Configuration</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('settings.save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Email Settings</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Mailer</label>
                                        <select name="mail_mailer" class="form-select">
                                            <option value="smtp" {{ $settings['mail_mailer'] == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                            <option value="log" {{ $settings['mail_mailer'] == 'log' ? 'selected' : '' }}>Log</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Host</label>
                                        <input type="text" name="mail_host" class="form-control" value="{{ $settings['mail_host'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Port</label>
                                        <input type="text" name="mail_port" class="form-control" value="{{ $settings['mail_port'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Encryption</label>
                                        <input type="text" name="mail_encryption" class="form-control" value="{{ $settings['mail_encryption'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="mail_username" class="form-control" value="{{ $settings['mail_username'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="mail_password" class="form-control" value="{{ $settings['mail_password'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">From Address</label>
                                        <input type="email" name="mail_from_address" class="form-control" value="{{ $settings['mail_from_address'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">From Name</label>
                                        <input type="text" name="mail_from_name" class="form-control" value="{{ $settings['mail_from_name'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>SMS API Settings</h5>
                                    <div class="mb-3">
                                        <label class="form-label">API URL</label>
                                        <input type="text" name="sms_api_url" class="form-control" value="{{ $settings['sms_api_url'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">API Key</label>
                                        <input type="text" name="sms_api_key" class="form-control" value="{{ $settings['sms_api_key'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sender ID</label>
                                        <input type="text" name="sms_sender_id" class="form-control" value="{{ $settings['sms_sender_id'] }}">
                                    </div>
                                    <h5 class="mt-4">Language</h5>
                                    <div class="mb-3">
                                        <label class="form-label">System Language</label>
                                        <select name="app_language" class="form-select">
                                            <option value="en" {{ $settings['app_language'] == 'en' ? 'selected' : '' }}>English</option>
                                            <option value="sw" {{ $settings['app_language'] == 'sw' ? 'selected' : '' }}>Swahili</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-success">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

