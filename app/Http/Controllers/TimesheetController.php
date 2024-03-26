<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\Shift;

class TimesheetController extends Controller
{
    public function show()
{
    $userId = auth()->id();

    $user = User::find($userId);
    $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

    $timesheetData = $this->fetchTimesheetData($userId);
    $currentShiftRecord = $this->fetchCurrentShiftRecord($userId);

    return view('employees.timesheet', [
        'user' => $user,
        'employeeRecord' => $employeeRecord,
        'timesheetData' => $timesheetData,
        'currentShiftRecord' => $currentShiftRecord,
    ]);
}

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
    
    private function fetchCurrentShiftRecord($userId)
    {
        return EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', today())
            ->first();
    }
}