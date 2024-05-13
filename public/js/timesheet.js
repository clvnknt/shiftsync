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

    // Iterate over each row and add overtime hours to total
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var overtimeCell = row.getElementsByTagName('td')[10]; // Overtime hours cell

        // Parse overtime hours as a float
        var overtimeHours = parseFloat(overtimeCell.textContent);
        if (!isNaN(overtimeHours)) {
            totalOvertime += overtimeHours; // Add overtime hours to total
        }
    }

    // Update total overtime hours in the HTML element
    var totalOvertimeElement = document.getElementById('totalOvertimeHours');
    totalOvertimeElement.textContent = totalOvertime.toFixed(2) + ' Hour/s';
}
