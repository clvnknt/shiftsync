<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

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

        // Calculate lateness for each shift event
        foreach ($employeeShiftRecords as $shiftRecord) {
            // Check if the shift started and the scheduled shift start time are not null before calculating lateness
            if ($shiftRecord->shift_started && $defaultShift && $defaultShift->shift_start_time) {
                // Convert shift start times to DateTime objects for comparison
                $actualStartTime = \DateTime::createFromFormat('H:i:s', $shiftRecord->shift_started->format('H:i:s'));
                $defaultStartTime = \DateTime::createFromFormat('H:i:s', $defaultShift->shift_start_time);

                // Calculate the difference in minutes
                $latenessInMinutes = $actualStartTime->getTimestamp() - $defaultStartTime->getTimestamp();

                // If the difference is positive, the employee is late
                if ($latenessInMinutes > 0) {
                    // Convert the lateness to HH:MM format
                    $hours = floor($latenessInMinutes / 3600);
                    $minutes = floor(($latenessInMinutes - ($hours * 3600)) / 60);
                    $lateness = sprintf("%02d:%02d", $hours, $minutes);

                    // Assign the calculated lateness to the record
                    $shiftRecord->ss_lateness = $lateness;
                } else {
                    // No lateness
                    $shiftRecord->ss_lateness = '00:00';
                }
            } else {
                // No lateness
                $shiftRecord->ss_lateness = '00:00';
            }
        }

        // Pass data to the view and return it
        return view('employees.timesheet', [
            'user' => User::find($userId),
            'employeeRecord' => $employeeRecord,
            'defaultShift' => $defaultShift,
            'todayShift' => $todayShift,
            'employeeShiftRecords' => $employeeShiftRecords, // Pass employee shift records to the view
        ]);
    }
}
