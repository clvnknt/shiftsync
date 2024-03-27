@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <style>
        .login-container {
            background-image: url('{{ asset('media/images/backgrounds/bg-1.png') }}');
            background-size: cover;
            background-position: center;
            height: 100vh; /* Set the height of the container to full viewport height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background for card */
            padding: 20px;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
<div class="login-container">
    <div class="col-md-6">
        <div class="card login-card">
            <div class="card-body">
                <h2 class="text-center mb-4">Login</h2>
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

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
