<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use App\Models\ShiftSchedule;


class InoutController extends Controller
{
    public function showInout()
    {
        // Retrieve the authenticated user's employee record
        $employeeRecord = Auth::user()->employeeRecord;

        // Retrieve the assigned shifts for the employee
        $assignedShifts = EmployeeAssignedShift::where('employee_record_id', $employeeRecord->id)
                        ->where('is_active', true)
                        ->with('shiftSchedule')
                        ->get();

        // Retrieve the active shift record for the current date
        $activeShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->whereDate('shift_date', Carbon::today())
            ->first();

        return view('employees.inout', compact('assignedShifts', 'activeShiftRecord'));
    }
}
