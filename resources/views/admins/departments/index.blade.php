<!-- resources/views/admins/departments/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Departments')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Departments</h2>
            <a href="{{ route('admins.departments.create') }}" class="btn btn-primary btn-sm">Add Department</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->department_name }}</td>
                        <td>{{ $department->department_description }}</td>
                        <td>
                            <a href="{{ route('admins.departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.departments.destroy', $department->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.departments.show', $department->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection