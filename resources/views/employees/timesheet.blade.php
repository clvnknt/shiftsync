@extends('layouts.app')

@section('title', 'Timesheet - StaffCentral')

@section('content')
    <!-- Your timesheet content goes here -->
    <div class="container mt-4 mb-5">
        <!-- Header: Timesheet -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Timesheet
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6 d-flex">
                <div class="card flex-fill" style="border-radius: 20px;">
                    <div class="card-body" style="height: 270px;"> <!-- Adjust the height here -->
                        <h5 class="card-title"><img src="{{ asset('media/images/icons/timesheet/legend.png') }}" alt="Legend Icon" class="img-fluid" style="width: 50px; height: 50px;"> Legend</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>OTL (Out To lunch)</p>
                                <p>BFL (Back From lunch)</p>
                                <p>OT (Over Time)</p>
                            </div>
                            <div class="col-md-6">
                                <p>UT (Under Time)</p>
                                <p>ND (Night Differential)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        
                
            <div class="col-md-6 d-flex">
                <div class="card flex-fill" style="border-radius: 20px;">
                    <div class="card-body" style="height: 270px;"> <!-- Adjust the height here -->
                        <h5 class="card-title"><img src="{{ asset('media/images/icons/timesheet/view-format.png') }}" alt="Choose View Format Icon" class="img-fluid" style="width: 50px; height: 50px;"> Choose View Format</h5>
                        
                        <!-- Dropdown for view format -->
                        <div id="viewFormatContainer" class="mt-3">
                            <select id="viewFormatSelect" class="form-control">
                                <option value="">-</option> <!-- Default option with no value -->
                                <option value="cutoff">Cutoff Period</option>
                                <option value="range">Date Range</option>
                            </select>
                        </div>
                        
                        <!-- Container for cutoff period dropdown -->
                        <div id="cutoffContainer" class="mt-3" style="display: none;">
                            <label for="cutoffSelect">Select Cutoff Period:</label>
                            <select id="cutoffSelect" class="form-control">
                                <option value="">-</option>
                                <!-- Add cutoff period options dynamically using JavaScript -->
                            </select>
                        </div>
                        
                        <!-- Container for date range input fields -->
                        <div id="dateRangeContainer" class="mt-3" style="display: none;">
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
                        
                        <!-- Buttons for Cutoff Period view -->
                        <div id="cutoffButtons" class="mt-3" style="display: none;">
                            <button type="button" class="btn btn-success">View</button>
                        </div>
                        
                        <!-- Icons for Date Range view -->
                        <div id="rangeIcons" class="mt-3" style="display: none;">
                            <button type="button" class="btn btn-success">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
<!-- Timesheet Table -->
<div class="card mb-4" style="border-radius: 20px;">
    <div class="card-body">
        <h4 class="mb-3"><img src="{{ asset('media/images/icons/timesheet/records.png') }}" alt="Records Icon" class="img-fluid" style="width: 50px; height: 50px;"> Records</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Shift Started</th>
                    <th>Start Lunch</th>
                    <th>Lunch Ended</th>
                    <th>Shift Ended</th>
                    <!-- Add other table headers here -->
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
                @if($shiftRecord)
                <tr>
                    <td>{{ \Carbon\Carbon::today()->format('F d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($shiftRecord->start_shift)->timezone($employeeTimezone)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($shiftRecord->start_lunch)->timezone($employeeTimezone)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($shiftRecord->end_lunch)->timezone($employeeTimezone)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($shiftRecord->end_shift)->timezone($employeeTimezone)->format('H:i') }}</td>
                    <!-- Add other shift-related data here -->
                    <td>N/A</td> <!-- Placeholder for Status -->
                    <td>N/A</td> <!-- Placeholder for Late(IN) -->
                    <td>N/A</td> <!-- Placeholder for Late(BFL) -->
                    <td>N/A</td> <!-- Placeholder for UT -->
                    <td>N/A</td> <!-- Placeholder for Hours Rendered -->
                    <td>N/A</td> <!-- Placeholder for OT (Filed) -->
                    <td>N/A</td> <!-- Placeholder for UT (Filed) -->
                    <td>N/A</td> <!-- Placeholder for ND -->
                </tr>
                @else
                <tr>
                    <td>{{ \Carbon\Carbon::today()->format('F d, Y') }}</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


        <!-- Summary -->
        <div class="card mb-4" style="border-radius: 20px;">
            <div class="card-body">
                <h4 class="mb-3"><img src="{{ asset('media/images/icons/timesheet/summary.png') }}" alt="Summary Icon" class="img-fluid" style="width: 50px; height: 50px;"> Summary</h4>
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
                        <!-- Summary table data -->
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
        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            border-radius: 20px;
        }
    </style>
@endsection

@section('scripts')
    <!-- Additional scripts specific to the timesheet page -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the select element for view format
            var viewFormatSelect = document.getElementById("viewFormatSelect");

            // Get the containers for cutoff, date range, cutoff buttons, and range icons
            var cutoffContainer = document.getElementById("cutoffContainer");
            var dateRangeContainer = document.getElementById("dateRangeContainer");
            var cutoffButtonsContainer = document.getElementById("cutoffButtons");
            var rangeIconsContainer = document.getElementById("rangeIcons");

            // Add event listener to detect changes in the view format select
            viewFormatSelect.addEventListener("change", function() {
                // Get the selected view format
                var selectedFormat = viewFormatSelect.value;

                // Hide all containers
                cutoffContainer.style.display = "none";
                dateRangeContainer.style.display = "none";
                cutoffButtonsContainer.style.display = "none";
                rangeIconsContainer.style.display = "none";

                // Display the appropriate container(s) based on the selected format
                if (selectedFormat === "cutoff") {
                    cutoffContainer.style.display = "block";
                    cutoffButtonsContainer.style.display = "block";
                } else if (selectedFormat === "range") {
                    dateRangeContainer.style.display = "block";
                    rangeIconsContainer.style.display = "block";
                }
            });
        });
    </script>
@endsection
