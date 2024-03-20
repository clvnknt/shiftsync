<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\Shift;

class TimesheetController extends Controller
{
    /**
     * Display the timesheet.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
{
    // Get the authenticated user's ID
    $userId = auth()->id();

    // Fetch the user and employee record
    $user = User::find($userId);
    $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

    // Fetch timesheet data and current shift record
    $timesheetData = $this->fetchTimesheetData($userId);
    $currentShiftRecord = $this->fetchCurrentShiftRecord($userId); // Updated variable name

    // Return the view with the obtained data
    return view('employees.timesheet', [
        'user' => $user,
        'employeeRecord' => $employeeRecord,
        'timesheetData' => $timesheetData,
        'currentShiftRecord' => $currentShiftRecord, // Updated variable name
    ]);
}


    // Controller method to fetch timesheet data
    private function fetchTimesheetData($userId)
    {
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();
        $defaultShift = $employeeRecord ? $employeeRecord->defaultShift : null;

        $shiftNames = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', '<=', now())
            ->join('shifts', 'employee_shift_records.shift_id', '=', 'shifts.id')
            ->pluck('shifts.shift_name')
            ->unique()
            ->toArray();

        return [
            'defaultShift' => $defaultShift,
            'shiftNames' => $shiftNames,
        ];
    }
    
    /**
     * Fetch the current shift record.
     *
     * @param  int  $userId
     * @return \App\Models\EmployeeShiftRecord|null
     */
    private function fetchCurrentShiftRecord($userId)
    {
        return EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', today())
            ->first();
    }
}