<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeRecord;
use App\Models\User; // Import the User model if not already imported


class DashboardController extends Controller
{
    public function show()
{
    // Retrieve the current user's ID from the authenticated user
    $userId = Auth::id();

    // Fetch the user's employee record
    $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

    // Check if the employee record exists
    if (!$employeeRecord) {
        // Handle the case where the employee record is not found
        return redirect()->back()->with('error', 'Employee record not found.');
    }

    // Get the default shift associated with the user's employee record
    $defaultShift = $employeeRecord->defaultShift ?? null;

    // Fetch the employee shift record based on the user's ID
    $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
        ->whereDate('shift_date', now()->toDateString())
        ->first();

    // Pass the $employeeShiftRecord and $defaultShift variables to the view
    return view('employees.dashboard', [
        'user' => Auth::user(), // Pass the authenticated user to the view
        'employeeRecord' => $employeeRecord, // Pass the employee record to the view
        'defaultShift' => $defaultShift,
        'employeeShift' => $employeeShiftRecord,
    ]);
}
}
