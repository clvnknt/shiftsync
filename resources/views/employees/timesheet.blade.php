@extends('layouts.app')

@section('dashboard_styles')
    <!-- Include dashboard-specific CSS file -->
    <link href="{{ asset('css/layouts/navbar.css') }}" rel="stylesheet">
@endsection

@section('timesheet_styles')
    <!-- Include the timesheet-specific CSS file -->
    <link href="{{ asset('css/timesheet.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Main content section -->
    <h1>{{ $user->name }}'s Timesheet</h1>
    <div class="timesheet-container">
        <!-- Employee shift records container -->
        <div class="employee-shift-records-container">
            <h2>Employee Shift Record</h2>
            <div class="date-range-inputs">
                <label for="start-date"><b>Start Date:</b></label>
                <input type="date" id="start-date" name="start-date" value="{{ now()->format('Y-m-d') }}">

                <label for="end-date"><b>End Date:</b></label>
                <input type="date" id="end-date" name="end-date">
                <button id="apply-date-range">Apply</button>
            </div>
            @if($currentShiftRecord)
                <table class="employee-shift-records-table">
                    <thead>
                        <tr>
                            <th>Shift Date</th>
                            <th>Start Shift</th>
                            <th>Start Lunch</th>
                            <th>End Lunch</th>
                            <th>End Shift</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ now()->format('d/m/Y') }}</td>
                            <td>{{ $currentShiftRecord->start_shift ? \Illuminate\Support\Carbon::parse($currentShiftRecord->start_shift)->format('H:i') : '-' }}</td>
                            <td>{{ $currentShiftRecord->start_lunch ? \Illuminate\Support\Carbon::parse($currentShiftRecord->start_lunch)->format('H:i') : '-' }}</td>
                            <td>{{ $currentShiftRecord->end_lunch ? \Illuminate\Support\Carbon::parse($currentShiftRecord->end_lunch)->format('H:i') : '-' }}</td>
                            <td>{{ $currentShiftRecord->end_shift ? \Illuminate\Support\Carbon::parse($currentShiftRecord->end_shift)->format('H:i') : '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>No shift records found for today.</p>
            @endif
        </div>
        <!-- New container -->
        <div class="new-container">
            <h2>Summary</h2>
            <p>Summary Table Content Will be placed here.</p>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include the timesheet-specific JavaScript file if needed -->
    <script src="{{ asset('js/timesheet.js') }}"></script>
@endsection