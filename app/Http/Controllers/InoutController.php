<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InoutController extends Controller
{
    public function showInout(Request $request)
    {
        // Retrieve the current user's employee record
        $employeeRecord = Auth::user()->employeeRecord;

        // Retrieve the default shift for the employee
        $defaultShift = $employeeRecord->shift;

        // Retrieve the shift record from the database for the current date
        $employeeShiftRecord = $employeeRecord->employeeShiftRecords()
            ->where('shift_date', now()->toDateString())
            ->first();

        // Check if the current shift has ended more than 5 hours ago
        if ($employeeShiftRecord && $employeeShiftRecord->end_shift) {
            $currentShiftEndTime = Carbon::parse($employeeShiftRecord->end_shift);
            if ($currentShiftEndTime->addHours(5)->isPast()) {
                // Update the current shift to the next one
                $nextShiftDate = Carbon::parse($employeeShiftRecord->shift_date)->addDay();
                // Retrieve the next shift record from the database for the next date
                $employeeShiftRecord = $employeeRecord->employeeShiftRecords()
                    ->where('shift_date', $nextShiftDate->toDateString())
                    ->first();
            }
        }

        // Pass the $employeeShiftRecord, $employeeRecord, and $defaultShift variables to the view
        return view('employees.inout', compact('employeeShiftRecord', 'employeeRecord', 'defaultShift'));
    }   
}
