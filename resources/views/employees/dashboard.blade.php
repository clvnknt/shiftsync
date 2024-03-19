<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="nav-links">
            <img src="{{ asset('media/images/cloudstaff-logo-share.png') }}" alt="CloudStaff Logo" height="25px" style="margin-right: 10px;">
            <a href="{{ route('timesheet') }}">Dashboard</a>
            <a href="{{ route('timesheet') }}">Timesheet</a>
            <a href="#">Support</a>
            <a href="#">My Account</a>
        </div>
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

    <h1>Dashboard</h1>

    <div class="dashboard-container">
        <div class="user-info-container">
            <h2><strong>Employee Information</strong></h2>
            @if($employeeRecord)
                <p><strong>Name:</strong> {{ $employeeRecord->first_name }} {{ $employeeRecord->middle_name }} {{ $employeeRecord->last_name }}</p>
            @else
                <p><strong>Employee record not found.</strong></p>
            @endif
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Timezone:</strong> {{ Auth::user()->timezone }}</p>
            <p><strong>Default Shift:</strong> {{ $employeeRecord->defaultShift ? $employeeRecord->defaultShift->shift_name : 'N/A' }}</p>
            <p><strong>Shift Schedule:</strong> 
                {{ $employeeRecord->defaultShift ? \Carbon\Carbon::parse($employeeRecord->defaultShift->start_shift_time)->format('H:i') : 'N/A' }} - 
                {{ $employeeRecord->defaultShift ? \Carbon\Carbon::parse($employeeRecord->defaultShift->end_shift_time)->format('H:i') : 'N/A' }}
            </p>
        </div>

        <div class="shifts-container">
            <h2>Today's Shift: {{ $employeeShift && $employeeShift->shift_date ? \Illuminate\Support\Carbon::parse($employeeShift->shift_date)->format('d/m/Y') : 'N/A' }}</h2>
            <table class="shifts-table">
                <tbody>
                    <tr>
                        <th>Shift Started</th>
                        <td>
                            @if ($employeeShift && $employeeShift->start_shift)
                                {{ \Illuminate\Support\Carbon::parse($employeeShift->start_shift)->format('H:i') }}
                            @else
                                <form action="{{ route('startShift') }}" method="POST">
                                    @csrf
                                    <button type="submit">START SHIFT</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Lunch Started</th>
                        <td>
                            @if ($employeeShift && $employeeShift->start_lunch)
                                {{ $employeeShift->start_lunch->format('H:i') }}
                            @elseif ($employeeShift && $employeeShift->start_shift && !$employeeShift->end_shift)
                                <form action="{{ route('startLunch') }}" method="POST">
                                    @csrf
                                    <button type="submit">START LUNCH</button>
                                </form>
                            @else
                                <button type="button" disabled>START LUNCH</button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Lunch Ended</th>
                        <td>
                            @if ($employeeShift && $employeeShift->end_lunch)
                                {{ $employeeShift->end_lunch->format('H:i') }}
                            @elseif ($employeeShift && $employeeShift->start_lunch)
                                <form action="{{ route('endLunch') }}" method="POST">
                                    @csrf
                                    <button type="submit">END LUNCH</button>
                                </form>
                            @else
                                <button type="button" disabled>END LUNCH</button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Shift Ended</th>
                        <td>
                            @if ($employeeShift && $employeeShift->start_shift && $employeeShift->start_lunch && $employeeShift->end_lunch && !$employeeShift->end_shift)
                                <form action="{{ route('endShift') }}" method="POST">
                                    @csrf
                                    <button type="submit">END SHIFT</button>
                                </form>
                            @elseif ($employeeShift && $employeeShift->end_shift)
                                {{ $employeeShift->end_shift->format('H:i') }}
                            @else
                                <button type="button" disabled>END SHIFT</button>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>