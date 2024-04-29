<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeAssignedShift; 
use App\Models\ShiftSchedule; 
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
    
                // Get all shift names associated with the employee's assigned shifts
                $shiftNames = $assignedShifts->pluck('shiftSchedule.shift_name', 'id');
    
                // Convert all shift times to the employee's timezone
                if ($shiftRecord) {
                    $shiftRecord->clock_in_time = Carbon::parse($shiftRecord->clock_in_time)->setTimezone($employeeTimezone);
                    $shiftRecord->clock_out_time = Carbon::parse($shiftRecord->clock_out_time)->setTimezone($employeeTimezone);
                }
    
                // Parse shift dates and times to the employee's timezone
                $shiftRecordDate = $shiftRecord ? Carbon::parse($shiftRecord->shift_date)->timezone($employeeTimezone)->format('F d, Y') : null;
                $shiftRecordStartTime = $shiftRecord && $shiftRecord->employeeAssignedShift ? Carbon::parse($shiftRecord->employeeAssignedShift->shiftSchedule->start_shift_time)->format('H:i') : null;
                $shiftRecordEndTime = $shiftRecord && $shiftRecord->employeeAssignedShift ? Carbon::parse($shiftRecord->employeeAssignedShift->shiftSchedule->end_shift_time)->format('H:i') : null;
                $shiftRecordStartShift = $shiftRecord ? Carbon::parse($shiftRecord->start_shift)->timezone($employeeTimezone)->format('H:i') : null;
                $shiftRecordStartLunch = $shiftRecord ? Carbon::parse($shiftRecord->start_lunch)->timezone($employeeTimezone)->format('H:i') : null;
                $shiftRecordEndLunch = $shiftRecord ? Carbon::parse($shiftRecord->end_lunch)->timezone($employeeTimezone)->format('H:i') : null;
                $shiftRecordEndShift = $shiftRecord ? Carbon::parse($shiftRecord->end_shift)->timezone($employeeTimezone)->format('H:i') : null;
    
                // Fetch shift records for the specified date range
                $shiftId = $request->input('shiftId');
                $startDate = $request->input('startDate');
                $endDate = $request->input('endDate');
                
                $records = null; // Initialize records variable
                
                if ($shiftId && $startDate && $endDate) {
                    // Query the database to fetch records based on the parameters
                    $records = EmployeeShiftRecord::where('employee_assigned_shift_id', $shiftId)
                        ->whereBetween('shift_date', [$startDate, $endDate])
                        ->get();
                }
    
                // Pass the shift record, assigned shifts, shift name, shift names, employee timezone, and records to the view
                return view('employees.timesheet', compact('shiftRecordDate', 'shiftRecordStartTime', 'shiftRecordEndTime', 'shiftRecordStartShift', 'shiftRecordStartLunch', 'shiftRecordEndLunch', 'shiftRecordEndShift', 'assignedShifts', 'shiftNames', 'employeeTimezone', 'shiftRecord', 'records'));
            } else {
                // Handle case where employee record does not exist for the user
                return response()->json(['message' => 'Employee record not found'], 404);
            }
        }
    
        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }
    

    public function fetchRecords(Request $request)
{
    // Retrieve parameters from the request
    $shiftId = $request->input('shiftId');
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    // Fetch records with proper joins
    $records = EmployeeShiftRecord::with(['employeeAssignedShift.shiftSchedule'])
        ->where('employee_assigned_shift_id', $shiftId)
        ->whereBetween('shift_date', [$startDate, $endDate])
        ->get();

    // Format the fetched records properly
    $formattedRecords = $records->map(function ($record) {
        return [
            'shift_date' => $record->shift_date,
            'shiftName' => $record->employeeAssignedShift->shiftSchedule->shift_name,
            'shiftSchedule' => $record->employeeAssignedShift->shiftSchedule->toArray(), // Assuming you want the entire shift schedule details
            'start_shift' => $record->start_shift,
            'start_lunch' => $record->start_lunch,
            'end_lunch' => $record->end_lunch,
            'end_shift' => $record->end_shift,
            'hours_rendered' => $record->hours_rendered,
        ];
    });

    // Return the formatted records as JSON response
    return response()->json($formattedRecords);
}

}
