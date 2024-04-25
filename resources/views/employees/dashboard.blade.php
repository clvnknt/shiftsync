@extends('layouts.app')

@section('title', 'Dashboard - StaffCentral')

@section('content')
    <style>
        .card {
            border-radius: 20px;
            display: flex; /* Use flexbox layout */
            flex-direction: column; /* Stack content vertically */
        }

        .card-body {
            flex-grow: 1; /* Allow the body to grow vertically to fill the card */
            overflow: auto; /* Allow scrolling if content exceeds the fixed height */
            height: 200px; /* Set a fixed height for the card bodies */
        }

        .card-title {
            display: flex;
            align-items: center; /* Center the icon and title vertically */
        }

        .card-icon {
            width: 70px; /* Set a slightly larger width for the icons */
            height: 70px; /* Set a slightly larger height for the icons */
            margin-right: 10px;
        }

        .timezone-container {
            margin-top: 20px;
        }

        .timezone-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .timezone-item {
            margin-bottom: 10px;
        }
    </style>
    <div class="container">
        <!-- World Clock -->
        <div class="container mt-4">
            <!-- Header: Your Dashboard -->
            <div class="row">
                <div class="col-md-6">
                    <h2>Your Dashboard</h2>
                </div>
            </div>
        </div>

        <!-- Timezones -->
        <div class="timezone-container">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <!-- Placeholder icon -->
                        <img src="{{ asset('media/images/icons/dashboard/timezones.png') }}" alt="Globe Icon" class="card-icon">
                        Timezones
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="timezone-item">
                                <strong>Manila, Philippines:</strong>
                                <span id="ph_time">10:00 AM</span>
                            </div>
                            <div class="timezone-item">
                                <strong>Brisbane, Australia:</strong>
                                <span id="au_time">12:00 PM</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="timezone-item">
                                <strong>London, United Kingdom:</strong>
                                <span id="uk_time">5:00 AM</span>
                            </div>
                            <div class="timezone-item">
                                <strong>Washington, DC, United States:</strong>
                                <span id="us_time">12:00 AM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional containers -->
        <div class="row mt-4">
            <!-- Containers 1 and 2 side by side -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Placeholder icon -->
                            <img src="{{ asset('media/images/icons/dashboard/holidays.png') }}" alt="Plane Icon" class="card-icon">
                            Holidays
                        </h5>
                        <p class="card-text">Next holiday: Labor Day (May 1, 2024)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Placeholder icon -->
                            <img src="{{ asset('media/images/icons/dashboard/upcoming-leaves.png') }}" alt="Calendar Icon" class="card-icon">
                            Upcoming Leaves
                        </h5>
                        <p class="card-text">You have no upcoming leaves.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional containers -->
        <div class="row">
            <!-- Containers 3 and 4 below -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Placeholder icon -->
                            <img src="{{ asset('media/images/icons/dashboard/events.png') }}" alt="Event Icon" class="card-icon">
                            Events
                        </h5>
                        <p class="card-text">Next event: Team Building (May 15, 2024)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Placeholder icon -->
                            <img src="{{ asset('media/images/icons/dashboard/news.png') }}" alt="Newspaper Icon" class="card-icon">
                            News
                        </h5>
                        <p class="card-text">Latest news: Company Announces Q1 Earnings</p>
                    </div>
                </div>
            </div>

            <!-- Additional containers next to Containers 3 and 4 -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Placeholder icon -->
                            <img src="{{ asset('media/images/icons/dashboard/ubertickets.png') }}" alt="Tickets Icon" class="card-icon">
                            UberTickets
                        </h5>
                        <p class="card-text">Number of tickets: 5</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Placeholder icon -->
                            <img src="{{ asset('media/images/icons/dashboard/pending-request.png') }}" alt="Request Icon" class="card-icon">
                            Pending Requests
                        </h5>
                        <p class="card-text">You have 3 pending requests.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Function to update time every second -->
    <script>
        function updateTime() {
            var options = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false, // Use 24-hour format
                weekday: 'short', // Display the day of the week
                day: '2-digit', // Display the day of the month
                month: 'short', // Display the month
                year: 'numeric' // Display the year
            };

            var phTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Asia/Manila', ...options });
            var auTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Australia/Brisbane', ...options });
            var ukTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Europe/London', ...options });
            var usTime = new Date().toLocaleTimeString('en-US', { timeZone: 'America/New_York', ...options });

            document.getElementById('ph_time').innerHTML = phTime;
            document.getElementById('au_time').innerHTML = auTime;
            document.getElementById('uk_time').innerHTML = ukTime;
            document.getElementById('us_time').innerHTML = usTime;
        }

        // Update time initially and then every second
        updateTime();
        setInterval(updateTime, 1000);
    </script>
@endsection
