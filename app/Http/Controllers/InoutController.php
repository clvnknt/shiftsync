<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;

class InoutController extends Controller
{
    public function showInout()
    {
        // Retrieve the authenticated user's employee record
        $employeeRecord = Auth::user()->employeeRecord;
    
        // Get the employee's timezone
        $employeeTimezone = $employeeRecord->employee_timezone;
    
        // Calculate the current date using the employee's timezone
        $currentDate = now($employeeTimezone)->toDateString();
    
        // Retrieve the active shift record for the current date
        $activeShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->where('shift_date', $currentDate)
            ->first();
    
        // If there's no active shift record, return the view with null values
        if (!$activeShiftRecord) {
            return view('employees.inout', [
                'activeShiftRecord' => null,
                'currentAssignedShifts' => [],
                'employeeTimezone' => $employeeTimezone,
            ]);
        }
    
        // Retrieve all current assigned shifts for the employee where is_active is true
        $currentAssignedShifts = EmployeeAssignedShift::where('employee_record_id', $employeeRecord->id)
            ->where('is_active', true)
            ->whereHas('employeeShiftRecords', function ($query) use ($currentDate) {
                $query->where('shift_date', $currentDate)
                    ->where('is_active', true);
            })
            ->with(['shiftSchedule'])
            ->get();
    
        // Convert UTC times to employee's timezone and shift's timezone using Carbon
        $currentAssignedShifts->transform(function ($assignedShift) use ($employeeTimezone) {
            $assignedShift->shiftSchedule->start_shift_time = \Carbon\Carbon::parse($assignedShift->shiftSchedule->start_shift_time)->setTimezone($employeeTimezone)->format('H:i');
            $assignedShift->shiftSchedule->lunch_start_time = \Carbon\Carbon::parse($assignedShift->shiftSchedule->lunch_start_time)->setTimezone($employeeTimezone)->format('H:i');
            $assignedShift->shiftSchedule->end_lunch_time = \Carbon\Carbon::parse($assignedShift->shiftSchedule->end_lunch_time)->setTimezone($employeeTimezone)->format('H:i');
            $assignedShift->shiftSchedule->end_shift_time = \Carbon\Carbon::parse($assignedShift->shiftSchedule->end_shift_time)->setTimezone($employeeTimezone)->format('H:i');
            
            return $assignedShift;
        });
    
        // Convert active shift record times to employee's timezone
        if ($activeShiftRecord) {
            $activeShiftRecord->start_shift = $activeShiftRecord->start_shift ? \Carbon\Carbon::parse($activeShiftRecord->start_shift)->setTimezone($employeeTimezone) : null;
            $activeShiftRecord->start_lunch = $activeShiftRecord->start_lunch ? \Carbon\Carbon::parse($activeShiftRecord->start_lunch)->setTimezone($employeeTimezone) : null;
            $activeShiftRecord->end_lunch = $activeShiftRecord->end_lunch ? \Carbon\Carbon::parse($activeShiftRecord->end_lunch)->setTimezone($employeeTimezone) : null;
            $activeShiftRecord->end_shift = $activeShiftRecord->end_shift ? \Carbon\Carbon::parse($activeShiftRecord->end_shift)->setTimezone($employeeTimezone) : null;
        }
    
        // Pass the active shift record and assigned shifts to the view
        return view('employees.inout', [
            'activeShiftRecord' => $activeShiftRecord,
            'currentAssignedShifts' => $currentAssignedShifts,
            'employeeTimezone' => $employeeTimezone,
        ]);
    }       
}
