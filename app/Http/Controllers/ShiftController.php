<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function startShift(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Find the associated employee record
    $employeeRecord = EmployeeRecord::where('user_id', $user->id)->first();

    // Check if there's an existing shift record for today
    $existingShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
        ->whereDate('shift_date', Carbon::today())
        ->first();

    if ($existingShiftRecord) {
        return response()->json(['message' => 'Shift already started for today'], 400);
    }

    // Create a new employee shift record
    $shiftRecord = new EmployeeShiftRecord();
    $shiftRecord->employee_record_id = $employeeRecord->id;
    $shiftRecord->shift_date = Carbon::now()->toDateString(); // Set shift date to today
    $shiftRecord->start_shift = Carbon::now(); // Set start time to current time
    $shiftRecord->save();

    return response()->json(['message' => 'Shift started successfully'], 200);
}


    public function endShift(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the associated employee record
        $employeeRecord = EmployeeRecord::where('user_id', $user->id)->first();

        // Find the latest shift record for the employee
        $shiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Update the end shift time
        $shiftRecord->end_shift = Carbon::now(); // Set end time to current time
        $shiftRecord->save();

        return response()->json(['message' => 'Shift ended successfully'], 200);
    }

    public function startLunch(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the associated employee record
        $employeeRecord = EmployeeRecord::where('user_id', $user->id)->first();

        // Find the latest shift record for the employee
        $shiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Update the start lunch time
        $shiftRecord->start_lunch = Carbon::now(); // Set start lunch time to current time
        $shiftRecord->save();

        return response()->json(['message' => 'Lunch break started successfully'], 200);
    }

    public function endLunch(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the associated employee record
        $employeeRecord = EmployeeRecord::where('user_id', $user->id)->first();

        // Find the latest shift record for the employee
        $shiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Update the end lunch time
        $shiftRecord->end_lunch = Carbon::now(); // Set end lunch time to current time
        $shiftRecord->save();

        return response()->json(['message' => 'Lunch break ended successfully'], 200);
    }
}
