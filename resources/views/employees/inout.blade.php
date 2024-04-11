@extends('layouts.app')

@section('title', 'In/Out')

@section('content')
    <div class="container mt-4">
        <h2>Assigned Shifts</h2>
        @if($assignedShifts->isEmpty())
            <p>No assigned shifts found.</p>
        @else
            <ul>
                @foreach($assignedShifts as $assignedShift)
                    <li>{{ $assignedShift->shiftSchedule->shift_name }} ({{ $assignedShift->shiftSchedule->start_shift_time }} - {{ $assignedShift->shiftSchedule->end_shift_time }})</li>
                @endforeach
            </ul>
        @endif

        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Active Shift Record</h2>
                @if($activeShiftRecord)
                    <p>Shift Name: {{ optional($activeShiftRecord->employeeAssignedShift)->shiftSchedule->shift_name ?? 'Not available' }}</p>
                    <p>Shift Date: {{ $activeShiftRecord->shift_date }}</p>
                    <p>Start Shift: {{ $activeShiftRecord->start_shift ?: 'Not logged' }}</p>
                    <p>Start Lunch: {{ $activeShiftRecord->start_lunch ?: 'Not logged' }}</p>
                    <p>End Lunch: {{ $activeShiftRecord->end_lunch ?: 'Not logged' }}</p>
                    <p>End Shift: {{ $activeShiftRecord->end_shift ?: 'Not logged' }}</p>

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <form action="{{ route('startShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Log Start Shift</button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('startLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Log Start Lunch</button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('endLunch', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Log End Lunch</button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('endShift', ['employeeRecordId' => $activeShiftRecord->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Log End Shift</button>
                            </form>
                        </div>
                    </div>
                @else
                    <p>No active shift record found for today or not all shift details are logged.</p>
                @endif
            </div>            
        </div>
    </div>
@endsection
