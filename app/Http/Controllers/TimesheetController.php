<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\EmployeeAssignedShift; 
use App\Models\EmployeeShiftRecord;
use App\Models\Tardiness;
use App\Models\Overtime;

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
            $employeeRecord = EmployeeRecord::where('user_id', $userId)
                ->with('assignedCutoffPeriods.cutoffPeriod') // Eager load assigned cutoff periods
                ->first();
    
    
            // Check if the employee record exists
            if ($employeeRecord) {
                // Get the employee timezone
                $employeeTimezone = $employeeRecord->employee_timezone;
    
                // Fetch assigned shifts for the employee
                $assignedShifts = EmployeeAssignedShift::where('employee_record_id', $employeeRecord->id)
                    ->with('shiftSchedule')
                    ->get();
    
                // Get all shift names associated with the employee's assigned shifts
                $shiftNames = $assignedShifts->pluck('shiftSchedule.shift_name', 'id');
    
                // Set an empty array for records
                $records = [];
    
                // Pass the necessary data to the view
                return view('employees.timesheet', compact('assignedShifts', 'shiftNames', 'employeeTimezone', 'records', 'employeeRecord'));
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
        $records = EmployeeShiftRecord::with(['employeeAssignedShift.shiftSchedule', 'tardiness', 'overtime'])
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
                '-04:00' => 'US Timezone',
            ];
    
            // Retrieve the shift timezone offset
            $shiftTimezoneOffset = $record->employeeAssignedShift->shiftSchedule->shift_timezone;
    
            // Use the retrieved offset directly without adjustment
            $shiftTimezone = $timezones[$shiftTimezoneOffset] ?? 'Unknown Timezone';
    
            // Calculate late hours for start shift
            $lateHoursStartShift = $record->tardiness ? $record->tardiness->hours_late_start_shift : '-';
            
            // Calculate late hours for end lunch
            $lateHoursEndLunch = $record->tardiness ? $record->tardiness->hours_late_end_lunch : '-';
    
            return [
                'shift_date' => Carbon::parse($record->shift_date)->setTimezone($employeeRecord->employee_timezone)->format('F j, Y'),
                'shiftName' => $record->employeeAssignedShift->shiftSchedule->shift_name,
                'shiftSchedule' => [
                    'start_shift_time' => $record->employeeAssignedShift->shiftSchedule->start_shift_time ? 
                    Carbon::createFromTimeString($record->employeeAssignedShift->shiftSchedule->start_shift_time, 'UTC')
                        ->setTimezone($record->employeeAssignedShift->shiftSchedule->shift_timezone)
                        ->format('H:i') : '-',
                'end_shift_time' => $record->employeeAssignedShift->shiftSchedule->end_shift_time ? 
                    Carbon::createFromTimeString($record->employeeAssignedShift->shiftSchedule->end_shift_time, 'UTC')
                        ->setTimezone($record->employeeAssignedShift->shiftSchedule->shift_timezone)
                        ->format('H:i') : '-',
                
                    'shiftTimezone' => $shiftTimezone,
                ],
                'start_shift' => $this->formatTime($record->start_shift, $employeeRecord->employee_timezone),
                'start_lunch' => $this->formatTime($record->start_lunch, $employeeRecord->employee_timezone),
                'end_lunch' => $this->formatTime($record->end_lunch, $employeeRecord->employee_timezone),
                'end_shift' => $this->formatTime($record->end_shift, $employeeRecord->employee_timezone),
                'hours_rendered' => $record->hours_rendered ?: '-',
                'hours_late_start_shift' => $lateHoursStartShift,
                'hours_late_end_lunch' => $lateHoursEndLunch,
                'overtime_hours' => $record->overtime ? $record->overtime->overtime_hours : '-',
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