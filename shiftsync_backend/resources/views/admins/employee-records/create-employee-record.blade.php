<!-- resources/views/admins/employee-records/create.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Create Employee Record')

@section('content')
    <div class="container mt-5">
        <h2>Create Employee Record</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.employee-records.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select id="user_id" class="form-control" name="user_id" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select id="department_id" class="form-control" name="department_id" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select id="role_id" class="form-control" name="role_id" required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="address_id" class="form-label">Address</label>
                <select id="address_id" class="form-control" name="address_id" required>
                    <option value="">Select Address</option>
                    @foreach($addresses as $address)
                        <option value="{{ $address->id }}">{{ $address->employee_street }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="emergency_contact_id" class="form-label">Emergency Contact</label>
                <select id="emergency_contact_id" class="form-control" name="emergency_contact_id" required>
                    <option value="">Select Emergency Contact</option>
                    @foreach($emergencyContacts as $emergencyContact)
                        <option value="{{ $emergencyContact->id }}">{{ $emergencyContact->contact_first_name }} {{ $emergencyContact->contact_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="employee_first_name" class="form-label">First Name</label>
                <input id="employee_first_name" type="text" class="form-control" name="employee_first_name" required>
            </div>

            <div class="mb-3">
                <label for="employee_middle_name" class="form-label">Middle Name</label>
                <input id="employee_middle_name" type="text" class="form-control" name="employee_middle_name" required>
            </div>

            <div class="mb-3">
                <label for="employee_last_name" class="form-label">Last Name</label>
                <input id="employee_last_name" type="text" class="form-control" name="employee_last_name" required>
            </div>

            <div class="mb-3">
                <label for="employee_suffix" class="form-label">Suffix</label>
                <input id="employee_suffix" type="text" class="form-control" name="employee_suffix" required>
            </div>

            <div class="mb-3">
                <label for="employee_gender" class="form-label">Gender</label>
                <select id="employee_gender" class="form-control" name="employee_gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="employee_age" class="form-label">Age</label>
                <input id="employee_age" type="number" class="form-control" name="employee_age" required>
            </div>

            <div class="mb-3">
                <label for="employee_birthdate" class="form-label">Birthdate</label>
                <input id="employee_birthdate" type="date" class="form-control" name="employee_birthdate" required>
            </div>

            <div class="mb-3">
                <label for="employee_profile_picture" class="form-label">Profile Picture</label>
                <input id="employee_profile_picture" type="text" class="form-control" name="employee_profile_picture" required>
            </div>

            <div class="mb-3">
                <label for="employee_timezone" class="form-label">Timezone</label>
                <input id="employee_timezone" type="text" class="form-control" name="employee_timezone" value="+08:00" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Employee Record</button>
        </form>
    </div>
@endsection