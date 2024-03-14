<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Http\Controllers\ShiftController;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with user information and shift details.
     *
     * @param  \App\Http\Controllers\ShiftController  $shiftController
     * @return \Illuminate\View\View
     */
    public function show(ShiftController $shiftController)
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

        // Ensure that a shift record exists for the current day
        $shiftController->ensureShiftRecordExists($userId);

        // Fetch the employee shift record based on the user's ID for the current date
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', now()->timezone(Auth::user()->timezone)->toDateString()) // Ensure date is in user's timezone
            ->first();

        // Pass the necessary data to the view
        return view('employees.dashboard', [
            'user' => Auth::user(), // Pass the authenticated user to the view
            'employeeRecord' => $employeeRecord, // Pass the employee record to the view
            'defaultShift' => $defaultShift, // Pass the default shift to the view
            'employeeShift' => $employeeShiftRecord, // Pass the employee shift record to the view
        ]);
    }
}
