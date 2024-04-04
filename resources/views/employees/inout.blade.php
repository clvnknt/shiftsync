@extends('layouts.app')

@section('title', 'In/Out')

@section('content')
<div class="container mt-4 mb-5">
    <!-- Header: In/Out -->
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">In/Out</h2>
        </div>
    </div>

    <!-- Employee Information and Current Shift Cards -->
    <div class="row">
        <!-- Employee Information Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header"><strong>Employee Information</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ Auth::user()->employeeRecord->employee_first_name }} {{ Auth::user()->employeeRecord->employee_last_name }}</p>
                            <p><strong>Position:</strong> {{ Auth::user()->employeeRecord->role->role_name }}</p>
                            <p><strong>Department:</strong> {{ Auth::user()->employeeRecord->department->department_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Timezone:</strong> {{ Auth::user()->timezone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Shift Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header"><strong>Current Shift</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Shift Name:</strong> {{ $defaultShift->shift_name }}</p>
                            <p><strong>Start Shift:</strong> {{ $defaultShift->start_shift_time }}</p>
                            <p><strong>Start Lunch:</strong> {{ $defaultShift->lunch_start_time }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>End Lunch:</strong> {{ $defaultShift->end_lunch_time }}</p>
                            <p><strong>End Shift:</strong> {{ $defaultShift->end_shift_time }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <!-- Today's Shift and Additional Information Cards -->
    <div class="row mt-4">
        <!-- Today's Shift Card -->
        <div class="col-md-6">
            <div class="card  h-100">
                <div class="card-header"><strong>Today's Shift</strong></div>
                <div class="card-body">
                    <p><strong>Shift Date:</strong> {{ $employeeShiftRecord ? \Carbon\Carbon::parse($employeeShiftRecord->shift_date)->format('F d, Y') : 'No shift record found for today.' }}</p>
                    @if($employeeShiftRecord)
                        <?php
                            $nextShiftDate = \Carbon\Carbon::parse($employeeShiftRecord->shift_date)->addDay();
                            $nextShiftDay = $nextShiftDate->format('l');
                        ?>
                        <p>Your next shift will be on {{ $nextShiftDate->format('F d, Y') }}, {{ $nextShiftDay }}.</p>
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ asset('media/images/icons/inout/SS.png') }}" alt="Start Shift Icon" class="mb-2 img-fluid" style="max-width: 70px;">
                                @if($employeeShiftRecord && !$employeeShiftRecord->start_shift)
                                    <form action="{{ route('startShift') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block">Start Shift</button>
                                    </form>
                                @else
                                    <p><strong>Shift Started</strong> {{ $employeeShiftRecord->start_shift ?? 'N/A' }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ asset('media/images/icons/inout/LS.png') }}" alt="Start Lunch Icon" class="mb-2 img-fluid" style="max-width: 70px;">
                                @if($employeeShiftRecord && $employeeShiftRecord->start_shift && !$employeeShiftRecord->start_lunch)
                                    <form action="{{ route('startLunch') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block">Start Lunch</button>
                                    </form>
                                @else
                                    <p><strong>Lunch Started</strong> {{ $employeeShiftRecord->start_lunch ?? '-' }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ asset('media/images/icons/inout/LE.png') }}" alt="End Lunch Icon" class="mb-2 img-fluid" style="max-width: 70px;">
                                @if($employeeShiftRecord && $employeeShiftRecord->start_lunch && !$employeeShiftRecord->end_lunch)
                                    <form action="{{ route('endLunch') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block">End Lunch</button>
                                    </form>
                                @else
                                    <p><strong>Lunch Ended</strong> {{ $employeeShiftRecord->end_lunch ?? '-' }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ asset('media/images/icons/inout/SE.png') }}" alt="End Shift Icon" class="mb-2 img-fluid" style="max-width: 70px;">
                                @if($employeeShiftRecord && $employeeShiftRecord->start_shift && !$employeeShiftRecord->end_shift)
                                    <form action="{{ route('endShift') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block">End Shift</button>
                                    </form>
                                @else
                                    <p><strong>Shift Ended</strong> {{ $employeeShiftRecord->end_shift ?? '-' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header"><strong>Notifications | Metrics | Tasks</strong></div>
                <div class="card-body">
                    <!-- Placeholder information for additional details -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection