<?php

namespace App\Jobs\TimesheetJobs;

use App\Models\EmployeeShiftRecord;
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

        if (!$shiftRecord) {
            return; // Exit if shift record is not found
        }

        // Ensure all necessary timestamps are set
        if ($this->timestampsAreSet($shiftRecord)) {
            // Start and end shift times
            $startShift = Carbon::parse($shiftRecord->start_shift);
            $endShift = Carbon::parse($shiftRecord->end_shift);

            // Start and end lunch times
            $startLunch = Carbon::parse($shiftRecord->start_lunch);
            $endLunch = Carbon::parse($shiftRecord->end_lunch);

            // Calculate the time rendered from start shift to start lunch
            $morningWorkMinutes = $startShift->diffInMinutes($startLunch);

            // Calculate the time rendered from end lunch to end shift
            $afternoonWorkMinutes = $endLunch->diffInMinutes($endShift);

            // Sum the work minutes
            $totalWorkMinutes = $morningWorkMinutes + $afternoonWorkMinutes;

            // Convert total work minutes to hours and round to two decimal places
            $hoursRendered = round($totalWorkMinutes / 60, 2);

            // Update hours_rendered column
            $shiftRecord->hours_rendered = $hoursRendered;
            $shiftRecord->save();
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
