@extends('layouts.app')

@section('title', 'Timesheet - StaffCentral')

@section('content')
    <!-- Your timesheet content goes here -->
    <div class="container mt-4 mb-5">
        <!-- Header: Timesheet -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Timesheet</h2>
            </div>
        </div>
        
         <!-- Employee Information -->
         <div class="row  mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Legend</h5>
                        <p>OTL (Out To lunch) & BFL (Back From lunch)</p>
                        <p>OT (Over Time) & UT (Under Time) & ND (Night Differential)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Choose Date Range</h5>
                        
                        <!-- Dropdown for cutoff periods -->
                        <div id="cutoffContainer" class="mt-3">
                            <label for="cutoffSelect">Select Cutoff Period:</label>
                            <select id="cutoffSelect" class="form-control">
                                <option value="">-</option> <!-- Default option with a dash -->
                                <!-- Add options dynamically using JavaScript -->
                            </select>
                        </div>
                        
                        <!-- Container for date range -->
                        <div id="dateRangeContainer" class="mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    
        <!-- Timesheet Table -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3">Records</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Time In</th>
                            <th>OTL</th>
                            <th>BFL</th>
                            <th>Time Out</th>
                            <th>Leave</th>
                            <th>Status</th>
                            <th>Late(IN)</th>
                            <th>Late(BFL)</th>
                            <th>UT</th>
                            <th>Hours Rendered</th>
                            <th>OT (Filed)</th>
                            <th>UT (Filed)</th>
                            <th>ND</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Timesheet data (if applicable) -->
                        <tr>
                            <td>April 24, 2024</td>
                            <td>08:00 to 17:00 PH</td>
                            <td>07:26</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <!-- Total row -->
                        <tr>
                            <td>Total</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
       <!-- Summary -->
<!-- Summary Table -->
<div class="row mt-4">
    <div class="col-md-12">
        <h4 class="mb-3">Summary</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Hours</th>
                    <th>Description</th>
                    <th>Hours</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Overall Computation:</td>
                    <td>8 Hour/s</td>
                    <td>Total Holiday Worked Hours (Regular):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Worked Hours (Regular):</td>
                    <td>0 Hour/s</td>
                    <td>Total Holiday Overtime (Regular):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Overtime (Regular):</td>
                    <td>0 Hour/s</td>
                    <td>Total Holiday Night Diff (Regular):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Night Differential (Regular):</td>
                    <td>0 Hour/s</td>
                    <td>Total Holiday Overtime Night Diff (Regular):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Overtime Night Diff. (Regular):</td>
                    <td>0 Hour/s</td>
                    <td>Total Worked Hours (Regular Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Worked Hours (Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>Total Overtime (Regular Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Night Differential (Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>Total Night Differential (Regular Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Overtime Night Diff (Regular Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>Total Overtime Night Diff (Day Off):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Holiday Worked Hours (Special):</td>
                    <td>0 Hour/s</td>
                    <td>Total Leave Hours (With Pay):</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Holiday Overtime (Special):</td>
                    <td>0 Hour/s</td>
                    <td>Total Leave Hours (Without Pay):</td>
                    <td>8 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Holiday Night Diff (Special):</td>
                    <td>0 Hour/s</td>
                    <td>Total Offset Regular Holiday:</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Holiday Overtime Night Diff (Special):</td>
                    <td>0 Hour/s</td>
                    <td>Total Offset Special Holiday:</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Worked Hours (Special Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>Adjustment:</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Overtime (Special Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>Holiday Premium Adjustment:</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Night Differential (Special Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>Tardiness/Undertime:</td>
                    <td>0 Hour/s</td>
                </tr>
                <tr>
                    <td>Total Overtime Night Diff (Special Hol & Day Off):</td>
                    <td>0 Hour/s</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


    </div>
@endsection

@section('styles')
    <!-- Additional styles specific to the timesheet page -->
    <style>
        /* Add your custom styles here */
    </style>
@endsection

@section('scripts')
    <!-- Additional scripts specific to the timesheet page -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Get container and select element
    const cutoffContainer = document.getElementById('cutoffContainer');
    const cutoffSelect = document.getElementById('cutoffSelect');

    // Populate the dropdown with cutoff period options
    const cutoffPeriods = []; // Add your cutoff period options here
    cutoffPeriods.forEach(period => {
        const option = document.createElement('option');
        option.value = period;
        option.text = period;
        cutoffSelect.appendChild(option);
    });

    // Show both containers
    cutoffContainer.style.display = 'block';
    dateRangeContainer.style.display = 'block';

    // Listen for changes in the cutoff select
    cutoffSelect.addEventListener('change', function () {
        // If no value selected, display a dash (-)
        if (!this.value) {
            this.value = '-';
        }
    });
});

    </script>
@endsection
