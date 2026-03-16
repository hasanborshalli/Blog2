@extends('layouts.web')

@section('title', 'Forgot Password')

@section('content')
    <section class="auth-section">
        <div class="auth-card">
            <div class="auth-card-header">
                <h1 class="auth-title">Forgot Password</h1>
                <p class="auth-subtitle">Enter your email and we’ll send you a password reset link.</p>
            </div>

            <form action="{{ route('password.email') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
            </form>

            <div class="auth-footer">
                <p><a href="{{ route('login') }}" class="text-link">Back to login</a></p>
            </div>
        </div>
    </section>
@endsection