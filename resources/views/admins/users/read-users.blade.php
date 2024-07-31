<!-- resources/views/admins/users/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View User')

@section('content')
    <div class="container mt-5">
        <h2>View User</h2>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control" value="{{ $user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
        </div>

        <div class="mb-3">
            <label for="is_admin" class="form-label">Admin</label>
            <input id="is_admin" type="text" class="form-control" value="{{ $user->is_admin ? 'Yes' : 'No' }}" readonly>
        </div>

        <a href="{{ route('admins.users.index') }}" class="btn btn-secondary">Back to Users</a>
    </div>
@endsection