@extends('layouts.app')

@section('title', 'Company In/Out System')

@section('content')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-4">
                    <h1>Welcome to StaffCentral</h1>
                    <p>Our system simplifies employee attendance tracking, making it easier for you to manage your workforce.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('media/images/icons/landing/CIO.png') }}" alt="Clock In/Out" class="mr-3" style="width: 100px; margin-right: 20px;">
                                <div>
                                    <h5 class="card-title mb-3">Clock In/Out</h5>
                                    <p class="card-text mb-0">Employees can easily clock in and out using our system.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('media/images/icons/landing/AR.png') }}" alt="Attendance Reports" class="mr-3" style="width: 100px; margin-right: 20px;">
                                <div>
                                    <h5 class="card-title mb-3">Attendance Reports</h5>
                                    <p class="card-text mb-0">Generate detailed attendance reports for better management.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('media/images/icons/landing/LM.png') }}" alt="Leave Management" class="mr-3" style="width: 100px; margin-right: 20px;">
                                <div>
                                    <h5 class="card-title mb-3">Leave Management</h5>
                                    <p class="card-text mb-0">Manage employee leave requests efficiently.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('media/images/icons/landing/SS.png') }}" alt="Shift Scheduling" class="mr-3" style="width: 100px; margin-right: 20px;">
                                <div>
                                    <h5 class="card-title mb-3">Shift Scheduling</h5>
                                    <p class="card-text mb-0">Easily create and manage employee shift schedules.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
