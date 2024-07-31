<!-- resources/views/admins/departments/create.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Create Department')

@section('content')
    <div class="container mt-5">
        <h2>Create Department</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.departments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="department_name" class="form-label">Department Name</label>
                <input id="department_name" type="text" class="form-control" name="department_name" required>
            </div>

            <div class="mb-3">
                <label for="department_description" class="form-label">Department Description</label>
                <textarea id="department_description" class="form-control" name="department_description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Department</button>
        </form>
    </div>
@endsection