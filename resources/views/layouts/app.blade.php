<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include CSS files -->
    <!-- Include dashboard-specific CSS file -->
    @yield('dashboard_styles')
    <!-- Include dashboard-specific CSS file -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layouts/navbar.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Navbar section -->
    <nav class="navbar">
        <div class="nav-links">
            <!-- Company logo and navigation links -->
            <img src="{{ asset('media/images/cloudstaff-logo-share.png') }}" alt="CloudStaff Logo" height="25px" style="margin-right: 10px;">
            <a href="{{ route('timesheet') }}">Dashboard</a>
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
    <main class="py-4">
        <div class="container">
            <!-- Content from child views will be placed here -->
            @yield('content')
        </div>
    </main>

    <!-- Include JavaScript files -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include any additional JavaScript files -->
    @yield('scripts')
</body>
</html>
