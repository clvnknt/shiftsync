@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <style>
        .background-container {
            height: 100vh;
            background-image: url('{{ asset('media/images/backgrounds/bg-login-2.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .login-container {
            background-color: #FFFFFF; /* White background color for the container */
            border-radius: 10px;
            padding: 2rem; /* Increase padding for more space */
            max-width: 600px; /* Set maximum width to prevent it from becoming too wide on larger screens */
            margin: auto; /* Center the container horizontally */
        }

        .login-card {
            background-color: #FFFFFF; /* White background color for the card */
            border: none; /* Remove border */
            border-radius: 10px;
            padding: 1.5rem; /* Add padding */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }

        .login-form {
            padding: 1.5rem; /* Add padding to the form */
        }

        .card-body {
            padding: 1.5rem; /* Decrease vertical padding inside the card body */
            margin: 0; /* Remove margin */
        }

        .or-divider {
            text-align: center;
            margin: 1rem 0;
        }

        .or-divider hr {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .or-text {
            margin-bottom: 0.5rem;
        }

        /* Style for the Remember Me checkbox */
        .remember-me-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .remember-me-label {
            margin-bottom: 0;
        }

        /* Center the logo */
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                padding: 1rem;
            }
            .login-card {
                padding: 1rem;
            }
            .login-form {
                padding: 1rem;
            }
            .card-body {
                padding: 1rem;
            }
            .or-divider {
                margin: 1rem 0;
            }
            .or-divider hr {
                margin-top: 0.25rem;
                margin-bottom: 0.25rem;
            }
            .or-text {
                margin-bottom: 0.25rem;
            }
            .remember-me-container {
                margin-bottom: 0.75rem;
            }
            .logo-container {
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
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
                                <label for="remember" class="form-check-label remember-me-label">
                                    <input id="remember" type="checkbox" class="form-check-input" name="remember">
                                    Remember Me
                                </label>
                                <!-- Placeholder for Forgot Your Password? -->
                                <a href="#" class="text-muted">Forgot Your Password?</a>
                            </div>

                            <!-- Login button -->
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 background-container"></div>
    </div>
</div>
@endsection
