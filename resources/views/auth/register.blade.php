@extends('layouts.web')

@section('title', 'Register')

@section('content')
<section class="auth-section">
    <div class="auth-card">
        <div class="auth-card-header">
            <h1 class="auth-title">Create Your Account</h1>
            <p class="auth-subtitle">Join the platform and start publishing your articles.</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input required type="text" id="username" name="username" class="form-input"
                    value="{{ old('username') }}">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                    required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}" class="text-link">Login here</a></p>
        </div>
    </div>
</section>
@endsection