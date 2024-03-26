<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmployeeShiftRecord;

class DashboardController extends Controller
{
    public function show()
    {
        // Get the authenticated user's current shift record
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_record_id', auth()->user()->employeeRecord->id)
            ->whereDate('shift_date', today())
            ->first();

        return view('employees.inout', compact('employeeShiftRecord'));
    }
}