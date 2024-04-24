<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeShiftRecord;

class TimesheetController extends Controller
{
    public function showTimesheet(Request $request)
    {
        // Check if start_date and end_date are provided in the request
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Fetch shift records within the specified date range
            $shiftRecords = EmployeeShiftRecord::whereBetween('shift_date', [$startDate, $endDate])->get();
            
            // Pass the shift records to the view
            return view('employees.timesheet', compact('shiftRecords'));
        }

        // If start_date and end_date are not provided, simply return the view
        return view('employees.timesheet');
    }
}
