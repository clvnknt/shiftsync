<!-- resources/views/admins/departments/edit.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Edit Department')

@section('content')
    <div class="container mt-5">
        <h2>Edit Department</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.departments.update-emergency-contacts', $department->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="department_name" class="form-label">Department Name</label>
                <input id="department_name" type="text" class="form-control" name="department_name" value="{{ $department->department_name }}" required>
            </div>

            <div class="mb-3">
                <label for="department_description" class="form-label">Department Description</label>
                <textarea id="department_description" class="form-control" name="department_description">{{ $department->department_description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Department</button>
        </form>
    </div>
@endsection