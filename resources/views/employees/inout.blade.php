@extends('layouts.app')

@section('title', 'In/Out')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">In/Out</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Employee Information</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->employeeRecord->employee_first_name }} {{ Auth::user()->employeeRecord->employee_last_name }}</p>
                    <p><strong>Position:</strong> {{ Auth::user()->employeeRecord->role->role_name }}</p>
                    <p><strong>Department:</strong> {{ Auth::user()->employeeRecord->department->department_name }}</p>
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
                            <p><strong>Shift Name:</strong> N/A</p>
                            <p><strong>Start Shift:</strong> N/A</p>
                            <p><strong>Start Lunch:</strong> N/A</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>End Lunch:</strong> N/A</p>
                            <p><strong>End Shift:</strong> N/A</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Today's Shift</div>
                <div class="card-body">
                    <p><strong>Shift Date:</strong> {{ $employeeShiftRecord ? \Carbon\Carbon::parse($employeeShiftRecord->shift_date)->format('F d, Y') : 'No shift record found for today.' }}</p>
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
                                    <p><strong>Start Shift:</strong> {{ $employeeShiftRecord->start_shift ?? 'N/A' }}</p>
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
                                    <p><strong>Start Lunch:</strong> {{ $employeeShiftRecord->start_lunch ?? '-' }}</p>
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
                                    <p><strong>End Lunch:</strong> {{ $employeeShiftRecord->end_lunch ?? '-' }}</p>
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
                                    <p><strong>End Shift:</strong> {{ $employeeShiftRecord->end_shift ?? '-' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Next Shift</div>
                                <div class="card-body">
                                    @if($employeeShiftRecord)
                                        <?php
                                            $nextShiftDate = \Carbon\Carbon::parse($employeeShiftRecord->shift_date)->addDay();
                                        ?>
                                        <p>The employee's next shift will be on {{ $nextShiftDate->format('F d, Y') }}</p>
                                    @else
                                        <p>No shift record found for today.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Metrics</div>
                <div class="card-body">
                    Placeholder information for metrics.
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tasks</div>
                <div class="card-body">
                    Placeholder information for tasks.
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Notifications</div>
                <div class="card-body">
                    Placeholder information for new notifications.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
