<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeRecord;

use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function startShift()
    {
        $userId = Auth::id();
        $userTimezone = Auth::user()->timezone;
        $now = Carbon::now($userTimezone)->toDateTimeString(); // Convert to user's timezone

        $today = Carbon::now()->toDateString();

        // Fetch the user's default shift ID from the employee_records table
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->firstOrFail();
        $defaultShiftId = $employeeRecord->default_shift_id;

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
            $employeeShiftRecord->shift_started = $now; // Save in user's timezone
            $employeeShiftRecord->save();
        }

        // Redirect back to the dashboard
        return redirect()->back();
    }

    
    public function endShift()
    {
        $userId = Auth::id();
        $userTimezone = Auth::user()->timezone;
        $now = Carbon::now($userTimezone)->toDateTimeString(); // Convert to user's timezone

        $today = Carbon::now()->toDateString();

        // Find existing shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', $today)
            ->firstOrFail();

        // Update shift end time only if it's not already set
        if (!$employeeShiftRecord->shift_ended) {
            $employeeShiftRecord->shift_ended = $now; // Save in user's timezone
            $employeeShiftRecord->save();
        }

        return redirect()->back();
    }

    public function startLunch()
    {
        $userId = Auth::id();
        $userTimezone = Auth::user()->timezone;
        $now = Carbon::now($userTimezone)->toDateTimeString(); // Convert to user's timezone

        $today = Carbon::now()->toDateString();

        // Find existing shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', $today)
            ->firstOrFail();

        // Update lunch start time only if it's not already set
        if (!$employeeShiftRecord->lunch_started) {
            $employeeShiftRecord->lunch_started = $now; // Save in user's timezone
            $employeeShiftRecord->save();
        }

        return redirect()->back();
    }

    public function endLunch()
    {
        $userId = Auth::id();
        $userTimezone = Auth::user()->timezone;
        $now = Carbon::now($userTimezone)->toDateTimeString(); // Convert to user's timezone

        $today = Carbon::now()->toDateString();

        // Find existing shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', $today)
            ->firstOrFail();

        // Update lunch end time only if it's not already set
        if (!$employeeShiftRecord->lunch_ended) {
            $employeeShiftRecord->lunch_ended = $now; // Save in user's timezone
            $employeeShiftRecord->save();
        }

        return redirect()->back();
    }
}