<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\Shift; // Add this line
use Illuminate\Support\Facades\Auth;

class InoutController extends Controller
{
    public function showInout()
    {
        // Retrieve the current user's employee record
        $employeeRecord = Auth::user()->employeeRecord;

        // Check if the employee record exists
        if ($employeeRecord) {
            // Retrieve the current shift record for the employee
            $employeeShiftRecord = $employeeRecord->employeeShiftRecords()->whereDate('shift_date', now()->toDateString())->first();
            $currentShift = $employeeRecord->shift; // Retrieve the current shift assigned to the employee
        } else {
            $employeeShiftRecord = null;
            $currentShift = null;
        }

        // Pass the $employeeRecord and $currentShift variables to the view
        return view('employees.inout', compact('employeeShiftRecord', 'employeeRecord', 'currentShift'));
    }   
}
