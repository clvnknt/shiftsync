@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">My Account - StaffCentral</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Account Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Timezone:</strong> {{ $user->timezone }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Employee Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>First Name:</strong> {{ $employeeRecord->employee_first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $employeeRecord->employee_last_name }}</p>
                    <p><strong>Gender:</strong> {{ $employeeRecord->employee_gender }}</p>
                    <p><strong>Age:</strong> {{ $employeeRecord->employee_age }}</p>
                    <p><strong>Birthdate:</strong> {{ $employeeRecord->employee_birthdate }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Address Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Street:</strong> {{ $address->employee_street }}</p>
                    <p><strong>City:</strong> {{ $address->employee_city }}</p>
                    <p><strong>Country:</strong> {{ $address->employee_country }}</p>
                    <p><strong>Postal Code:</strong> {{ $address->employee_postal_code }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Emergency Contact Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>First Name:</strong> {{ $emergencyContact->contact_first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $emergencyContact->contact_last_name }}</p>
                    <p><strong>Relationship:</strong> {{ $emergencyContact->contact_relationship }}</p>
                    <p><strong>Phone Number:</strong> {{ $emergencyContact->contact_phone_number }}</p>
                    <p><strong>Street:</strong> {{ $emergencyContact->contact_street }}</p>
                    <p><strong>City:</strong> {{ $emergencyContact->contact_city }}</p>
                    <p><strong>Country:</strong> {{ $emergencyContact->contact_country }}</p>
                    <p><strong>Postal Code:</strong> {{ $emergencyContact->contact_postal_code }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
