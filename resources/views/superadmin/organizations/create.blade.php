@extends('layouts.contentLayoutMaster')

@section('title', 'Invite Organization')

@section('content')
@include('panels.response')

<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Invite New Organization</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.organizations.store') }}" method="POST" id="invite-form">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="name">Organization Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" placeholder="Acme Corporation" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Admin Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">An invitation will be sent to this email address.</small>
                    </div>
                    
                    <div class="form-group mb-0">
                        <div class="d-flex justify-content-between">
                        <a href="{{ route('superadmin.organizations.index') }}" class="btn btn-outline-secondary">
                            <i data-feather="x" class="mr-50"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="send" class="mr-50"></i>
                            Send Invitation
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

