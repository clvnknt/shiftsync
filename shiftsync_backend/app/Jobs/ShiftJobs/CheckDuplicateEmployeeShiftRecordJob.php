<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;

class CheckDuplicateEmployeeShiftRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeRecord;

    /**
     * Create a new job instance.
     *
     * @param EmployeeRecord $employeeRecord
     */
    public function __construct(EmployeeRecord $employeeRecord)
    {
        $this->employeeRecord = $employeeRecord;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve the timezone of the employee
        $employeeTimezone = $this->employeeRecord->timezone;

        // Calculate today's date based on the employee's timezone
        $currentDate = Carbon::now($employeeTimezone)->toDateString();

        // Retrieve the current shift records for the employee and today's date
        $shiftRecords = $this->employeeRecord->employeeShiftRecords()
            ->where('shift_date', $currentDate)
            ->get();

        // If multiple shift records exist for today, find and delete duplicate records
        if ($shiftRecords->count() > 1) {
            $uniqueAssignedShiftIds = $shiftRecords->pluck('employee_assigned_shift_id')->unique()->values();

            foreach ($uniqueAssignedShiftIds as $assignedShiftId) {
                $recordsWithAssignedShiftId = $shiftRecords->where('employee_assigned_shift_id', $assignedShiftId);

                if ($recordsWithAssignedShiftId->count() > 1) {
                    // Keep the first record and delete the rest
                    $recordsWithAssignedShiftId->slice(1)->each(function ($record) {
                        $record->delete();
                    });
                }
            }
        }
    }
}