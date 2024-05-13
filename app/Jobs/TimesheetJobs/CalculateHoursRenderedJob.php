<?php

namespace App\Jobs\TimesheetJobs;

use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeAssignedShift;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateHoursRenderedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeRecordId;

    /**
     * Create a new job instance.
     *
     * @param int $employeeRecordId
     * @return void
     */
    public function __construct($employeeRecordId)
    {
        $this->employeeRecordId = $employeeRecordId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve the specific employee shift record
        $shiftRecord = EmployeeShiftRecord::find($this->employeeRecordId);

        // Ensure all necessary timestamps are set
        if ($shiftRecord && $shiftRecord->start_shift && $shiftRecord->end_shift && $shiftRecord->start_lunch && $shiftRecord->end_lunch) {
            // Retrieve the associated employee assigned shift
            $assignedShift = $shiftRecord->employeeAssignedShift;

            // Retrieve the associated shift schedule
            $shiftSchedule = $assignedShift->shiftSchedule;

            // Convert lunch start time and end lunch time to Carbon instances for easy manipulation
            $startLunch = Carbon::createFromFormat('H:i:s', $shiftSchedule->lunch_start_time);
            $endLunch = Carbon::createFromFormat('H:i:s', $shiftSchedule->end_lunch_time);

            // Calculate total shift duration (excluding lunch break) in minutes
            $startShift = Carbon::parse($shiftRecord->start_shift);
            $endShift = Carbon::parse($shiftRecord->end_shift);
            $totalShiftDurationMinutes = $startShift->diffInMinutes($endShift);

            // Calculate lunch break duration in minutes
            $lunchBreakDurationMinutes = $endLunch->diffInMinutes($startLunch);

            // Convert total shift duration to hours, including decimal fractions
            $totalShiftDurationHours = $totalShiftDurationMinutes / 60;

            // Subtract lunch break duration from total shift duration if total shift duration is greater than lunch break duration
            if ($totalShiftDurationMinutes > $lunchBreakDurationMinutes) {
                $hoursRendered = max(0, $totalShiftDurationHours - ($lunchBreakDurationMinutes / 60));
            } else {
                $hoursRendered = 0; // Set hours rendered to 0 if lunch break duration exceeds total shift duration
            }

            // Update hours_rendered column
            $shiftRecord->hours_rendered = $hoursRendered;
            $shiftRecord->save();

            //Hours Rendered = (Total Shift Duration (Minutes) - Lunch Break Duration (Minutes)) / 60
            //if Total Shift Duration (Minutes) > Lunch Break Duration (Minutes); Otherwise, Hours Rendered = 0.
        }
    }
}
