<!-- resources/views/admins/departments/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Department')

@section('content')
    <div class="container mt-5">
        <h2>View Department</h2>

        <div class="mb-3">
            <label for="department_name" class="form-label">Department Name</label>
            <input id="department_name" type="text" class="form-control" value="{{ $department->department_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="department_description" class="form-label">Department Description</label>
            <textarea id="department_description" class="form-control" readonly>{{ $department->department_description }}</textarea>
        </div>

        <a href="{{ route('admins.departments.index') }}" class="btn btn-secondary">Back to Departments</a>
    </div>
@endsection