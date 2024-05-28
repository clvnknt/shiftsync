<!-- resources/views/admins/employee-assigned-shifts/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Employee Assigned Shifts')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Employee Assigned Shifts</h2>
            <a href="{{ route('admins.employee-assigned-shifts.create') }}" class="btn btn-primary btn-sm">Add Shift Assignment</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Shift</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignedShifts as $assignedShift)
                    <tr>
                        <td>{{ $assignedShift->id }}</td>
                        <td>{{ $assignedShift->employeeRecord->employee_first_name }} {{ $assignedShift->employeeRecord->employee_last_name }}</td>
                        <td>{{ $assignedShift->shiftSchedule ? $assignedShift->shiftSchedule->shift_name : 'N/A' }}</td>
                        <td>{{ $assignedShift->is_active ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admins.employee-assigned-shifts.edit', $assignedShift->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.employee-assigned-shifts.destroy', $assignedShift->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.employee-assigned-shifts.show', $assignedShift->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection