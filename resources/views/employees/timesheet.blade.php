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
                    <div>
                        <strong>Default Shift:</strong> {{ $defaultShift->shift_name ?? 'N/A' }}
                    </div>
                    <div>
                        <strong>Shift Schedule:</strong> {{ $defaultShift->shift_schedule ?? 'N/A' }}
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
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date" value="{{ now()->format('Y-m-d') }}">

                    <label for="end-date">End Date:</label>
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
                                <th>Shift Started</th>
                                <th>Lunch Started</th>
                                <th>Lunch Ended</th>
                                <th>Shift Ended</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ now()->format('d/m/Y') }}</td>
                                <td>{{ $currentShiftRecord->shift_started ? $currentShiftRecord->shift_started->format('H:i') : '-' }}</td>
                                <td>{{ $currentShiftRecord->lunch_started ? $currentShiftRecord->lunch_started->format('H:i') : '-' }}</td>
                                <td>{{ $currentShiftRecord->lunch_ended ? $currentShiftRecord->lunch_ended->format('H:i') : '-' }}</td>
                                <td>{{ $currentShiftRecord->shift_ended ? $currentShiftRecord->shift_ended->format('H:i') : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>No shift records found for today.</p>
                @endif
            </div>
        </div>
        <!-- Include the timesheet-specific JavaScript file if needed -->
        <script src="{{ asset('js/timesheet.js') }}"></script>
    </div>
</body>
</html>