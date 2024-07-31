<!-- resources/views/admins/roles/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Roles')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Roles</h2>
            <a href="{{ route('admins.roles.create') }}" class="btn btn-primary btn-sm">Add Role</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->department->department_name }}</td>
                        <td>{{ $role->role_name }}</td>
                        <td>{{ $role->role_description }}</td>
                        <td>
                            <a href="{{ route('admins.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.roles.show', $role->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection