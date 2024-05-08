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

class CalculateTardinessUndertime implements ShouldQueue
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
                // Convert timestamps to employee's timezone
                $employeeTimezone = $record->employeeRecord->employee_timezone;
                $startShift = Carbon::parse($record->start_shift)->setTimezone($employeeTimezone);
                $endLunch = Carbon::parse($record->end_lunch)->setTimezone($employeeTimezone);

                // Get the start shift time from the employee's assigned shift schedule (without converting to employee timezone)
                $startShiftTime = Carbon::parse($record->employeeAssignedShift->shiftSchedule->start_shift_time);

                // Calculate lateness for start shift (formula: actual - expected)
                $latenessStartShift = max(0, $startShift->diffInMinutes($startShiftTime));

                // Get the end lunch time from the employee's assigned shift schedule (without converting to employee timezone)
                $endLunchTime = Carbon::parse($record->employeeAssignedShift->shiftSchedule->end_lunch_time);

                // Calculate lateness for end lunch to end shift (formula: actual - expected)
                $latenessEndLunchToEndShift = max(0, $endLunch->diffInMinutes($endLunchTime));

                // Store the lateness information in the tardiness table
                Tardiness::create([
                    'employee_shift_record_id' => $record->id,
                    'is_late_start_shift' => $latenessStartShift > 0,
                    'hours_late_start_shift' => $latenessStartShift / 60, // Convert minutes to hours
                    'is_late_end_lunch' => $latenessEndLunchToEndShift > 0,
                    'hours_late_end_lunch' => $latenessEndLunchToEndShift / 60, // Convert minutes to hours
                ]);
            }
        }
    }
}
