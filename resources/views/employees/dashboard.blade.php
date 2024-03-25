@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <!-- World Clock -->
        <h2 class="text-center mt-5 mb-4">Your Dashboard</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>PH Time</th>
                        <th>AU Time</th>
                        <th>UK Time</th>
                        <th>US Time</th>
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
                        <p class="card-text">Placeholder text for Container 1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Leaves</h5>
                        <p class="card-text">Placeholder text for Container 2</p>
                    </div>
                </div>
            </div>

            <!-- Containers 3 and 4 below -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Events</h5>
                        <p class="card-text">Placeholder text for Container 3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">UberTickets</h5>
                        <p class="card-text">Placeholder text for Container 4</p>
                    </div>
                </div>
            </div>

            <!-- Additional containers next to Containers 3 and 4 -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">News</h5>
                        <p class="card-text">Placeholder text for Container 5</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Pending Requests</h5>
                        <p class="card-text">Placeholder text for Container 6</p>
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
                hour12: false // Use 24-hour format
            };
            var phTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Asia/Manila', ...options });
            var auTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Australia/Sydney', ...options });
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
