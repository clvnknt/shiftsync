document.addEventListener("DOMContentLoaded", function() {
    // Get the select elements
    var viewFormatSelect = document.getElementById("viewFormatSelect");
    var shiftNameSelect = document.getElementById("shiftNameSelect");

    // Get the containers for cutoff, date range, cutoff buttons, and range icons
    var cutoffContainer = document.getElementById("cutoffContainer");
    var dateRangeContainer = document.getElementById("dateRangeContainer");
    var cutoffButtonsContainer = document.getElementById("cutoffButtons");
    var rangeIconsContainer = document.getElementById("rangeIcons");
    var viewFormatContainer = document.getElementById("viewFormatContainer");

    // Function to hide all related elements
    function hideAll() {
        viewFormatContainer.style.display = "none";
        cutoffContainer.style.display = "none";
        dateRangeContainer.style.display = "none";
        cutoffButtonsContainer.style.display = "none";
        rangeIconsContainer.style.display = "none";
    }

    // Function to show related elements
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

    // Add event listener to detect changes in the view format select
    viewFormatSelect.addEventListener("change", function() {
        var selectedShiftName = shiftNameSelect.value;
        var selectedFormat = viewFormatSelect.value;

        // Hide all related elements if shift name is "-"
        if (selectedShiftName === "-") {
            hideAll();
            return;
        }

        // Show select format dropdown if a shift name is selected
        viewFormatContainer.style.display = "block";

        // Show the selected format container based on the view format select
        showRelated();
    });

    // Add event listener to detect changes in the shift name select
    shiftNameSelect.addEventListener("change", function() {
        var selectedShiftName = shiftNameSelect.value;

        // Hide all related elements if shift name is "-"
        if (selectedShiftName === "-") {
            hideAll();
            return;
        }

        // Show select format dropdown if a shift name is selected
        viewFormatContainer.style.display = "block";

        // Show the related elements
        showRelated();
    });

    // Hide all related elements initially
    hideAll();

    // Add event listener for the "View" button click
    document.getElementById("viewButton").addEventListener("click", function() {
        fetchRecords();
    });
});

function fetchRecords() {
// Get selected shift name and date range
var shiftId = document.getElementById('shiftNameSelect').value;
var startDate = document.getElementById('start_date').value;
var endDate = document.getElementById('end_date').value;

// Log the selected shift ID and date range
console.log('Shift ID:', shiftId);
console.log('Start Date:', startDate);
console.log('End Date:', endDate);

// Construct the request URL
var url = '/fetch-records';

// Make AJAX request
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
.then(response => response.json())
.then(data => {
// Log the response data
console.log('Response data:', data);

// Handle response data and update UI
// Example: updateRecordsTable(data);
})
.catch(error => {
// Log any errors
console.error('Error fetching records:', error);
});
}

