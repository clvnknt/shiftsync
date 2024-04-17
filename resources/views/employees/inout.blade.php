@extends('layouts.app')

@section('title', 'In/Out')

@section('content')
<div class="container mt-4">
    <!-- Header: In/Out -->
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">In/Out</h2>
        </div>
    </div>

    <!-- Today's Shift Card -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Today's Shift</h5>
        </div>
        <div class="card-body">
            <!-- Display details of the active shift -->
            @if($activeShiftRecord)
            <div class="row">
                <div class="col-md-12 mb-3">
                    <p class="mb-1"><strong>Shift Name:</strong> {{ optional($activeShiftRecord->employeeAssignedShift)->shiftSchedule->shift_name ?? 'Not available' }}</p>
                    <p class="mb-1"><strong>Shift Date:</strong> {{ \Carbon\Carbon::parse($activeShiftRecord->shift_date)->format('F j, Y') }}</p>
                    <p class="mb-1"><strong>Timezone:</strong> UTC {{ $activeShiftRecord->assigned_timezone }}</p>
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
                                    <img src="{{ $activeShiftRecord->start_shift ? asset('media/images/icons/inout/has_value/SS_HAS_VALUE.png') : asset('media/images/icons/inout/null/SS_NULL.png') }}" alt="Clock In Icon" class="img-fluid mb-1" style="max-width: 50px;">
                                    <span class="d-block">Clock In: {{ $activeShiftRecord->start_shift ? \Carbon\Carbon::parse($activeShiftRecord->start_shift)->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                        <!-- Start Lunch button -->
                        <div style="width: 22%;">
                            <form action="{{ route('startLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->start_lunch ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->start_lunch ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->start_shift ? 'disabled' : ($activeShiftRecord->start_lunch ? 'disabled' : '') }}>
                                    <img src="{{ $activeShiftRecord->start_lunch ? asset('media/images/icons/inout/has_value/LS_HAS_VALUE.png') : asset('media/images/icons/inout/null/LS_NULL.png') }}" alt="Start Lunch Icon" class="img-fluid mb-1" style="max-width: 50px;">
                                    <span class="d-block">Start Lunch: {{ $activeShiftRecord->start_lunch ? Carbon\Carbon::parse($activeShiftRecord->start_shift)->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                        <!-- End Lunch button -->
                        <div style="width: 22%;">
                            <form action="{{ route('endLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->end_lunch ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->end_lunch ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->start_lunch ? 'disabled' : ($activeShiftRecord->end_lunch ? 'disabled' : '') }}>
                                    <img src="{{ $activeShiftRecord->end_lunch ? asset('media/images/icons/inout/has_value/LE_HAS_VALUE.png') : asset('media/images/icons/inout/null/LE_NULL.png') }}" alt="End Lunch Icon" class="img-fluid mb-1" style="max-width: 50px;">
                                    <span class="d-block">End Lunch: {{ $activeShiftRecord->end_lunch ? Carbon\Carbon::parse($activeShiftRecord->start_shift)->format('H:i') : '-' }}</span>
                                </button>
                            </form>
                        </div>
                        <!-- Clock-out button -->
                        <div style="width: 22%;">
                            <form action="{{ route('endShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-block mb-2 {{ $activeShiftRecord->end_shift ? 'btn-warning' : 'btn-danger' }}" style="background-color: {{ $activeShiftRecord->end_shift ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->end_lunch ? 'disabled' : ($activeShiftRecord->end_shift ? 'disabled' : '') }}>
                                    <img src="{{ $activeShiftRecord->end_shift ? asset('media/images/icons/inout/has_value/SE_HAS_VALUE.png') : asset('media/images/icons/inout/null/SE_NULL.png') }}" alt="Clock Out Icon" class="img-fluid mb-1" style="max-width: 50px;">
                                    <span class="d-block">Clock Out: {{ $activeShiftRecord->end_shift ? Carbon\Carbon::parse($activeShiftRecord->start_shift)->format('H:i') : '-' }}</span>
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

<!-- Currently Assigned Shifts and Timesheet Cards -->
<div class="row">
    <!-- Current Assigned Shifts Card -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Currently Assigned Shifts</h5>
            </div>
            <div class="card-body">
                @if ($currentAssignedShifts->isEmpty())
                <p>No current assigned shifts found.</p>
                @else
                <ul class="list-group">
                    @foreach ($currentAssignedShifts as $assignedShift)
                    <li class="list-group-item">
                        <strong>{{ $assignedShift->shiftSchedule->shift_name }}</strong>
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
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Timesheet</h5>
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('media/images/icons/inout/Timesheet_Lock.png') }}" alt="Lock Icon" class="img-fluid mb-1" style="max-width: 100px;">
                <p class="text-center text-muted">Your cutoff period will be {{ \Carbon\Carbon::now()->format('F') }} {{ \Carbon\Carbon::now()->day }} and {{ \Carbon\Carbon::now()->toFormattedDateString() }}.</p>
                <p class="text-center text-muted">Make sure to lock in your timesheet by clicking <a href="#">here</a>.</p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection