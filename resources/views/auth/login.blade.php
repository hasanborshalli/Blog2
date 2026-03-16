@extends('layouts.web')

@section('title', 'Login')

@section('content')
    <section class="auth-section">
        <div class="auth-card">
            <div class="auth-card-header">
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Login to access your dashboard and manage your content.</p>
            </div>

            <form action="{{ route('login.store') }}" method="POST" class="auth-form">
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

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        required
                    >
                </div>

                <div class="form-row form-row-between">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <div class="auth-footer">
                <p>Don’t have an account? <a href="{{ route('register') }}" class="text-link">Register here</a></p>
            </div>
        </div>
    </section>
@endsection