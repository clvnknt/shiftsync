@extends('layouts.app')

@section('title', 'In/Out')

@section('content')
<div class="container mt-2 mb-5">

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

        <!-- Current Shift Card -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">Current Shift</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($currentShift)
                        <p>Shift Name: {{ $currentShift->shift_name }}</p>
                        <p>Start Shift: {{ \Carbon\Carbon::parse($currentShift->start_shift_time)->format('H:i') }}</p>
                        <p>Start Lunch: {{ \Carbon\Carbon::parse($currentShift->lunch_start_time)->format('H:i') }}</p>
                    @else
                        <p>No shift assigned.</p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($currentShift)
                        <p>End Lunch: {{ \Carbon\Carbon::parse($currentShift->end_lunch_time)->format('H:i') }}</p>
                        <p>End Shift: {{ \Carbon\Carbon::parse($currentShift->end_shift_time)->format('H:i') }}</p>
                    @endif
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
                            <img src="{{ asset('media/images/icons/inout/SS.png') }}" alt="Start Shift Icon" class="mb-2 img-fluid">
                            @if($employeeShiftRecord && $employeeShiftRecord->start_shift)
                                <p>Shift Started: {{ \Carbon\Carbon::parse($employeeShiftRecord->start_shift)->format('H:i') }}</p>
                            @else
                                <form action="{{ route('startShift') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">Start Shift</button>
                                </form>
                            @endif
                        </div>

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('media/images/icons/inout/LS.png') }}" alt="Start Lunch Icon" class="mb-2 img-fluid">
                            @if($employeeShiftRecord && $employeeShiftRecord->start_lunch)
                                <p>Lunch Ended: {{ \Carbon\Carbon::parse($employeeShiftRecord->start_lunch)->format('H:i') }}</p>
                            @else
                                <form action="{{ route('startLunch') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">Start Lunch</button>
                                </form>
                            @endif
                        </div>

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('media/images/icons/inout/LE.png') }}" alt="End Lunch Icon" class="mb-2 img-fluid">
                            @if($employeeShiftRecord && $employeeShiftRecord->end_lunch)
                                <p>Lunch Ended: {{ \Carbon\Carbon::parse($employeeShiftRecord->end_lunch)->format('H:i') }}</p>
                            @else
                                <form action="{{ route('endLunch') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">End Lunch</button>
                                </form>
                            @endif
                        </div>

                        <div class="col-md-2 text-center">
                            <img src="{{ asset('media/images/icons/inout/SE.png') }}" alt="End Shift Icon" class="mb-2 img-fluid">
                            @if($employeeShiftRecord && $employeeShiftRecord->end_shift)
                                <p>Shift Ended: {{ \Carbon\Carbon::parse($employeeShiftRecord->end_shift)->format('H:i') }}</p>
                            @else
                                <form action="{{ route('endShift') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">End Shift</button>
                                </form>
                            @endif
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
