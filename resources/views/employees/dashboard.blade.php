@extends('layouts.app')

@section('title', 'Dashboard - StaffCentral')

@section('content')
    <div class="container">
        <!-- World Clock -->
        <div class="container mt-4">
            <!-- Header: Your Dashboard -->
            <div class="row">
                <div class="col-md-6">
                    <h2 class="mb-4">Your Dashboard</h2>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Manila, Philippines</th>
                        <th>Brisbane, Australia</th>
                        <th>London, United Kingdom</th>
                        <th>Washington, DC, United States</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="ph_time"></td>
                        <td id="au_time"></td>
                        <td id="uk_time"></td>
                        <td id="us_time"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Additional containers -->
        <div class="row mt-4">
            <!-- Containers 1 and 2 side by side -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Holidays</h5>
                        <p class="card-text">Placeholder text for Holidays</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Leaves</h5>
                        <p class="card-text">Placeholder text for Upcoming Leaves</p>
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
