<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Illuminate\Support\Facades\Auth;

class InoutController extends Controller
{
    public function show()
    {
        // Retrieve the current user's employee record
        $employeeRecord = Auth::user()->employeeRecord;

        // Check if the employee record exists
        if ($employeeRecord) {
            // Retrieve the current shift record for the employee
            $employeeShiftRecord = $employeeRecord->employeeShiftRecords()->whereDate('shift_date', now()->toDateString())->first();
        } else {
            $employeeShiftRecord = null;
        }

        return view('employees.inout', compact('employeeShiftRecord'));
    }
}