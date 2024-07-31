@extends('layouts.app')

@section('title', 'ShiftSync - Dashboard')

@section('content')
<style>
    .card {
        background-color: #484848; /* Dark gray background for cards */
        color: #FFFFFF; /* White text for card headers */
        border-radius: 20px;
        display: flex; /* Use flexbox layout */
        flex-direction: column; /* Stack content vertically */
        padding: 20px; /* Padding around the content inside the card */
        margin-bottom: 20px; /* Space between cards */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .inner-card {
        background-color: white; /* White background for inner card */
        color: black; /* Black text for inner card */
        border-radius: 15px; /* Slightly smaller rounded edges for inner card */
        padding: 15px; /* Padding inside inner card */
        margin-top: 15px; /* Space between header and inner card */
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Ensure content is spaced evenly */
    }

    .card-title {
        display: flex;
        align-items: center; /* Center the icon and title vertically */
        margin-bottom: 15px; /* Space below the card title */
    }

    .card-icon {
        width: 70px; /* Set a slightly larger width for the icons */
        height: 70px; /* Set a slightly larger height for the icons */
        margin-right: 10px; /* Space after the icon */
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

    .uniform-card-height {
        height: 300px; /* Ensure uniform height for these cards */
    }

    .container.content-container {
        padding-bottom: 50px; /* Ensure there is padding at the bottom to avoid overlapping with footer */
    }

    .extra-bottom-margin {
        margin-bottom: 50px; /* Add more space at the bottom */
    }
</style>
<div class="container content-container">
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
            <div class="card-title">
                <!-- Placeholder icon -->
                <img src="{{ asset('media/images/icons/dashboard/D-T.png') }}" alt="Globe Icon" class="card-icon">
                Timezones
            </div>
            <div class="inner-card">
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
                <div class="card-title">
                    <!-- Placeholder icon -->
                    <img src="{{ asset('media/images/icons/dashboard/D-H.png') }}" alt="Plane Icon" class="card-icon">
                    Holidays
                </div>
                <div class="inner-card">
                    <p class="card-text">Next holiday: Labor Day (May 1, 2024)</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-title">
                    <!-- Placeholder icon -->
                    <img src="{{ asset('media/images/icons/dashboard/D-UL.png') }}" alt="Calendar Icon" class="card-icon">
                    Upcoming Leaves
                </div>
                <div class="inner-card">
                    <p class="card-text">No upcoming leaves.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional containers -->
    <div class="row extra-bottom-margin">
        <!-- Containers 3 and 4 below -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-title">
                    <!-- Placeholder icon -->
                    <img src="{{ asset('media/images/icons/dashboard/D-E.png') }}" alt="Event Icon" class="card-icon">
                    Events
                </div>
                <div class="inner-card uniform-card-height">
                    <p class="card-text">No upcoming events.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-title">
                    <!-- Placeholder icon -->
                    <img src="{{ asset('media/images/icons/dashboard/D-News.png') }}" alt="Newspaper Icon" class="card-icon">
                    News
                </div>
                <div class="inner-card uniform-card-height">
                    <p class="card-text">Latest news: Company Announces Q1 Earnings</p>
                </div>
            </div>
        </div>

        <!-- Additional containers next to Containers 3 and 4 -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-title">
                    <!-- Placeholder icon -->
                    <img src="{{ asset('media/images/icons/dashboard/D-Notifications.png') }}" alt="Tickets Icon" class="card-icon">
                    Notifications
                </div>
                <div class="inner-card uniform-card-height">
                    <p class="card-text">No recent notifications.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-title">
                    <!-- Placeholder icon -->
                    <img src="{{ asset('media/images/icons/dashboard/D-PR.png') }}" alt="Request Icon" class="card-icon">
                    Pending Requests
                </div>
                <div class="inner-card uniform-card-height">
                    <p class="card-text">No recent pending requests.</p>
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
            weekday: 'short', // Display the short form of the day of the week (e.g., Mon)
            month: 'short', // Display the short form of the month (e.g., May)
            day: 'numeric', // Display the day of the month (e.g., 13)
            year: 'numeric', // Display the year (e.g., 2024)
            hour: 'numeric', // Display the hour (e.g., 4)
            minute: '2-digit', // Display the minutes (e.g., 40)
            hour12: true // Use 12-hour format with AM/PM
        };

        var phTime = new Date().toLocaleString('en-US', { timeZone: 'Asia/Manila', ...options });
        var auTime = new Date().toLocaleString('en-US', { timeZone: 'Australia/Brisbane', ...options });
        var ukTime = new Date().toLocaleString('en-US', { timeZone: 'Europe/London', ...options });
        var usTime = new Date().toLocaleString('en-US', { timeZone: 'America/New_York', ...options });

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