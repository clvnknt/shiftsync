@extends('layouts.app')

@section('dashboard_styles')
    <!-- Include the dashboard-specific CSS file -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Dashboard title -->
    <h1>Dashboard</h1>

    <!-- Dashboard container -->
    <div class="dashboard-container">

        <!-- Container 1: Employee Information -->
        <div class="card employee-information">
            <h2><strong>Employee Information</strong></h2>
            <!-- Display employee information if available -->
            @if($employeeRecord)
                <div class="info-left">
                    <div class="info-box">Name: {{ $employeeRecord->first_name ?: 'N/A' }} {{ $employeeRecord->middle_name ?: 'N/A' }} {{ $employeeRecord->last_name ?: 'N/A' }}</div>
                    <div class="info-box">Email: {{ $employeeRecord->email ?: 'N/A' }}</div>
                    <div class="info-box">Timezone: {{ $employeeRecord->timezone ?: 'N/A' }}</div>
                </div>
                <div class="info-right">
                    <div class="info-box">Default Shift: {{ $employeeRecord->default_shift ?: 'N/A' }}</div>
                    <div class="info-box">Shift Schedule: {{ $employeeRecord->shift_schedule ?: 'N/A' }}</div>
                </div>
            @else
                <!-- Display error message if employee record not found -->
                <p><strong>Employee record not found.</strong></p>
            @endif
        </div>

        <!-- Container 2: Upcoming Holidays -->
        <div class="card upcoming-holidays">
            <h2>Upcoming Holidays</h2>
            <p><strong>Date 1:</strong> Sample Holiday</p>
            <p><strong>Date 2:</strong> Sample Holiday.</p>
            <p><strong>Date 3:</strong> Sample Holiday.</p>
            <p><strong>Date 4:</strong> Sample Holiday.</p>
            <p><strong>Date 5:</strong> Sample Holiday.</p>
        </div>

        <!-- Container 3: Today's Shift -->
        <div class="card shifts-container">
            <h2><strong>Today's Shift</strong></h2>
            <!-- Shifts table -->
            <div class="shift-details">
                <!-- Row for shift start -->
                <div class="shift-row">
                    <div class="shift-label">Shift Started</div>
                    <div class="shift-value">
                        <!-- Display shift start time or start shift button -->
                        @if ($employeeShift && $employeeShift->start_shift)
                            <button class="orange">{{ \Illuminate\Support\Carbon::parse($employeeShift->start_shift)->format('H:i') }}</button>
                        @else
                            <form action="{{ route('startShift') }}" method="POST">
                                @csrf
                                <button type="submit">START</button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Row for lunch start -->
                <div class="shift-row">
                    <div class="shift-label">Lunch Started</div>
                    <div class="shift-value">
                        <!-- Display lunch start time or start lunch button -->
                        @if ($employeeShift && $employeeShift->start_lunch)
                            <button class="orange">{{ $employeeShift->start_lunch->format('H:i') }}</button>
                        @elseif ($employeeShift && $employeeShift->start_shift && !$employeeShift->end_shift)
                            <form action="{{ route('startLunch') }}" method="POST">
                                @csrf
                                <button type="submit">START</button>
                            </form>
                        @else
                            <button type="button" disabled>-</button>
                        @endif
                    </div>
                </div>

                <!-- Row for lunch end -->
                <div class="shift-row">
                    <div class="shift-label">Lunch Ended</div>
                    <div class="shift-value">
                        <!-- Display lunch end time or end lunch button -->
                        @if ($employeeShift && $employeeShift->end_lunch)
                            <button class="orange">{{ $employeeShift->end_lunch->format('H:i') }}</button>
                        @elseif ($employeeShift && $employeeShift->start_lunch)
                            <form action="{{ route('endLunch') }}" method="POST">
                                @csrf
                                <button type="submit">END</button>
                            </form>
                        @else
                            <button type="button" disabled>-</button>
                        @endif
                    </div>
                </div>

                <!-- Row for shift end -->
                <div class="shift-row">
                    <div class="shift-label">Shift Ended</div>
                    <div class="shift-value">
                        <!-- Display shift end time or end shift button -->
                        @if ($employeeShift && $employeeShift->end_shift)
                            <button class="orange">{{ $employeeShift->end_shift->format('H:i') }}</button>
                        @elseif ($employeeShift && $employeeShift->start_shift && $employeeShift->start_lunch && $employeeShift->end_lunch && !$employeeShift->end_shift)
                            <form action="{{ route('endShift') }}" method="POST">
                                @csrf
                                <button class="submit" type="submit">END</button>
                            </form>
                        @else
                            <button type="button" disabled>-</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Container 4: Events -->
        <div class="card">
            <h2>Events</h2>
            <p>Sample Event</p>
        </div>
    </div>
@endsection