@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <style>
        .container-fluid {
            background-color: #333333; /* Slate Gray background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 1000px; /* Make the card wider */
            display: flex;
            flex-direction: column;
            align-items: center; 
            padding: 40px; /* Increase padding for better spacing 484848 333333 */
            background-color: #484848; /* Dark Gray card */
            border-radius: 16px; /* Make the card's edges more rounded */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add box-shadow for depth */
            color: #FFFFFF; /* White text color */
            margin: 20px; /* Add margin to ensure it's centered properly */
        }
        .login-form-content {
            width: 100%;
            max-width: 800px; /* Adjust max-width for form content */
            padding: 20px; /* Add padding for better spacing */
        }
        .form-control {
            width: 100%;
            margin-bottom: 15px; /* Add margin-bottom for spacing between fields */
        }
        .form-control::placeholder {
            color: #CCCCCC; /* Lighter placeholder text */
        }
        .logo-container {
            margin-bottom: -20px; /* Add space between the logo and the form */
            text-align: center; /* Center the logo */
        }
        .logo-container img {
            max-width: 50%; /* Adjust the max-width to make the logo bigger */
            height: auto;
        }
        .remember-me-container {
            margin-bottom: 15px; /* Add margin-bottom for spacing */
        }
        .btn-block {
            width: 100%; /* Ensure the button takes full width */

            border: none;
            color: #FFFFFF; /* White text color */
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px; /* Make the button's edges less rounded */
        }
        .text-muted {
            color: #CCCCCC !important; /* Lighter text for muted elements */
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-10 d-flex justify-content-center">
            <div class="login-container">
                <!-- Logo content -->
                <div class="logo-container">
                    <img src="{{ asset('media/images/logos/L-SS-WB.png') }}" alt="Logo" class="img-fluid">
                </div>
                <!-- Login form content -->
                <div class="login-form-content">
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <div class="mb-3">
                            <h2>Sign in</h2>
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
                            <a href="{{ route('password.request') }}" class="text-white">Forgot Your Password?</a>
                        </div>

                        <!-- Login button -->
                        <button type="submit" class="btn btn-success btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection