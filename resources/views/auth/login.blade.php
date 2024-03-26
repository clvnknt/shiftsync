@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
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
</div>
@endsection
