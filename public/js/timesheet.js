// JavaScript code to handle the "Apply" button click event
document.getElementById('apply-date-range').addEventListener('click', function() {
    // Get the selected start and end dates
    var startDate = document.getElementById('start-date').value;
    var endDate = document.getElementById('end-date').value;

    // Construct the URL for the timesheet page with the selected date range as query parameters
    var url = "{{ route('timesheet') }}" + "?start_date=" + startDate + "&end_date=" + endDate;
    
    // Redirect to the timesheet page with the selected date range
    window.location.href = url;
});