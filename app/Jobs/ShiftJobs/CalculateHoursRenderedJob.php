<?php

namespace App\Jobs\ShiftJobs;

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

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve all employee shift records
        $shiftRecords = EmployeeShiftRecord::all();

        // Iterate over each shift record
        foreach ($shiftRecords as $shiftRecord) {
            // Ensure all necessary timestamps are set
            if ($shiftRecord->start_shift && $shiftRecord->end_shift && $shiftRecord->start_lunch && $shiftRecord->end_lunch) {
                // Calculate shift duration
                $startShift = Carbon::parse($shiftRecord->start_shift);
                $endShift = Carbon::parse($shiftRecord->end_shift);
                $startLunch = Carbon::parse($shiftRecord->start_lunch);
                $endLunch = Carbon::parse($shiftRecord->end_lunch);

                // Calculate total shift duration (excluding lunch break)
                $totalShiftDuration = $startShift->diffInMinutes($endShift);

                // Calculate lunch break duration
                $lunchBreakDuration = $startLunch->diffInMinutes($endLunch);

                // Subtract lunch break duration from total shift duration
                $hoursRendered = max(0, ($totalShiftDuration - $lunchBreakDuration) / 60); // Calculate hours rendered

                // Update hours_rendered column
                $shiftRecord->hours_rendered = $hoursRendered;
                $shiftRecord->save();
            }
        }
    }
}