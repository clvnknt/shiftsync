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
                // Convert timestamps to employee's timezone
                $employeeTimezone = $record->employeeRecord->employee_timezone;
                $startShift = Carbon::parse($record->start_shift)->setTimezone($employeeTimezone);
                $endLunch = Carbon::parse($record->end_lunch)->setTimezone($employeeTimezone);
    
                // Get the shift schedule timezone
                $shiftTimezone = $record->employeeAssignedShift->shiftSchedule->shift_timezone;
    
                // Convert shift schedule times to Carbon instances in the same timezone as the employee
                $startShiftTime = Carbon::createFromTimeString($record->employeeAssignedShift->shiftSchedule->start_shift_time, $shiftTimezone);
                $endLunchTime = Carbon::createFromTimeString($record->employeeAssignedShift->shiftSchedule->end_lunch_time, $shiftTimezone);
    
                // Calculate lateness for start shift (formula: actual - expected)
                $latenessStartShift = max(0, $startShift->diffInMinutes($startShiftTime));
    
                // Calculate lateness for end lunch (formula: actual - expected)
                $latenessEndLunch = max(0, $endLunch->diffInMinutes($endLunchTime));
    
                // If end lunch is earlier than expected, set lateness hours to 0
                if ($endLunch < $endLunchTime) {
                    $latenessEndLunch = 0;
                }
    
                // Store the lateness information in the tardiness table
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
