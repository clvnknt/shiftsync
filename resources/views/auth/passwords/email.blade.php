@extends('layouts.app')

@section('title', 'Password Reset - StaffCentral')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="card p-4 border-0 rounded-3" style="width: 30rem; overflow: hidden;"> <!-- Added p-4 class for margin -->
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Password Reset</h2>
                <p class="text-muted mb-4">Enter your email address below and we'll send you a link to reset your password.</p>
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="mb-3">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus placeholder="Enter your email here">

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary w-auto">Send Link</button> <!-- Changed width class to w-auto -->
                        </div>
                        <div class="col-auto ml-3">
                            <a href="{{ route('login') }}"  class="text-muted">Back to Login</a> <!-- Removed ml-3 class -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
