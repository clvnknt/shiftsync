<!-- resources/views/admins/roles/create.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Create Role')

@section('content')
    <div class="container mt-5">
        <h2>Create Role</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.roles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select id="department_id" class="form-control" name="department_id" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="role_name" class="form-label">Role Name</label>
                <input id="role_name" type="text" class="form-control" name="role_name" required>
            </div>

            <div class="mb-3">
                <label for="role_description" class="form-label">Role Description</label>
                <textarea id="role_description" class="form-control" name="role_description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Role</button>
        </form>
    </div>
@endsection