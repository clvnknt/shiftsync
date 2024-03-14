document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to the "Apply" button
    document.getElementById("apply-date-range").addEventListener("click", function() {
        // Get the selected start and end dates
        var startDate = document.getElementById("start-date").value;
        var endDate = document.getElementById("end-date").value;

        // Send an AJAX request to the server with the selected date range
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/filter-shift-records?start_date=" + startDate + "&end_date=" + endDate);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the employee shift records table with the filtered data
                    var responseData = JSON.parse(xhr.responseText);
                    updateShiftRecordsTable(responseData);
                } else {
                    console.error("Failed to retrieve filtered shift records.");
                }
            }
        };
        xhr.send();
    });
});

function updateShiftRecordsTable(data) {
    var tableBody = document.querySelector(".employee-shift-records-table tbody");
    // Clear existing table rows
    tableBody.innerHTML = "";

    // Append new rows with filtered data
    data.forEach(function(record) {
        var row = document.createElement("tr");
        row.innerHTML = `
            <td>${record.shift_date}</td>
            <td>${record.shift_name}</td>
            <td>${record.shift_started ? record.shift_started : 'N/A'}</td>
            <td>${record.lunch_started ? record.lunch_started : 'N/A'}</td>
            <td>${record.lunch_ended ? record.lunch_ended : 'N/A'}</td>
            <td>${record.shift_ended ? record.shift_ended : 'N/A'}</td>
        `;
        tableBody.appendChild(row);
    });
}
