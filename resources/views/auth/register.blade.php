@extends('layouts.guest')

@section('title', 'Admin Registration')

@section('content')
<div class="mb-4 text-center">
    <h4 class="fw-bold mb-1">Create Admin Account</h4>
    <p class="text-muted small">Register a new administrator profile for the system</p>
</div>

<form method="POST" action="{{ route('register.submit') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label small fw-semibold text-muted">Full Name</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="e.g. Sok Sovann">
        </div>
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label small fw-semibold text-muted">Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="admin@domain.com">
        </div>
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label small fw-semibold text-muted">Password (Min. 8 characters)</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="••••••••">
        </div>
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label small fw-semibold text-muted">Confirm Password</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-check-circle"></i></span>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
        </div>
    </div>

    <div class="alert alert-secondary small py-2 mb-3">
        <i class="bi bi-info-circle text-primary me-1"></i>
        <strong>Academic Notice:</strong> For this university project, newly registered accounts are automatically authorized as administrators.
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary py-2 fw-semibold">
            <i class="bi bi-person-plus-fill me-1"></i> Create Administrator Account
        </button>
    </div>

    <div class="text-center small text-muted">
        Already registered?
        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-primary">Sign In</a>
    </div>
</form>
@endsection
