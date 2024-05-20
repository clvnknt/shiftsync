@extends('layouts.app')

@section('title', 'ShiftSync - My Account')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">My Account</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4"> 
                <div class="card h-100" style="background-color: #484848; color: white;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/DP.png') }}" alt="Account Information" class="card-title-icon">
                            Account Information
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                @if ($user->hasVerifiedEmail())
                                    <p><strong>Email Verified:</strong> Yes</p>
                                @else
                                    <p><strong>Email Verified:</strong> No</p>
                                    <p>Please verify your email address. <a href="{{ route('verification.notice') }}" style="color: white; text-decoration: underline;">Send verification email</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100" style="background-color: #484848; color: white;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/MA-EI.png') }}" alt="Employee Information" class="card-title-icon">
                            Employee Information
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>First Name:</strong> {{ $employeeRecord->employee_first_name }}</p>
                                <p><strong>Last Name:</strong> {{ $employeeRecord->employee_last_name }}</p>
                                <p><strong>Gender:</strong> {{ $employeeRecord->employee_gender }}</p>
                                <p><strong>Age:</strong> {{ $employeeRecord->employee_age }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Birthdate:</strong> {{ $employeeRecord->employee_birthdate }}</p>
                                <p><strong>Timezone:</strong> {{ $employeeRecord->employee_timezone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100" style="background-color: #484848; color: white;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/MA-AI.png') }}" alt="Address Information" class="card-title-icon">
                            Address Information
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Street:</strong> {{ $address->employee_street }}</p>
                                <p><strong>City:</strong> {{ $address->employee_city }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Country:</strong> {{ $address->employee_country }}</p>
                                <p><strong>Postal Code:</strong> {{ $address->employee_postal_code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card h-100" style="background-color: #484848; color: white;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <img src="{{ asset('media/images/icons/my_account/MA-EC.png') }}" alt="Emergency Contact Information" class="card-title-icon">
                            Emergency Contact Information
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>First Name:</strong> {{ $emergencyContact->contact_first_name }}</p>
                                <p><strong>Last Name:</strong> {{ $emergencyContact->contact_last_name }}</p>
                                <p><strong>Relationship:</strong> {{ $emergencyContact->contact_relationship }}</p>
                                <p><strong>Phone Number:</strong> {{ $emergencyContact->contact_phone_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Street:</strong> {{ $emergencyContact->contact_street }}</p>
                                <p><strong>City:</strong> {{ $emergencyContact->contact_city }}</p>
                                <p><strong>Country:</strong> {{ $emergencyContact->contact_country }}</p>
                                <p><strong>Postal Code:</strong> {{ $emergencyContact->contact_postal_code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 20px;
            background-color: #484848; /* Card background color */
            color: white; /* Text color */
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
        a {
            color: white;
            text-decoration: underline;
        }
        a:hover {
            color: #ccc;
        }
    </style>
@endsection