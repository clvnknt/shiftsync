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
                    <table class="employee-info-table">
                        <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{ $employeeRecord->first_name }} {{ $employeeRecord->middle_name }} {{ $employeeRecord->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Role:</th>
                                <td>{{ $user->employeeRecord ? $user->employeeRecord->role->name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td>{{ $user->employeeRecord ? $user->employeeRecord->department->name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Default Shift:</th>
                                <td>{{ $defaultShift ? $defaultShift->shift_name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Shift Schedule:</th>
                                <td>{{ $defaultShift->shift_start_time ?? 'N/A' }} to {{ $defaultShift->shift_end_time ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>User not found.</p>
                @endif
            </div>

            <!-- Date range picker container -->
            <div class="date-range-container">
                <h2>Date Range</h2>
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date">

                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end-date">

                <!-- Add button to trigger date range selection -->
                <button id="apply-date-range">Apply</button>
            </div>

            <!-- Employee shift records container -->
<div class="employee-shift-records-container">
    <h2>Employee Shift Records</h2>
    @if(!is_null($employeeShiftRecords) && $employeeShiftRecords->count() > 0)
        <table class="employee-shift-records-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Shift Name</th>
                    <th>Shift Started</th>
                    <th>Lunch Started</th>
                    <th>Lunch Ended</th>
                    <th>Shift Ended</th>
                    <th>SS Lateness</th>
                    <!--<th>Late for Start Lunch</th>-->
                    <th>EL Lateness</th>
                    <th>Overtime</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employeeShiftRecords as $shiftRecord)
                    <tr>
                        <td>{{ $shiftRecord->shift_date }}</td>
                        <td>{{ $shiftRecord->shift->shift_name }}</td>
                        <td>{{ $shiftRecord->shift_started ? $shiftRecord->shift_started->format('H:i') : 'N/A' }}</td>
                        <td>{{ $shiftRecord->lunch_started ? $shiftRecord->lunch_started->format('H:i') : 'N/A' }}</td>
                        <td>{{ $shiftRecord->lunch_ended ? $shiftRecord->lunch_ended->format('H:i') : 'N/A' }}</td>
                        <td>{{ $shiftRecord->shift_ended ? $shiftRecord->shift_ended->format('H:i') : 'N/A' }}</td>
                        <td>{{ $shiftRecord->ss_lateness ?? 'N/A' }}</td>
                        <!--<td>{{ $shiftRecord->late_for_start_lunch ? $shiftRecord->late_for_start_lunch : 'N/A' }}</td>-->
                        <td>{{ $shiftRecord->late_for_end_lunch ? $shiftRecord->late_for_end_lunch : 'N/A' }}</td>
                        <td>{{ $shiftRecord->late_for_end_shift ? $shiftRecord->late_for_end_shift : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No shift records found.</p>
    @endif
</div>


        <!-- Right grid container -->
        <div class="grid-container">
            <!-- Summary sheet container -->
            <div class="summary-sheet-container">
                <h2>Summary Sheet</h2>
                <!-- Summary sheet content goes here -->
            </div>
        </div>
    </div>
    
    <!-- Include the timesheet-specific JavaScript file if needed -->
    <script src="{{ asset('js/timesheet.js') }}"></script>

</body>
</html>
