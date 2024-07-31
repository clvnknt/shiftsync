<!-- resources/views/admins/employee-records/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Employee Record')

@section('content')
    <div class="container mt-5">
        <h2>View Employee Record</h2>

        <div class="mb-3">
            <label for="employee_first_name" class="form-label">First Name</label>
            <input id="employee_first_name" type="text" class="form-control" value="{{ $employeeRecord->employee_first_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_middle_name" class="form-label">Middle Name</label>
            <input id="employee_middle_name" type="text" class="form-control" value="{{ $employeeRecord->employee_middle_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_last_name" class="form-label">Last Name</label>
            <input id="employee_last_name" type="text" class="form-control" value="{{ $employeeRecord->employee_last_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_suffix" class="form-label">Suffix</label>
            <input id="employee_suffix" type="text" class="form-control" value="{{ $employeeRecord->employee_suffix }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_gender" class="form-label">Gender</label>
            <input id="employee_gender" type="text" class="form-control" value="{{ ucfirst($employeeRecord->employee_gender) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_age" class="form-label">Age</label>
            <input id="employee_age" type="text" class="form-control" value="{{ $employeeRecord->employee_age }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_birthdate" class="form-label">Birthdate</label>
            <input id="employee_birthdate" type="date" class="form-control" value="{{ $employeeRecord->employee_birthdate }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_profile_picture" class="form-label">Profile Picture</label>
            <input id="employee_profile_picture" type="text" class="form-control" value="{{ $employeeRecord->employee_profile_picture }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_timezone" class="form-label">Timezone</label>
            <input id="employee_timezone" type="text" class="form-control" value="{{ $employeeRecord->employee_timezone }}" readonly>
        </div>

        <div class="mb-3">
            <label for="user" class="form-label">User</label>
            <input id="user" type="text" class="form-control" value="{{ $employeeRecord->user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input id="department" type="text" class="form-control" value="{{ $employeeRecord->department->department_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input id="role" type="text" class="form-control" value="{{ $employeeRecord->role->role_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input id="address" type="text" class="form-control" value="{{ $employeeRecord->address->employee_street }}" readonly>
        </div>

        <div class="mb-3">
            <label for="emergency_contact" class="form-label">Emergency Contact</label>
            <input id="emergency_contact" type="text" class="form-control" value="{{ $employeeRecord->emergencyContact->contact_first_name }} {{ $employeeRecord->emergencyContact->contact_last_name }}" readonly>
        </div>

        <a href="{{ route('admins.employee-records.index') }}" class="btn btn-secondary">Back to Employee Records</a>
    </div>
@endsection