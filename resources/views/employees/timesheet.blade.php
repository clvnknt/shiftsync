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
                                <p>SS - Shift Started</p>
                                <p>LS - Lunch Started</p>
                                <p>LE - Lunch Ended</p>
                                <p>SE - Shift Ended</p>
                            </div>
                            <div class="col-md-6">
                                <p>HR - Hours Rendered</p>
                                <p>UT - Undertime</p>
                                <p>OT- Overtime</p>
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
                            <th>SS</th>
                            <th>SL</th>
                            <th>LE</th>
                            <th>SE</th>
                            <th>HR</th>
                            <th>Late (SS)</th>
                            <th>Late (EL)</th>
                            <th>OT</th>
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
                                    <td>{{ $record->tardiness->hours_late_start_shift ?? '-' }}</td>
                                    <td>{{ $record->tardiness->hours_late_end_lunch ?? '-' }}</td>
                                    <<td>{{ $record->overtime_hours }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
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
                            <td id="totalWorkedHours">0 Hour/s</td>
                        </tr>
                        <tr>
                            <td>Tardiness/Undertime:</td>
                            <td id="totalTardinessHours">0 Hour/s</td>
                        </tr>
                        <tr>
                            <td>Overtime:</td>
                            <td id="totalOvertimeHours">0 Hour/s</td>
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
    // Function to update total worked hours
    function updateTotalWorkedHours(totalHours) {
        var totalWorkedHoursElement = document.getElementById('totalWorkedHours');
        totalWorkedHoursElement.textContent = totalHours + ' Hour/s';
    }

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
        console.log('Fetched data:', data); // Log fetched data

        // Update the table with the fetched records
        var recordsTableBody = document.getElementById('recordsTableBody');
        recordsTableBody.innerHTML = '';

        var totalHours = 0; // Variable to store total hours rendered
        var totalLateStartShift = 0; // Variable to store total late start shift hours
        var totalLateEndLunch = 0; // Variable to store total late end lunch hours
        var totalOvertime = 0; // Variable to store total overtime hours

        // Iterate over fetched records and append to the table
        data.forEach(record => {
            console.log('Processing record:', record); // Log each record

            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${record.shift_date}</td>
                <td>${record.shiftName}</td>
                <td>${convertToStandardTime(record.shiftSchedule.start_shift_time)} to ${convertToStandardTime(record.shiftSchedule.end_shift_time)}, ${record.shiftSchedule.shiftTimezone}</td>

                <td>${convertToStandardTime(record.start_shift)}</td>
                <td>${convertToStandardTime(record.start_lunch)}</td>
                <td>${convertToStandardTime(record.end_lunch)}</td>
                <td>${convertToStandardTime(record.end_shift)}</td>
                <td>${record.hours_rendered}</td>
                <td>${record.hours_late_start_shift}</td> 
                <td>${record.hours_late_end_lunch}</td> 
                <td>${record.overtime_hours}</td>
            `;
            recordsTableBody.appendChild(row);

            // Try parsing hours_rendered as a float
            var hoursRendered = parseFloat(record.hours_rendered);
            if (!isNaN(hoursRendered)) {
                totalHours += hoursRendered; // Add rendered hours to total
            } else {
                console.error('Invalid hours_rendered:', record.hours_rendered); // Log invalid data
            }

            // Try parsing hours_late_start_shift as a float
            var lateStartShift = parseFloat(record.hours_late_start_shift);
            if (!isNaN(lateStartShift)) {
                totalLateStartShift += lateStartShift; // Add late start shift hours to total
            }

            // Try parsing hours_late_end_lunch as a float
            var lateEndLunch = parseFloat(record.hours_late_end_lunch);
            if (!isNaN(lateEndLunch)) {
                totalLateEndLunch += lateEndLunch; // Add late end lunch hours to total
            }

            // Try parsing overtime_hours as a float
            var overtimeHours = parseFloat(record.overtime_hours);
            if (!isNaN(overtimeHours)) {
                totalOvertime += overtimeHours; // Add overtime hours to total
            }
        });

        updateTotalWorkedHours(totalHours); // Update total worked hours
        updateTotalTardinessHours(totalLateStartShift + totalLateEndLunch); // Update total tardiness hours
        updateTotalOvertime(totalOvertime); // Update total overtime hours
    })
    .catch(error => {
        console.error('Error fetching records:', error); // Log any errors
    });
}

// Function to update total overtime hours
function updateTotalOvertime(totalOvertime) {
    var totalOvertimeElement = document.getElementById('totalOvertimeHours');
    totalOvertimeElement.textContent = totalOvertime.toFixed(2) + ' Hour/s';
}

// Function to update total tardiness hours
function updateTotalTardinessHours(totalTardinessHours) {
    var totalTardinessHoursElement = document.getElementById('totalTardinessHours');
    totalTardinessHoursElement.textContent = totalTardinessHours.toFixed(2) + ' Hour/s';
}

// Function to convert military time to standard time format
function convertToStandardTime(militaryTime) {
    // Check if military time is valid
    if (!militaryTime) {
        return "-";
    }

    // Extract hours and minutes from military time
    var hours = parseInt(militaryTime.substring(0, 2), 10);
    var minutes = parseInt(militaryTime.substring(3, 5), 10);

    // Check if hours and minutes are valid
    if (isNaN(hours) || isNaN(minutes)) {
        return "-";
    }

    // Determine AM or PM
    var period = hours < 12 ? "AM" : "PM";

    // Convert 24-hour format to 12-hour format
    if (hours > 12) {
        hours -= 12;
    } else if (hours === 0) {
        hours = 12;
    }

    // Format the time as HH:MM AM/PM
    return hours.toString().padStart(2, '0') + ":" + minutes.toString().padStart(2, '0') + " " + period;
}

// Function to calculate and update total overtime hours
function updateTotalOvertimeHours() {
    var totalOvertime = 0; // Initialize total overtime hours

    // Get all rows in the records table body
    var rows = document.getElementById('recordsTableBody').getElementsByTagName('tr');

    // Loop through each row
    for (var i = 0; i < rows.length; i++) {
        // Get the overtime cell in the current row
        var overtimeCell = rows[i].cells[10]; // Assuming overtime is in the 11th column (index 10)

        // Get the overtime hours as a float from the cell text
        var overtimeHours = parseFloat(overtimeCell.textContent.trim());

        // Check if the parsed overtime hours is a valid number
        if (!isNaN(overtimeHours)) {
            // Add the overtime hours to the total
            totalOvertime += overtimeHours;
        }
    }

    // Update the total overtime cell in the summary table
    var totalOvertimeCell = document.getElementById('totalOvertimeHours');
    totalOvertimeCell.textContent = totalOvertime.toFixed(2) + ' Hour/s';
}
</script>
@endsection
