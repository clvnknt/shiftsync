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
        <div class="container">
            <div class="dropdown">
                <button class="dropbtn">Welcome, {{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <h1>Dashboard</h1>
    <div class="dashboard-container">
        <div class="user-info-container">
            <h2>User Information</h2>
            <p>Name: {{ Auth::user()->name }}</p>
            <p>Email: {{ Auth::user()->email }}</p>
            <!-- Display user's default shift -->
            <p>Default Shift: {{ $employeeRecord->defaultShift ? $employeeRecord->defaultShift->shift_name : 'N/A' }}</p>
            <p>Start Time: {{ $employeeRecord->defaultShift ? $employeeRecord->defaultShift->shift_start_time : 'N/A' }}</p>
            <p>End Time: {{ $employeeRecord->defaultShift ? $employeeRecord->defaultShift->shift_end_time : 'N/A' }}</p>
            <!-- Additional user information if needed -->
        </div>

        <div class="shifts-container">
            <h2>Today's Shift</h2>
            <table class="shifts-table">
                <tbody>
                <tr>
    <th>Shift Started</th>
    <td>
        @if ($employeeShift && $employeeShift->shift_started)
            {{ $employeeShift->shift_started->format('H:i') }}
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
        @if ($employeeShift && $employeeShift->lunch_started)
            {{ $employeeShift->lunch_started->format('H:i') }}
        @else
            <form action="{{ route('startLunch') }}" method="POST">
                @csrf
                <button type="submit">START LUNCH</button>
            </form>
        @endif
    </td>
</tr>
<tr>
    <th>Lunch Ended</th>
    <td>
        @if ($employeeShift && $employeeShift->lunch_ended)
            {{ $employeeShift->lunch_ended->format('H:i') }}
        @else
            <form action="{{ route('endLunch') }}" method="POST">
                @csrf
                <button type="submit">END LUNCH</button>
            </form>
        @endif
    </td>
</tr>
<tr>
    <th>Shift Ended</th>
    <td>
        @if ($employeeShift && $employeeShift->shift_ended)
            {{ $employeeShift->shift_ended->format('H:i') }}
        @else
            <form action="{{ route('endShift') }}" method="POST">
                @csrf
                <button type="submit">END SHIFT</button>
            </form>
        @endif
    </td>
</tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
