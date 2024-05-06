@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Login Form Container -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="login-container">
                <!-- Centered logo -->
                <div class="logo-container">
                    <img src="{{ asset('media/images/staffcentral-login-logo.png') }}" alt="Logo" class="img-fluid mb-4" style="max-width: 200px;">
                </div>
                <div class="card login-card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <div class="text-center mb-3">
                            <button class="btn btn-primary">Sign in with Microsoft</button>
                            <button class="btn btn-danger">Sign in with Google</button>
                        </div>
                        <div class="or-divider">
                            <hr>
                            <div class="or-text">OR</div>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <div class="mb-3">
                                <label for="email_or_username" class="form-label">Email or Username</label>
                                <input id="email_or_username" type="text" class="form-control" name="email_or_username" value="{{ old('email_or_username') }}" required autofocus placeholder="Enter your email or username">
                                @error('email_or_username')
                                <div class="error-container">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                @error('password')
                                <div class="error-container">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me checkbox -->
                            <div class="remember-me-container">
                                <div class="form-check">
                                    <input id="remember" type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember" class="form-check-label">Remember Me</label>
                                </div>

                                <!-- Placeholder for Forgot Your Password? -->
                                <a href="{{ route('password.request') }}" class="text-muted">Forgot Your Password?</a>
                            </div>

                            <!-- Login button -->
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Image Container -->
        <div class="col-md-6 background-container"></div>
    </div>
</div>
@endsection
