<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\EmployeeAssignedShift; 
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    public function showTimesheet(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Retrieve the authenticated user's ID
            $userId = Auth::id();
    
            // Retrieve the employee record associated with the authenticated user
            $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();
    
            // Check if the employee record exists
            if ($employeeRecord) {
                // Get the employee timezone
                $employeeTimezone = $employeeRecord->employee_timezone;
    
                // Get the current date in the employee's timezone
                $today = Carbon::now($employeeTimezone)->toDateString();
    
                // Fetch assigned shifts for the employee
                $assignedShifts = EmployeeAssignedShift::where('employee_record_id', $employeeRecord->id)
                    ->with('shiftSchedule')
                    ->get();
    
                // Get all shift names associated with the employee's assigned shifts
                $shiftNames = $assignedShifts->pluck('shiftSchedule.shift_name', 'id');
    
                // Initialize variables for shift record
                $shiftRecordDate = null;
                $shiftRecordStartTime = null;
                $shiftRecordEndTime = null;
                $shiftRecordStartShift = null;
                $shiftRecordStartLunch = null;
                $shiftRecordEndLunch = null;
                $shiftRecordEndShift = null;
    
                // Initialize records variable
                $records = null;
    
                // Pass the necessary data to the view
                return view('employees.timesheet', compact('shiftRecordDate', 'shiftRecordStartTime', 'shiftRecordEndTime', 'shiftRecordStartShift', 'shiftRecordStartLunch', 'shiftRecordEndLunch', 'shiftRecordEndShift', 'assignedShifts', 'shiftNames', 'employeeTimezone', 'records'));
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
    
        // Retrieve the authenticated user's ID
        $userId = Auth::id();
    
        // Retrieve the employee record associated with the authenticated user
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();
    
        // Fetch records with proper joins
        $records = EmployeeShiftRecord::with(['employeeAssignedShift.shiftSchedule'])
            ->where('employee_assigned_shift_id', $shiftId)
            ->whereBetween('shift_date', [$startDate, $endDate])
            ->get();
    
        // Format the fetched records properly
        $formattedRecords = $records->map(function ($record) use ($employeeRecord) {
            // Mapping of timezone offsets to their corresponding names
            $timezones = [
                '+08:00' => 'PH Timezone',
                '+10:00' => 'AU Timezone',
                '+01:00' => 'UK Timezone',
                '-05:00' => 'US Timezone',
                // Add more timezone offsets and their names as needed
            ];
    
            // Retrieve the shift timezone offset
            $shiftTimezoneOffset = $record->employeeAssignedShift->shiftSchedule->shift_timezone;
    
            // Convert the timezone offset to the corresponding name
            if ($shiftTimezoneOffset === '-05:00') {
                // Convert US Timezone to EDT
                $shiftTimezoneOffset = '-04:00'; // Set to EDT offset
            }
            $shiftTimezone = $timezones[$shiftTimezoneOffset] ?? 'Unknown Timezone';
    
            return [
                'shift_date' => Carbon::parse($record->shift_date)->setTimezone($employeeRecord->employee_timezone)->format('F j, Y'),
                'shiftName' => $record->employeeAssignedShift->shiftSchedule->shift_name,
                'shiftSchedule' => [
                    'start_shift_time' => $record->employeeAssignedShift->shiftSchedule->start_shift_time ? Carbon::parse($record->employeeAssignedShift->shiftSchedule->start_shift_time)->timezone($record->employeeAssignedShift->shiftSchedule->shift_timezone)->format('H:i') : '-',
                    'end_shift_time' => $record->employeeAssignedShift->shiftSchedule->end_shift_time ? Carbon::parse($record->employeeAssignedShift->shiftSchedule->end_shift_time)->timezone($record->employeeAssignedShift->shiftSchedule->shift_timezone)->format('H:i') : '-',
                    'shiftTimezone' => $shiftTimezone,
                ],
                'start_shift' => $this->formatTime($record->start_shift, $employeeRecord->employee_timezone),
                'start_lunch' => $this->formatTime($record->start_lunch, $employeeRecord->employee_timezone),
                'end_lunch' => $this->formatTime($record->end_lunch, $employeeRecord->employee_timezone),
                'end_shift' => $this->formatTime($record->end_shift, $employeeRecord->employee_timezone),
                'hours_rendered' => $record->hours_rendered ?: '-',
            ];
        });
    
        // Return the formatted records as JSON response
        return response()->json($formattedRecords);
    }
    

    // Function to format time with timezone
    private function formatTime($time, $timezone)
    {
        return $time ? Carbon::parse($time)->setTimezone($timezone)->format('H:i') : '-';
    }
}