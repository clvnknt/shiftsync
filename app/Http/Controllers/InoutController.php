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
    
        // Retrieve the active shift record for the current date
        $activeShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->whereDate('shift_date', Carbon::today())
            ->first();
    
        // If there's no active shift record, return the view with null values
        if (!$activeShiftRecord) {
            return view('employees.inout', [
                'activeShiftRecord' => null,
            ]);
        }
    
        // Check if start_shift and end_shift are both logged for the active shift record
        $isShiftLogged = $activeShiftRecord->start_shift && $activeShiftRecord->end_shift;
    
        // If all values are logged, find the next shift record and replace the active shift
        if ($isShiftLogged) {
            $nextShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
                ->where('shift_order', '>', $activeShiftRecord->shift_order)
                ->whereDate('shift_date', Carbon::today())
                ->orderBy('shift_order')
                ->first();
            
            // Replace the active shift record with the next shift record
            $activeShiftRecord = $nextShiftRecord;
        }

        // Retrieve all current assigned shifts for the employee
        $currentAssignedShifts = EmployeeAssignedShift::where('employee_record_id', $employeeRecord->id)
            ->where('is_active', true)
            ->with('shiftSchedule')
            ->get();
    
        // Format time values for currently assigned shifts
        foreach ($currentAssignedShifts as $assignedShift) {
            $assignedShift->shiftSchedule->start_shift_time = Carbon::parse($assignedShift->shiftSchedule->start_shift_time)->format('H:i');
            $assignedShift->shiftSchedule->lunch_start_time = Carbon::parse($assignedShift->shiftSchedule->lunch_start_time)->format('H:i');
            $assignedShift->shiftSchedule->end_lunch_time = Carbon::parse($assignedShift->shiftSchedule->end_lunch_time)->format('H:i');
            $assignedShift->shiftSchedule->end_shift_time = Carbon::parse($assignedShift->shiftSchedule->end_shift_time)->format('H:i');
        }
    
        // Pass the active shift record to the view
        return view('employees.inout', [
            'activeShiftRecord' => $activeShiftRecord,
            'currentAssignedShifts' => $currentAssignedShifts,
        ]);
    }
}
