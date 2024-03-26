@extends('layouts.app')

@section('title', 'In/Out')

@section('content')

<div class="container mt-4 mb-5">

    <h2 class="text-center mb-4">In/Out</h2>

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Employee Information</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Name: {{ Auth::user()->employeeRecord->employee_first_name }} {{ Auth::user()->employeeRecord->employee_last_name }}</p>
                            <p>Position: {{ Auth::user()->employeeRecord->role->role_name }}</p>

                        </div>
                        <div class="col-md-6">
                            <p>Department: {{ Auth::user()->employeeRecord->department->department_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Current Shift</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Start Shift: {{ \Carbon\Carbon::parse(Auth::user()->employeeRecord->shift->start_shift_time)->format('H:i') }}</p>
                            <p>Start Lunch: {{ \Carbon\Carbon::parse(Auth::user()->employeeRecord->shift->lunch_start_time)->format('H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>End Lunch: {{ \Carbon\Carbon::parse(Auth::user()->employeeRecord->shift->end_lunch_time)->format('H:i') }}</p>
                            <p>End Shift: {{ \Carbon\Carbon::parse(Auth::user()->employeeRecord->shift->end_shift_time)->format('H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">In/Out Actions</div>
                <div class="card-body">
                    <div class="col-md-6">
                        @if($employeeShiftRecord)
                        <h4>Current Shift Date: {{ $employeeShiftRecord ? \Carbon\Carbon::parse($employeeShiftRecord->shift_date)->format('F d, Y') : 'No shift record found for today.' }}</h4>
                        @else
                            <p>No shift record found for today.</p>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-center">
                            <img src="{{ asset('start_shift_image') }}" alt="Start Shift Icon" class="mb-2">
                            <form action="{{ route('startShift') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">Start Shift</button>
                            </form>
                        </div>

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('start_lunch_image') }}" alt="Start Lunch Icon" class="mb-2">
                            <form action="{{ route('startLunch') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">Start Lunch</button>
                            </form>
                        </div>

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('end_lunch_image') }}" alt="End Lunch Icon" class="mb-2">
                            <form action="{{ route('endLunch') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">End Lunch</button>
                            </form>
                        </div>

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('end_shift_image') }}" alt="End Shift Icon" class="mb-2">
                            <form action="{{ route('endShift') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">End Shift</button>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <hr>
                            <h4>Other Actions</h4>
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <img src="{{ asset('break_image') }}" alt="Break Icon" class="mb-2">
                                    <button class="btn btn-primary btn-block">Start Break</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
