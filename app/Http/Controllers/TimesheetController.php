<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    public function showTimesheet(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user's ID
            $userId = Auth::id();

            // Retrieve the employee record associated with the authenticated user
            $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

            // Check if the employee record exists
            if ($employeeRecord) {
                // Get the employee timezone
                $employeeTimezone = $employeeRecord->employee_timezone;

                // Get the current date
                $today = Carbon::today()->toDateString();

                // Fetch shift record for today
                $shiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
                    ->whereDate('shift_date', $today)
                    ->first();

                // Pass the shift record and employee timezone to the view
                return view('employees.timesheet', compact('shiftRecord', 'employeeTimezone'));
            } else {
                // Handle case where employee record does not exist for the user
                return response()->json(['message' => 'Employee record not found'], 404);
            }
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }
}
