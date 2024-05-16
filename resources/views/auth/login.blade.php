@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <style>
        .vertical-divider {
            border-left: 1px solid #ccc;
            height: 100%;
            margin: 0 20px;
        }
        .login-container {
            width: 100%;
            max-width: 900px; /* Adjust max-width to make the card lengthier */
        }
        .login-form-content {
            flex: 1;
            max-width: 600px; /* Adjust max-width for form content */
        }
        .form-control {
            width: 100%;
            max-width: 500px; /* Adjust max-width for input fields */
        }
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
        <!-- Login Form Container -->
        <div class="col-md-8 d-flex justify-content-center align-items-center">
            <div class="login-container d-flex align-items-center">
                <!-- Login form content -->
                <div class="login-form-content">
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <div class="mb-3">
                            <h2 class>Sign in</h2>
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
                        <div class="remember-me-container d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input id="remember" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>

                            <!-- Placeholder for Forgot Your Password? -->
                            <a href="{{ route('password.request') }}" class="text-muted ml-3">Forgot Your Password?</a>
                        </div>

                        <!-- Login button -->
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <!-- Vertical divider -->
                <div class="vertical-divider"></div>
                <!-- Logo content with header -->
                <div class="logo-container">
                    <img src="{{ asset('media/images/staffcentral-login-logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
