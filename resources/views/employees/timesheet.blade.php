@extends('layouts.app')

@section('title', 'Timesheet - StaffCentral')

@section('content')
    <div class="container mt-4 mb-5">
        <!-- Header: Timesheet -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Timesheet</h2>
            </div>
        </div>
        
        <!-- Legend -->
        <div class="row mb-4">
            <div class="col-md-6 d-flex mb-4">
                <div class="card flex-fill" style="border-radius: 20px;">
                    <div class="card-body" style="height: 270px;">
                        <h5 class="card-title"><img src="{{ asset('media/images/icons/timesheet/legend.png') }}" alt="Legend Icon" class="img-fluid" style="width: 50px; height: 50px;"> Legend</h5>
                        <!-- Legend Items -->
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
                
            <div class="col-md-6 d-flex mb-4">
                <div class="card flex-fill" style="border-radius: 20px;">
                    <div class="card-body" style="height: 500px;">
                        <h5 class="card-title">
                            <img src="{{ asset('media/images/icons/timesheet/view-format.png') }}" alt="Choose View Format Icon" class="img-fluid" style="width: 50px; height: 50px;"> View Records Format
                        </h5>

                        <!-- Shift Name Dropdown -->
                        <div id="shiftNameDropdownContainer" class="mt-3">
                            <label for="Choose Shift Schedule">Select Shift Name:</label>
                            <select id="shiftNameSelect" class="form-control">
                                <option value="">-</option>
                                <!-- Populate shift names -->
                                @foreach($shiftNames as $id => $shiftName)
                                    <option value="{{ $id }}">{{ $shiftName }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Dropdown for view format -->
                        <div id="viewFormatContainer" class="mt-3">
                            <label for="viewFormatSelect">Select Format:</label>
                            <select id="viewFormatSelect" class="form-control">
                                <option value="">-</option>
                                <option value="cutoff">Cutoff Period</option>
                                <option value="range">Date Range</option>
                            </select>
                        </div>
                        
                        <!-- Container for cutoff period dropdown -->
                        <div id="cutoffContainer" class="mt-3" style="display: none;">
                            <label for="cutoffSelect">Select Cutoff Period:</label>
                            <select id="cutoffSelect" class="form-control">
                                <option value="">-</option>
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
                            <button id="viewButton" type="button" class="btn btn-success">View</button>
                        </div>
                        
                        <!-- Icons for Date Range view -->
                        <div id="rangeIcons" class="mt-3" style="display: none;">
                            <button type="button" class="btn btn-success" onclick="fetchRecords()">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Records -->
        <div class="card mb-4" style="border-radius: 20px;">
            <div class="card-body">
                <h4 class="mb-3"><img src="{{ asset('media/images/icons/timesheet/records.png') }}" alt="Records Icon" class="img-fluid" style="width: 50px; height: 50px;"> Records</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Shift Name</th>
                            <th>Shift Schedule</th>
                            <th>Shift Started</th>
                            <th>Start Lunch</th>
                            <th>Lunch Ended</th>
                            <th>Shift Ended</th>
                            <th>Hours Rendered</th>
                        </tr>
                    </thead>
                    <tbody id="recordsTableBody">
                        <!-- Records table data -->
                        @if($records)
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $record->shift_date }}</td>
                                    <td>{{ $record->shiftName }}</td>
                                    <td>{{ $record->shiftSchedule }}</td>
                                    <td>{{ $record->start_shift }}</td>
                                    <td>{{ $record->start_lunch }}</td>
                                    <td>{{ $record->end_lunch }}</td>
                                    <td>{{ $record->end_shift }}</td>
                                    <td>{{ $record->hours_rendered }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No records found.</td>
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
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Summary table data -->
                        <tr>
                            <td>Total Worked Hours (Regular):</td>
                            <td>0 Hour/s</td>
                        </tr>
                        <tr>
                            <td>Tardiness:</td>
                            <td>0 Hour/s</td>
                        </tr>
                        <tr>
                            <td>Undertime:</td>
                            <td>0 Hour/s</td>
                        </tr>
                        <tr>
                            <td>Overtime:</td>
                            <td>0 Hour/s</td>
                        </tr>
                        <tr>
                            <td>Overall Computation:</td>
                            <td>0 Hour/s</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
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
<script>
    // Script for handling view format selection
    document.addEventListener("DOMContentLoaded", function() {
        // DOM elements
        var viewFormatSelect = document.getElementById("viewFormatSelect");
        var shiftNameSelect = document.getElementById("shiftNameSelect");
        var cutoffContainer = document.getElementById("cutoffContainer");
        var dateRangeContainer = document.getElementById("dateRangeContainer");
        var cutoffButtonsContainer = document.getElementById("cutoffButtons");
        var rangeIconsContainer = document.getElementById("rangeIcons");
        var viewFormatContainer = document.getElementById("viewFormatContainer");

        // Function to hide all containers
        function hideAll() {
            viewFormatContainer.style.display = "none";
            cutoffContainer.style.display = "none";
            dateRangeContainer.style.display = "none";
            cutoffButtonsContainer.style.display = "none";
            rangeIconsContainer.style.display = "none";
        }

        // Function to show related containers based on selected format
        function showRelated() {
            var selectedFormat = viewFormatSelect.value;

            if (selectedFormat === "cutoff") {
                cutoffContainer.style.display = "block";
                cutoffButtonsContainer.style.display = "block";
                dateRangeContainer.style.display = "none";
                rangeIconsContainer.style.display = "none";
            } else if (selectedFormat === "range") {
                dateRangeContainer.style.display = "block";
                rangeIconsContainer.style.display = "block";
                cutoffContainer.style.display = "none";
                cutoffButtonsContainer.style.display = "none";
            }
        }

        // Event listener for view format selection change
        viewFormatSelect.addEventListener("change", function() {
            var selectedShiftName = shiftNameSelect.value;
            var selectedFormat = viewFormatSelect.value;

            if (selectedShiftName === "-") {
                hideAll();
                return;
            }

            viewFormatContainer.style.display = "block";
            showRelated();
        });

        // Event listener for shift name selection change
        shiftNameSelect.addEventListener("change", function() {
            var selectedShiftName = shiftNameSelect.value;

            if (selectedShiftName === "-") {
                hideAll();
                return;
            }

            viewFormatContainer.style.display = "block";
            showRelated();
        });

        // Initial hide all containers
        hideAll();

        // Event listener for view button click
        document.getElementById("viewButton").addEventListener("click", function() {
            fetchRecords(); // Calling function to fetch records from API
        });
    });

    // Function to fetch records from API
    function fetchRecords() {
        var shiftId = document.getElementById('shiftNameSelect').value;
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        if (!startDate || !endDate) {
            alert("Please select both start date and end date.");
            return;
        }

        var url = '/fetch-records'; // API endpoint

        // Fetch API request to the API endpoint
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                shiftId: shiftId,
                startDate: startDate,
                endDate: endDate
            })
        })
        .then(response => response.json()) // Parse response as JSON
        .then(data => {
            // Update the table with the fetched records
            var recordsTableBody = document.getElementById('recordsTableBody');
            recordsTableBody.innerHTML = '';

            // Iterate over fetched records and append to the table
            data.forEach(record => {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${record.shift_date}</td>
                    <td>${record.shiftName}</td>
                    <td>${record.shiftSchedule.start_shift_time} to ${record.shiftSchedule.end_shift_time}, ${record.shiftSchedule.shiftTimezone}</td>
                    <td>${record.start_shift}</td>
                    <td>${record.start_lunch}</td>
                    <td>${record.end_lunch}</td>
                    <td>${record.end_shift}</td>
                    <td>${record.hours_rendered}</td>
                `;
                recordsTableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching records:', error); // Log any errors
        });
    }
</script>
@endsection