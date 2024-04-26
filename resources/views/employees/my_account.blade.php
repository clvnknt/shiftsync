@extends('layouts.app')

@section('title', 'My Account - StaffCentral')

@section('content')
    <style>
        .card {
            border-radius: 20px;
            overflow: hidden; /* Ensure content does not overflow rounded corners */
        }
        .card-title {
            display: flex;
            align-items: center;
        }
        .card-title-icon {
            margin-right: 10px;
            width: 70px; /* Set the width of the icon */
            height: 70px; /* Set the height of the icon */
        }
    </style>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">My Account</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/account-information.png') }}" alt="Account Information" class="card-title-icon">
                            Account Information
                        </h5>
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/employee-information.png') }}" alt="Employee Information" class="card-title-icon">
                            Employee Information
                        </h5>
                        <p><strong>First Name:</strong> {{ $employeeRecord->employee_first_name }}</p>
                        <p><strong>Last Name:</strong> {{ $employeeRecord->employee_last_name }}</p>
                        <p><strong>Gender:</strong> {{ $employeeRecord->employee_gender }}</p>
                        <p><strong>Age:</strong> {{ $employeeRecord->employee_age }}</p>
                        <p><strong>Birthdate:</strong> {{ $employeeRecord->employee_birthdate }}</p>
                        <p><strong>Timezone:</strong> {{ $employeeRecord->employee_timezone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/address-information.png') }}" alt="Address Information" class="card-title-icon">
                            Address Information
                        </h5>
                        <p><strong>Street:</strong> {{ $address->employee_street }}</p>
                        <p><strong>City:</strong> {{ $address->employee_city }}</p>
                        <p><strong>Country:</strong> {{ $address->employee_country }}</p>
                        <p><strong>Postal Code:</strong> {{ $address->employee_postal_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/emergency-contact-information.png') }}" alt="Emergency Contact Information" class="card-title-icon">
                            Emergency Contact Information
                        </h5>
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
