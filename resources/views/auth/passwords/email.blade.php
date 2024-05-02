@extends('layouts.app')

@section('title', 'Password Reset - StaffCentral')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Password Reset</h2>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
