<?php

namespace App\Jobs\TimesheetJobs;

use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        try {
            // Retrieve the specific employee shift record
            $shiftRecord = EmployeeShiftRecord::with('employeeAssignedShift.shiftSchedule')->find($this->employeeRecordId);
            $assignedShift = $shiftRecord->employeeAssignedShift;

            if (!$shiftRecord) {
                return; // Exit if shift record is not found
            }

            // Ensure all necessary timestamps are set
            if ($this->timestampsAreSet($shiftRecord)) {
                // Start and end shift times
                $startShift = Carbon::parse($shiftRecord->start_shift);
                $endShift = Carbon::parse($shiftRecord->end_shift);

                // Start and end lunch times based on assigned shift
                $startLunch = Carbon::parse($shiftRecord->start_lunch);
                $endLunch = Carbon::parse($shiftRecord->end_lunch);

                // Retrieve the default start lunch time from the employee's assigned shift schedule
                $defaultStartLunch = Carbon::parse($assignedShift->shiftSchedule->lunch_start_time);

                // Calculate the time rendered from start shift to start lunch
                $morningWorkMinutes = $startShift->diffInMinutes($startLunch);

                // Check if the actual start lunch time is after the default start lunch time
                if ($startLunch->greaterThan($defaultStartLunch)) {
                    // Exclude the minutes between the default start lunch time and the actual start lunch time from the calculation
                    $morningWorkMinutes -= $defaultStartLunch->diffInMinutes($startLunch);
                }

                // Calculate the time rendered from end lunch to end shift
                $afternoonWorkMinutes = $endLunch->diffInMinutes($endShift);

                // Sum the work minutes
                $totalWorkMinutes = $morningWorkMinutes + $afternoonWorkMinutes;

                // Ensure that hours rendered is not negative
                $hoursRendered = max(round($totalWorkMinutes / 60, 2), 0);

                // Update hours_rendered column
                $shiftRecord->hours_rendered = $hoursRendered;
                $shiftRecord->save();
            }
        } catch (\Exception $exception) {
            // Log any exceptions that occur during job execution
            Log::error('Error occurred while calculating hours rendered: ' . $exception->getMessage());
        }
    }

    /**
     * Check if all necessary timestamps are set.
     *
     * @param \App\Models\EmployeeShiftRecord $shiftRecord
     * @return bool
     */
    private function timestampsAreSet(EmployeeShiftRecord $shiftRecord): bool
    {
        return $shiftRecord->start_shift && $shiftRecord->end_shift && $shiftRecord->start_lunch && $shiftRecord->end_lunch;
    }
}
