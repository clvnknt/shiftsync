<!-- resources/views/admins/users/edit.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Edit User')

@section('content')
    <div class="container mt-5">
        <h2>Edit User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (leave empty if not changing)</label>
                <input id="password" type="password" class="form-control" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
            </div>

            <div class="mb-3 form-check">
                <input id="is_admin" type="checkbox" class="form-check-input" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
                <label for="is_admin" class="form-check-label">Is Admin</label>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection