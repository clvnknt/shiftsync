<!-- resources/views/admins/employee-assigned-shifts/create.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Create Shift Assignment')

@section('content')
    <div class="container mt-5">
        <h2>Create Shift Assignment</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.employee-assigned-shifts.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_record_id" class="form-label">Employee</label>
                <select id="employee_record_id" class="form-control" name="employee_record_id" required>
                    <option value="">Select Employee</option>
                    @foreach($employeeRecords as $employeeRecord)
                        <option value="{{ $employeeRecord->id }}">{{ $employeeRecord->employee_first_name }} {{ $employeeRecord->employee_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="shift_schedule_id" class="form-label">Shift Schedule</label>
                <select id="shift_schedule_id" class="form-control" name="shift_schedule_id">
                    <option value="">Select Shift Schedule</option>
                    @foreach($shiftSchedules as $shiftSchedule)
                        <option value="{{ $shiftSchedule->id }}">{{ $shiftSchedule->shift_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">Is Active</label>
                <select id="is_active" class="form-control" name="is_active" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Shift Assignment</button>
        </form>
    </div>
@endsection