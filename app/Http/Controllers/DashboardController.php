<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        try {
            // Get the authenticated user's ID
            $userId = Auth::id();

            // Retrieve the employee record for the authenticated user
            $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

            // Redirect back if employee record not found
            if (!$employeeRecord) {
                return redirect()->back()->with('error', 'Employee record not found.');
            }

            // Get the user's timezone and today's date
            $userTimezone = Auth::user()->timezone;
            $today = Carbon::now($userTimezone)->toDateString();

            // Ensure the shift record exists for the user
            $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
                'employee_id' => $userId,
                'shift_date' => $today,
            ]);

            // If the shift record doesn't exist, create a new one with the default shift
            if (!$employeeShiftRecord->exists) {
                $employeeRecord = EmployeeRecord::where('user_id', $userId)->firstOrFail();
                $defaultShiftId = $employeeRecord->default_shift_id;

                $employeeShiftRecord->shift_id = $defaultShiftId;
                $employeeShiftRecord->save();
            }

            // Retrieve the employee shift record
            $employeeShift = EmployeeShiftRecord::where('employee_id', $userId)
                ->where('shift_date', $today)
                ->first();

            // Return the dashboard view with necessary data
            return view('employees.dashboard', [
                'user' => Auth::user(),
                'employeeRecord' => $employeeRecord,
                'employeeShift' => $employeeShift,
            ]);
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}