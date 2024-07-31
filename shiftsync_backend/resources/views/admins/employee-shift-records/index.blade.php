<!-- resources/views/admins/employee-shift-records/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Employee Shift Records')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Employee Shift Records</h2>
            <a href="{{ route('admins.employee-shift-records.create') }}" class="btn btn-primary btn-sm">Add Shift Record</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Shift Date</th>
                    <th>End Shift Date</th>
                    <th>Hours Rendered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shiftRecords as $shiftRecord)
                    <tr>
                        <td>{{ $shiftRecord->id }}</td>
                        <td>{{ $shiftRecord->employeeRecord->employee_first_name }} {{ $shiftRecord->employeeRecord->employee_last_name }}</td>
                        <td>{{ $shiftRecord->shift_date }}</td>
                        <td>{{ $shiftRecord->end_shift_date }}</td>
                        <td>{{ $shiftRecord->hours_rendered }}</td>
                        <td>
                            <a href="{{ route('admins.employee-shift-records.edit', $shiftRecord->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.employee-shift-records.destroy', $shiftRecord->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.employee-shift-records.show', $shiftRecord->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection