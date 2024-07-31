<!-- resources/views/admins/employee-assigned-shifts/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Shift Assignment')

@section('content')
    <div class="container mt-5">
        <h2>View Shift Assignment</h2>

        <div class="mb-3">
            <label for="employee" class="form-label">Employee</label>
            <input id="employee" type="text" class="form-control" value="{{ $assignedShift->employeeRecord->employee_first_name }} {{ $assignedShift->employeeRecord->employee_last_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="shift_schedule" class="form-label">Shift Schedule</label>
            <input id="shift_schedule" type="text" class="form-control" value="{{ $assignedShift->shiftSchedule ? $assignedShift->shiftSchedule->shift_name : 'N/A' }}" readonly>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Is Active</label>
            <input id="is_active" type="text" class="form-control" value="{{ $assignedShift->is_active ? 'Yes' : 'No' }}" readonly>
        </div>

        <a href="{{ route('admins.employee-assigned-shifts.index') }}" class="btn btn-secondary">Back to Shift Assignments</a>
    </div>
@endsection