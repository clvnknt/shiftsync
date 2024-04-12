@extends('layouts.app')

@section('title', 'In/Out')

@section('content')
<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-header">
            @if($activeShiftRecord)
                <!-- Display details of the active shift -->
                <p>Active Shift Record</p>
                <p>Shift Name: {{ optional($activeShiftRecord->employeeAssignedShift)->shiftSchedule->shift_name ?? 'Not available' }}</p>
                <p>Shift Date: {{ $activeShiftRecord->shift_date }}</p>
                <p>Start Shift: {{ $activeShiftRecord->start_shift ?: 'Not logged' }}</p>
                <p>Start Lunch: {{ $activeShiftRecord->start_lunch ?: 'Not logged' }}</p>
                <p>End Lunch: {{ $activeShiftRecord->end_lunch ?: 'Not logged' }}</p>
                <p>End Shift: {{ $activeShiftRecord->end_shift ?: 'Not logged' }}</p>
                <!-- Display buttons for logging -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <form action="{{ route('startShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block" {{ $activeShiftRecord->start_shift ? 'disabled' : '' }}>Log Start Shift</button>
                        </form>
                    </div>
                    <div class="col-md-6 mb-3">
                        <form action="{{ route('startLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block" {{ $activeShiftRecord->start_lunch ? 'disabled' : '' }}>Log Start Lunch</button>
                        </form>
                    </div>
                    <div class="col-md-6 mb-3">
                        <form action="{{ route('endLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block" {{ $activeShiftRecord->end_lunch ? 'disabled' : '' }}>Log End Lunch</button>
                        </form>
                    </div>
                    <div class="col-md-6 mb-3">
                        <form action="{{ route('endShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block" {{ $activeShiftRecord->end_shift ? 'disabled' : '' }}>Log End Shift</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="card-text">No active shift record found for today or not all shift details are logged.</p>
            @endif
        </div>
    </div>
</div>
@endsection