<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord; // Assuming this is your model for employee shift records
use App\Models\EmployeeRecord;


class DashboardController extends Controller
{
    public function show()
    {
        // Retrieve the current user's ID from the authenticated user
        $userId = Auth::id();
    
        // Fetch the user's employee record
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();
    
        // Get the default shift associated with the user's employee record
        $defaultShift = $employeeRecord->defaultShift ?? null;
    
        // Fetch the employee shift record based on the user's ID
        $employeeShiftRecord = EmployeeShiftRecord::whereHas('employee', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->first();
    
        // Pass the $employeeShiftRecord and $defaultShift variables to the view
        return view('employees.dashboard', [
            'employeeRecord' => $employeeRecord, // Change variable name to employeeRecord
            'defaultShift' => $defaultShift,
            'employeeShift' => $employeeShiftRecord, // Correct variable name to employeeShift
        ]);
    }
    
}
