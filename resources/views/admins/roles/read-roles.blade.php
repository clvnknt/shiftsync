<!-- resources/views/admins/roles/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Role')

@section('content')
    <div class="container mt-5">
        <h2>View Role</h2>

        <div class="mb-3">
            <label for="department_name" class="form-label">Department</label>
            <input id="department_name" type="text" class="form-control" value="{{ $role->department->department_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="role_name" class="form-label">Role Name</label>
            <input id="role_name" type="text" class="form-control" value="{{ $role->role_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="role_description" class="form-label">Role Description</label>
            <textarea id="role_description" class="form-control" readonly>{{ $role->role_description }}</textarea>
        </div>

        <a href="{{ route('admins.roles.index') }}" class="btn btn-secondary">Back to Roles</a>
    </div>
@endsection