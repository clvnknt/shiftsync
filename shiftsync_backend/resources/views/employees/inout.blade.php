@extends('layouts.app')

@section('title', 'ShiftSync - In/Out')

@section('styles')
<style>
   .custom-height {
       min-height: 710px; /* Adjust this value as needed to fit the height of the Timesheet card */
   }
</style>
@endsection

@section('content')
<div class="container mt-4 mb-5">
    <!-- Header: In/Out -->
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">In/Out</h2>
        </div>
    </div>

    <div class="row">
        <!-- Today's Shift Card -->
        <div class="col-md-6 mb-4">
            <div class="card custom-height" style="border-radius: 20px; background-color: #484848; color: white;">
                <div class="card-body">
                    <!-- Display details of the active shift -->
                    @if($activeShiftRecord)
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5><img src="{{ asset('media/images/icons/inout/IAO-TS-RBG.png') }}" alt="Today's Shift Icon" class="img-fluid" style="width: 70px; height: 70px; margin-right: 10px;">Today's Shift</h5>
                            <p class="mb-1"><strong>Shift Name:</strong> {{ optional($activeShiftRecord->employeeAssignedShift)->shiftSchedule->shift_name ?? 'Not available' }}</p>
                            <p class="mb-1"><strong>Shift Date:</strong> {{ \Carbon\Carbon::parse($activeShiftRecord->shift_date)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <!-- Clock-in/Clock-out buttons -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex flex-column align-items-stretch">
                                <!-- Clock-in button -->
                                <div class="mb-2">
                                    <form action="{{ route('startShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-lg btn-block {{ $activeShiftRecord->start_shift ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->start_shift ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ $activeShiftRecord->start_shift ? 'disabled' : '' }}>
                                            <img src="{{ asset('media/images/icons/inout/null/SS_NULL.png') }}" alt="Clock In Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                            <span class="d-block">Clock In: {{ $activeShiftRecord->start_shift ? \Carbon\Carbon::parse($activeShiftRecord->start_shift)->format('h:i A') : '-' }}</span>
                                        </button>
                                    </form>
                                </div>
                                <!-- Start Lunch button -->
                                <div class="mb-2">
                                    <form action="{{ route('startLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-lg btn-block {{ $activeShiftRecord->start_lunch ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->start_lunch ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->start_shift ? 'disabled' : ($activeShiftRecord->start_lunch ? 'disabled' : '') }}>
                                            <img src="{{ asset('media/images/icons/inout/null/LS_NULL.png') }}" alt="Start Lunch Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                            <span class="d-block">Start Lunch: {{ $activeShiftRecord->start_lunch ? \Carbon\Carbon::parse($activeShiftRecord->start_lunch)->format('h:i A') : '-' }}</span>
                                        </button>
                                    </form>
                                </div>
                                <!-- End Lunch button -->
                                <div class="mb-2">
                                    <form action="{{ route('endLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-lg btn-block {{ $activeShiftRecord->end_lunch ? 'btn-warning' : 'btn-success' }}" style="background-color: {{ $activeShiftRecord->end_lunch ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->start_lunch ? 'disabled' : ($activeShiftRecord->end_lunch ? 'disabled' : '') }}>
                                            <img src="{{ asset('media/images/icons/inout/null/LE_NULL.png') }}" alt="End Lunch Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                            <span class="d-block">End Lunch: {{ $activeShiftRecord->end_lunch ? \Carbon\Carbon::parse($activeShiftRecord->end_lunch)->format('h:i A') : '-' }}</span>
                                        </button>
                                    </form>
                                </div>
                                <!-- Clock-out button -->
                                <div>
                                    <form action="{{ route('endShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-lg btn-block {{ $activeShiftRecord->end_shift ? 'btn-warning' : 'btn-danger' }}" style="background-color: {{ $activeShiftRecord->end_shift ? '#fca025' : 'white' }}; border: 1px solid black; color: black; width: 100%;" {{ !$activeShiftRecord->end_lunch ? 'disabled' : ($activeShiftRecord->end_shift ? 'disabled' : '') }}>
                                            <img src="{{ asset('media/images/icons/inout/null/SE_NULL.png') }}" alt="Clock Out Icon" class="img-fluid mb-1" style="max-width: 50px; width: 40px; height: 40px;">
                                            <span class="d-block">Clock Out: {{ $activeShiftRecord->end_shift ? \Carbon\Carbon::parse($activeShiftRecord->end_shift)->format('h:i A') : '-' }}</span>
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
        </div>

        <div class="col-md-6">
            <!-- Current Assigned Shifts Card -->
            <div class="card mb-4" style="border-radius: 20px; background-color: #484848; color: white;">
                <div class="card-body">
                    <h5><img src="{{ asset('media/images/icons/inout/IAOS-CAS-RBG.png') }}" alt="Assigned Shifts Icon" class="img-fluid" style="width: 70px; height: 70px; margin-right: 10px;">Currently Assigned Shifts</h5>
                    @if ($currentAssignedShifts->isEmpty())
                    <p>No current assigned shifts found.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($currentAssignedShifts as $assignedShift)
                        <li class="list-group-item" style="background-color: #484848; color: white;">
                            <strong>{{ $assignedShift->shiftSchedule->shift_name }} ({{ 'UTC' . \Carbon\Carbon::now($assignedShift->shiftSchedule->shift_timezone)->offsetHours }})</strong>
                            <br>
                            <span>Start Time: {{ \Carbon\Carbon::parse($assignedShift->shiftSchedule->start_shift_time)->format('h:i A') }}</span>
                            <br>
                            <span>Lunch Start Time: {{ \Carbon\Carbon::parse($assignedShift->shiftSchedule->lunch_start_time)->format('h:i A') }}</span>
                            <br>
                            <span>End Lunch Time: {{ \Carbon\Carbon::parse($assignedShift->shiftSchedule->end_lunch_time)->format('h:i A') }}</span>
                            <br>
                            <span>End Time: {{ \Carbon\Carbon::parse($assignedShift->shiftSchedule->end_shift_time)->format('h:i A') }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            <!-- Timesheet Card -->
            <div class="card" style="border-radius: 20px; background-color: #484848; color: white;">
                <div class="card-body">
                    <h5><img src="{{ asset('media/images/icons/inout/IAOS-T-RBG.png') }}" alt="Timesheet Icon" class="img-fluid" style="width: 70px; height: 70px; margin-right: 10px;">Timesheet</h5>
                    <div class="d-flex flex-column align-items-center justify-content-center" style="width: 100%;">
                        <img src="{{ asset('media/images/icons/inout/IAOS-TL-RBG.png') }}" alt="Lock Icon" class="img-fluid mb-1" style="max-width: 100px;">
                        <p class="text-center" style="color: white;">Your cutoff period will be {{ \Carbon\Carbon::now()->format('F') }} {{ \Carbon\Carbon::now()->day }} and {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
                        <p class="text-center" style="color: white;">Make sure to lock in your timesheet by clicking <a href="#" style="color: white; text-decoration: underline;">here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection