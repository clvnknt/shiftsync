<?php

namespace App\Jobs\TimesheetJobs;

use App\Models\EmployeeShiftRecord;
use App\Models\Tardiness;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateTardiness implements ShouldQueue
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
        // Retrieve employee shift records for calculation
        $shiftRecords = EmployeeShiftRecord::where('id', $this->employeeRecordId)->get();

        // Loop through each shift record for calculation
        foreach ($shiftRecords as $record) {
            // Ensure that all necessary timestamps are available
            if ($record->start_shift && $record->end_lunch &&
                $record->employeeAssignedShift && $record->employeeAssignedShift->shiftSchedule) {

                // Get the employee's timezone
                $employeeTimezone = $record->employeeRecord->employee_timezone;

                // Convert the recorded times to the employee's timezone
                $startShift = Carbon::parse($record->start_shift)->setTimezone($employeeTimezone);
                $endLunch = Carbon::parse($record->end_lunch)->setTimezone($employeeTimezone);

                // Get the shift schedule timezone
                $shiftTimezone = $record->employeeAssignedShift->shiftSchedule->shift_timezone;

                // Convert shift schedule times (stored in UTC) to the employee's timezone
                $startShiftTime = Carbon::parse($record->employeeAssignedShift->shiftSchedule->start_shift_time, 'UTC')->setTimezone($employeeTimezone);
                $endLunchTime = Carbon::parse($record->employeeAssignedShift->shiftSchedule->end_lunch_time, 'UTC')->setTimezone($employeeTimezone);

                // Calculate lateness for start shift (formula: actual - expected)
                $latenessStartShift = max(0, $startShift->diffInMinutes($startShiftTime));
                if ($startShift->lessThanOrEqualTo($startShiftTime)) {
                    $latenessStartShift = 0;
                }

                // Calculate lateness for end lunch (formula: actual - expected)
                $latenessEndLunch = max(0, $endLunch->diffInMinutes($endLunchTime));
                if ($endLunch->lessThanOrEqualTo($endLunchTime)) {
                    $latenessEndLunch = 0;
                }

                // Store the lateness information in the Tardiness table
                Tardiness::create([
                    'employee_shift_record_id' => $record->id,
                    'is_late_start_shift' => $latenessStartShift > 0,
                    'hours_late_start_shift' => $latenessStartShift / 60,
                    'is_late_end_lunch' => $latenessEndLunch > 0,
                    'hours_late_end_lunch' => $latenessEndLunch / 60,
                ]);
            }
        }
    }
}
