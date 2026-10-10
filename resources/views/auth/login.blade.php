@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
<div class="mb-4 text-center">
    <h4 class="fw-bold mb-1">Administrator Sign In</h4>
    <p class="text-muted small">Enter your credentials to access the administrative dashboard</p>
</div>

<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label small fw-semibold text-muted">Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', 'admin@example.com') }}" required autocomplete="email" autofocus placeholder="admin@example.com">
        </div>
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label small fw-semibold text-muted">Password</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-key"></i></span>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label small text-muted" for="remember">
                Remember me
            </label>
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary py-2 fw-semibold">
            <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Dashboard
        </button>
    </div>

    <div class="alert alert-light border small text-muted py-2 mb-3">
        <i class="bi bi-info-circle text-primary me-1"></i>
        Default Seeder Account: <strong>admin@example.com</strong> / <strong>password123</strong>
    </div>

    <div class="text-center small text-muted">
        Don't have an administrator account?
        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">Register Here</a>
    </div>
</form>

<script>
    document.getElementById('togglePassword')?.addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>
@endsection
