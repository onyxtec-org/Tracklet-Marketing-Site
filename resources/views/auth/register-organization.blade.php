@extends('layouts.contentLayoutMaster')

@section('title', 'Register Organization')

@section('content')
@include('panels.response')

<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Register Your Organization</h4>
                <p class="card-text mb-0">Create your organization account and get started with Tracklet</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('organization.register') }}" class="auth-login-form">
                    @csrf
                    
                    <h5 class="mb-2">Organization Information</h5>
                    
                    <div class="form-group">
                        <label class="form-label" for="organization_name">Organization Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                               id="organization_name" name="organization_name" value="{{ old('organization_name') }}" 
                               placeholder="Acme Corporation" required>
                        @error('organization_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="organization_slug">Organization Slug (Optional)</label>
                        <input type="text" class="form-control @error('organization_slug') is-invalid @enderror" 
                               id="organization_slug" name="organization_slug" value="{{ old('organization_slug') }}" 
                               pattern="[a-z0-9-]+" placeholder="auto-generated">
                        @error('organization_slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">URL-friendly identifier (lowercase, numbers, and hyphens only). Leave empty to auto-generate.</small>
                    </div>
                    
                    <hr class="my-2">
                    
                    <h5 class="mb-2 mt-3">Admin Account</h5>
                    <p class="text-muted small mb-2">Your account will be the organization administrator.</p>
                    
                    <div class="form-group">
                        <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">This will be your login email and organization contact email.</small>
                    </div>
                    
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <small class="form-text text-muted">Minimum 8 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" 
                                   id="password_confirmation" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            <span>After registration, you'll need to complete your annual subscription to start using Tracklet.</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i data-feather="user-plus" class="mr-50"></i>
                        Register Organization
                    </button>
                    
                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            <span>Sign in</span>
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
// Auto-generate slug from organization name
$('#organization_name').on('input', function() {
    if (!$('#organization_slug').val() || $('#organization_slug').data('auto-generated')) {
        const slug = $(this).val()
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('#organization_slug').val(slug).data('auto-generated', true);
    }
});

$('#organization_slug').on('input', function() {
    $(this).data('auto-generated', false);
});
</script>
@endsection

