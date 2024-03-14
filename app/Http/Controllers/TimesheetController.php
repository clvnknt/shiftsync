<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\Shift;
use App\Models\EmployeeShiftRecord;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display the timesheet page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retrieve the current user's ID
        $userId = auth()->id();

        // Retrieve the employee record for the user
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

        // Retrieve the default shift for the employee
        $defaultShift = $employeeRecord ? $employeeRecord->defaultShift : null;

        // Retrieve today's shift record for the employee
        $todayShift = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', today()->toDateString())
            ->first();

        // Retrieve all shift records for the employee
        $employeeShiftRecords = EmployeeShiftRecord::where('employee_id', $userId)->get();

        return view('employees.timesheet', [
            'user' => User::find($userId),
            'employeeRecord' => $employeeRecord,
            'defaultShift' => $defaultShift,
            'todayShift' => $todayShift,
            'employeeShiftRecords' => $employeeShiftRecords, // Pass employee shift records to the view
        ]);
    }
}

