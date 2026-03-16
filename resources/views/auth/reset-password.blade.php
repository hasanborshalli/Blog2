@extends('layouts.web')

@section('title', 'Reset Password')

@section('content')
    <section class="auth-section">
        <div class="auth-card">
            <div class="auth-card-header">
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-subtitle">Create a new secure password for your account.</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST" class="auth-form">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email', $email) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
            </form>

            <div class="auth-footer">
                <p><a href="{{ route('login') }}" class="text-link">Back to login</a></p>
            </div>
        </div>
    </section>
@endsection