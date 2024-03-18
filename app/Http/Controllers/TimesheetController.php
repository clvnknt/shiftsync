<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Illuminate\Support\Carbon;
use App\Models\Shift;

class TimesheetController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();
        $defaultShift = $employeeRecord ? $employeeRecord->defaultShift : null;

        $shiftNames = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', '<=', now())
            ->join('shifts', 'employee_shift_records.shift_id', '=', 'shifts.id')
            ->pluck('shifts.shift_name')
            ->unique()
            ->toArray();

        $currentShiftRecord = $this->fetchCurrentShiftRecord($userId);

        $employeeShiftRecords = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', '<=', now())
            ->get();

        return view('employees.timesheet', [
            'user' => User::find($userId),
            'employeeRecord' => $employeeRecord,
            'defaultShift' => $defaultShift,
            'currentShiftRecord' => $currentShiftRecord,
            'shiftNames' => $shiftNames,
            'employeeShiftRecords' => $employeeShiftRecords,
        ]);
    }

    private function fetchCurrentShiftRecord($userId)
    {
        return EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', today())
            ->first();
    }
}