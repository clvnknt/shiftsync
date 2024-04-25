@extends('layouts.app')

@section('title', 'In/Out - StaffCentral')

@section('content')
<div class="container mt-4">
    <!-- Header: In/Out -->
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">In/Out</h2>
        </div>
    </div>

    <!-- Today's Shift Card -->
    <div class="card mb-4" style="border-radius: 20px; 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <!-- Display details of the active shift -->
            @if($activeShiftRecord)
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h5><img src="{{ asset('media/images/icons/inout/todays-shift.png') }}" alt="Today's Shift Icon" class="img-fluid" style="width: 70px; height: 70px; margin-right: 10px;">Today's Shift</h5>
                    <p class="mb-1"><strong>Shift Name:</strong> {{ optional($activeShiftRecord->employeeAssignedShift)->shiftSchedule->shift_name ?? 'Not available' }}</p>
                    <p class="mb-1"><strong>Shift Date:</strong> {{ \Carbon\Carbon::parse($activeShiftRecord->shift_date)->format('F j, Y') }}</p>
                </div>
            </div>
            <!-- Clock-in/Clock-out buttons -->
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <!-- Clock-in button -->
                        <div style="width: 22%;">
                            <form action="{{ route('startShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->start_shift ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->start_shift ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ $activeShiftRecord->start_shift ? 'disabled' : '' }}>
                                    <img src="{{ asset('media/images/icons/inout/null/SS_NULL.png') }}" alt="Clock In Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                    <span class="d-block">Clock In: {{ $activeShiftRecord->start_shift ? $activeShiftRecord->start_shift->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                        <!-- Start Lunch button -->
                        <div style="width: 22%;">
                            <form action="{{ route('startLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->start_lunch ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->start_lunch ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->start_shift ? 'disabled' : ($activeShiftRecord->start_lunch ? 'disabled' : '') }}>
                                    <img src="{{ asset('media/images/icons/inout/null/LS_NULL.png') }}" alt="Start Lunch Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                    <span class="d-block">Start Lunch: {{ $activeShiftRecord->start_lunch ? $activeShiftRecord->start_lunch->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                        <!-- End Lunch button -->
                        <div style="width: 22%;">
                            <form action="{{ route('endLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->end_lunch ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->end_lunch ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->start_lunch ? 'disabled' : ($activeShiftRecord->end_lunch ? 'disabled' : '') }}>
                                    <img src="{{ asset('media/images/icons/inout/null/LE_NULL.png') }}" alt="End Lunch Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                    <span class="d-block">End Lunch: {{ $activeShiftRecord->end_lunch ? $activeShiftRecord->end_lunch->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                        <!-- Clock-out button -->
                        <div style="width: 22%;">
                            <form action="{{ route('endShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->end_shift ? 'btn-warning' : 'btn-danger' }}" style="background-color: {{ $activeShiftRecord->end_shift ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->end_lunch ? 'disabled' : ($activeShiftRecord->end_shift ? 'disabled' : '') }}>
                                    <img src="{{ asset('media/images/icons/inout/null/SE_NULL.png') }}" alt="Clock Out Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                    <span class="d-block">Clock Out: {{ $activeShiftRecord->end_shift ? $activeShiftRecord->end_shift->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p class="card-text">No active shift record found for today or not all shift details are logged.</p>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Current Assigned Shifts Card -->
        <div class="col-md-6 mb-4" style="border-radius: 20px;">
            <div class="card mb-4 h-100" style="border-radius: 20px; 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5><img src="{{ asset('media/images/icons/inout/shift_schedules.png') }}" alt="Assigned Shifts Icon" class="img-fluid" style="width: 70px; height: 70px; margin-right: 10px;">Currently Assigned Shifts</h5>
                    @if ($currentAssignedShifts->isEmpty())
                    <p>No current assigned shifts found.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($currentAssignedShifts as $assignedShift)
                        <li class="list-group-item">
                            <strong>{{ $assignedShift->shiftSchedule->shift_name }} {{ 'UTC' . \Carbon\Carbon::now($assignedShift->shiftSchedule->shift_timezone)->offsetHours }}
                            </strong>
                            <br>
                            <span>Start Time: {{ $assignedShift->shiftSchedule->start_shift_time }}</span>
                            <br>
                            <span>Lunch Start Time: {{ $assignedShift->shiftSchedule->lunch_start_time }}</span>
                            <br>
                            <span>End Lunch Time: {{ $assignedShift->shiftSchedule->end_lunch_time }}</span>
                            <br>
                            <span>End Time: {{ $assignedShift->shiftSchedule->end_shift_time }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    
        <!-- Timesheet Card -->
        <div class="col-md-6 mb-4" style="border-radius: 20px;">
            <div class="card mb-4 h-100" style="border-radius: 20px; 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5><img src="{{ asset('media/images/icons/inout/timesheet.png') }}" alt="Timesheet Icon" class="img-fluid" style="width: 70px; height: 70px; margin-right: 10px;">Timesheet</h5>
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <img src="{{ asset('media/images/icons/inout/timesheet-lock-in.png') }}" alt="Lock Icon" class="img-fluid mb-1" style="max-width: 100px;">
                        <p class="text-center text-muted">Your cutoff period will be {{ \Carbon\Carbon::now()->format('F') }} {{ \Carbon\Carbon::now()->day }} and {{ \Carbon\Carbon::now()->toFormattedDateString() }}.</p>
                        <p class="text-center text-muted">Make sure to lock in your timesheet by clicking <a href="#">here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
