<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon; // Add this line at the top of your ShiftController file
use Illuminate\Support\Facades\Auth; // Add this line at the top of your ShiftController file
use App\Models\EmployeeShiftRecord; // Add this line at the top of your ShiftController file

use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function startShift()
{
    $userId = Auth::id();
    $today = Carbon::now()->toDateString();

    // Fetch the user's default shift ID from the database
    $defaultShiftId = Auth::user()->default_shift_id;

    // Check if shift record already exists for today
    $employeeShiftRecord = EmployeeShiftRecord::where([
        'employee_id' => $userId,
        'shift_date' => $today,
    ])->first();

    // If the record doesn't exist, create it
    if (!$employeeShiftRecord) {
        $employeeShiftRecord = new EmployeeShiftRecord([
            'employee_id' => $userId,
            'shift_id' => $defaultShiftId,
            'shift_date' => $today,
        ]);
        $employeeShiftRecord->save();
    }

    // Set the shift_started column only if it's not already set
    if (!$employeeShiftRecord->shift_started) {
        $employeeShiftRecord->shift_started = Carbon::now();
        $employeeShiftRecord->save();
    }

    // Redirect back to the dashboard
    return redirect()->back();
}



    public function endShift()
    {
        $userId = Auth::id();
        $today = Carbon::now()->toDateString();

        // Find existing shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', $today)
            ->firstOrFail();

        // Update shift end time only if it's not already set
        if (!$employeeShiftRecord->shift_ended) {
            $employeeShiftRecord->shift_ended = Carbon::now();
            $employeeShiftRecord->save();
        }

        return redirect()->back();
    }

    public function startLunch()
    {
        $userId = Auth::id();
        $today = Carbon::now()->toDateString();

        // Find existing shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', $today)
            ->firstOrFail();

        // Update lunch start time only if it's not already set
        if (!$employeeShiftRecord->lunch_started) {
            $employeeShiftRecord->lunch_started = Carbon::now();
            $employeeShiftRecord->save();
        }

        return redirect()->back();
    }

    public function endLunch()
    {
        $userId = Auth::id();
        $today = Carbon::now()->toDateString();

        // Find existing shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', $today)
            ->firstOrFail();

        // Update lunch end time only if it's not already set
        if (!$employeeShiftRecord->lunch_ended) {
            $employeeShiftRecord->lunch_ended = Carbon::now();
            $employeeShiftRecord->save();
        }

        return redirect()->back();
    }
}