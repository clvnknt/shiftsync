<!-- resources/views/admins/employee-records/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Employee Records')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Employee Records</h2>
            <a href="{{ route('admins.employee-records.create') }}" class="btn btn-primary btn-sm">Add Employee Record</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employeeRecords as $employeeRecord)
                    <tr>
                        <td>{{ $employeeRecord->id }}</td>
                        <td>{{ $employeeRecord->employee_first_name }}</td>
                        <td>{{ $employeeRecord->employee_last_name }}</td>
                        <td>{{ $employeeRecord->department->department_name }}</td>
                        <td>{{ $employeeRecord->role->role_name }}</td>
                        <td>
                            <a href="{{ route('admins.employee-records.edit', $employeeRecord->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.employee-records.destroy', $employeeRecord->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.employee-records.show', $employeeRecord->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection