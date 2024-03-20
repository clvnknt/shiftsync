<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <!-- Include the timesheet-specific CSS file -->
    <link href="{{ asset('css/timesheet.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar section -->
    <nav class="navbar">
        <div class="nav-links">
            <!-- Company logo and navigation links -->
            <img src="{{ asset('media/images/cloudstaff-logo-share.png') }}" alt="CloudStaff Logo" height="25px" style="margin-right: 10px;">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('timesheet') }}">Timesheet</a>
            <a href="#">Support</a>
            <a href="#">My Account</a>
        </div>
        <!-- User dropdown menu -->
        <div class="dropdown">
            <button class="dropbtn">Welcome, {{ Auth::user()->name }}</button>
            <div class="dropdown-content">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main content section -->
    <h1>Timesheet</h1>
    <div class="timesheet-container">
        <!-- Left grid container -->
        <div class="left-grid-container">
            <!-- Employee information container -->
            <div class="employee-info-container">
                <h2>Employee Information</h2>
                @if($user)
                    <div>
                        <strong>Full Name:</strong> {{ $employeeRecord->first_name }} {{ $employeeRecord->last_name }}
                    </div>
                    <div>
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div>
                        <strong>Role:</strong> {{ $employeeRecord->role ?? 'N/A' }}
                    </div>
                    <div>
                        <strong>Department:</strong> {{ $employeeRecord->department ?? 'N/A' }}
                    </div>
                    <!-- Default Shift -->
                    <div>
                        <strong>Default Shift:</strong>
                        @if($timesheetData['defaultShift'])
                            {{ $timesheetData['defaultShift']->shift_name }}
                        @else
                            N/A
                        @endif
                    </div>
                    <!-- Shift Schedule -->
                    <div>
                        <strong>Shift Schedule:</strong>
                        @if($timesheetData['defaultShift'])
                            {{ $timesheetData['defaultShift']->start_shift_time . ' - ' . $timesheetData['defaultShift']->end_shift_time }}
                        @else
                            N/A
                        @endif
                    </div>
                @else
                    <p>User not found.</p>
                @endif
            </div>

            <!-- Date range picker container -->
            <div class="date-range-container">
                <h2>Date Range</h2>
                <!-- Date range picker input fields -->
                <div class="date-range-inputs">
                    <label for="start-date"><b>Start Date:</b></label>
                    <input type="date" id="start-date" name="start-date" value="{{ now()->format('Y-m-d') }}">

                    <label for="end-date"><b>End Date:</b></label>
                    <input type="date" id="end-date" name="end-date">
                </div>

                <!-- Add button to trigger date range selection -->
                <button id="apply-date-range">Apply</button>
            </div>

            <!-- Employee shift records container -->
            <div class="employee-shift-records-container">
                <h2>Employee Shift Record</h2>
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
        </div>
    </div>
    <!-- Include the timesheet-specific JavaScript file if needed -->
    <script src="{{ asset('js/timesheet.js') }}"></script>
</body>
</html>
