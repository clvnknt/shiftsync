<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeRecord;

class ShiftController extends Controller
{
    public function updateShiftRecord($userId)
    {
        $userTimezone = Auth::user()->timezone;
        $today = Carbon::now($userTimezone)->toDateString(); // Retrieve today's date in user's timezone

        // Fetch the user's default shift ID from the employee_records table
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->firstOrFail();
        $defaultShiftId = $employeeRecord->default_shift_id;

        // Fetch or create the shift record for today
        $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
            'employee_id' => $userId,
            'shift_date' => $today,
        ]);

        // If the record already exists but the date has changed, reset the day
        if ($employeeShiftRecord->exists && $employeeShiftRecord->shift_date != $today) {
            // Reset the shift for the new day
            $employeeShiftRecord->fill([
                'shift_id' => $defaultShiftId,
                'shift_started' => null,
                'lunch_started' => null,
                'lunch_ended' => null,
                'shift_ended' => null,
            ]);
        } else {
            // Compare the current shift with the default shift
            if ($employeeShiftRecord->exists && $employeeShiftRecord->shift_id != $defaultShiftId) {
                // Update the shift record to reflect the default shift
                $employeeShiftRecord->shift_id = $defaultShiftId;
            }
        }

        // Save the shift record
        $employeeShiftRecord->save();
    }

    public function startShift()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);

        $now = Carbon::now(Auth::user()->timezone)->toDateTimeString(); // Convert to user's timezone

        // Update the shift start time
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', Carbon::now()->toDateString())
            ->firstOrFail();
        $employeeShiftRecord->shift_started = $now;
        $employeeShiftRecord->save();

        return redirect()->back();
    }

    public function endShift()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);

        $now = Carbon::now(Auth::user()->timezone)->toDateTimeString(); // Convert to user's timezone

        // Update the shift end time
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', Carbon::now()->toDateString())
            ->firstOrFail();
        $employeeShiftRecord->shift_ended = $now;
        $employeeShiftRecord->save();

        return redirect()->back();
    }

    public function startLunch()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);

        $now = Carbon::now(Auth::user()->timezone)->toDateTimeString(); // Convert to user's timezone

        // Update the lunch start time
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', Carbon::now()->toDateString())
            ->firstOrFail();
        $employeeShiftRecord->lunch_started = $now;
        $employeeShiftRecord->save();

        return redirect()->back();
    }

    public function endLunch()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);

        $now = Carbon::now(Auth::user()->timezone)->toDateTimeString(); // Convert to user's timezone

        // Update the lunch end time
        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $userId)
            ->where('shift_date', Carbon::now()->toDateString())
            ->firstOrFail();
        $employeeShiftRecord->lunch_ended = $now;
        $employeeShiftRecord->save();

        return redirect()->back();
    }

    public function ensureShiftRecordExists($userId)
{
    $userTimezone = Auth::user()->timezone;
    $today = Carbon::now($userTimezone)->toDateString(); // Retrieve today's date in user's timezone

    // Fetch or create the shift record for today
    $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
        'employee_id' => $userId,
        'shift_date' => $today,
    ]);

    // If the record doesn't exist, create a new one with default values
    if (!$employeeShiftRecord->exists) {
        // Fetch the user's default shift ID from the employee_records table
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->firstOrFail();
        $defaultShiftId = $employeeRecord->default_shift_id;

        $employeeShiftRecord->shift_id = $defaultShiftId;
        $employeeShiftRecord->save();
    }
}

}
