<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeAssignedShift; 
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

                // Get the current date in the employee's timezone
                $today = Carbon::now($employeeTimezone)->toDateString();

                // Fetch shift record for today in the employee's timezone
                $shiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
                    ->whereDate('shift_date', $today)
                    ->first();

                // Fetch assigned shifts for the employee
                $assignedShifts = EmployeeAssignedShift::where('employee_record_id', $employeeRecord->id)
                    ->with('shiftSchedule')
                    ->get();

                // Convert all shift times to the employee's timezone
                if ($shiftRecord) {
                    $shiftRecord->clock_in_time = Carbon::parse($shiftRecord->clock_in_time)->setTimezone($employeeTimezone);
                    $shiftRecord->clock_out_time = Carbon::parse($shiftRecord->clock_out_time)->setTimezone($employeeTimezone);
                }

                // Pass the shift record, assigned shifts, and employee timezone to the view
                return view('employees.timesheet', compact('shiftRecord', 'assignedShifts', 'employeeTimezone'));
            } else {
                // Handle case where employee record does not exist for the user
                return response()->json(['message' => 'Employee record not found'], 404);
            }
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }
}

