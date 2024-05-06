@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-8 d-flex justify-content-center">
                <div class="card" style="max-width: 420px;"> <!-- Adjusted max-width -->
                    <div class="card-body">
                        <h5 class="card-title text-center mb-2">{{ __('Reset Password') }}</h5>
                        <p class="text-muted text-center mb-4">Please enter your email and create a new password to reset your account access.</p> <!-- Adjusted description -->

                        <form method="POST" action="{{ route('password.update') }}" class="w-100">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('New Password') }}</label>
                                <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                                <a href="{{ route('login') }}" class="btn btn-link">{{ __('Back to Login') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsections