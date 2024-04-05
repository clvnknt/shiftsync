<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeRecord;
use App\Models\Shift;
use Carbon\Carbon;

class CreateEmployeeShiftRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeRecord;

    public function __construct(EmployeeRecord $employeeRecord)
    {
        $this->employeeRecord = $employeeRecord;
    }

    public function handle(): void
    {
        // Retrieve the employee's assigned shift
        $assignedShift = Shift::find($this->employeeRecord->shift_id);

        if ($assignedShift) {
            // Retrieve the current date using the assigned shift's timezone
            $employeeTimezone = $assignedShift->timezone;
            $currentDate = Carbon::now($employeeTimezone)->toDateString();
        } else {
            // Fallback to the employee's timezone if no assigned shift found
            $employeeTimezone = $this->employeeRecord->timezone;
            $currentDate = Carbon::now($employeeTimezone)->toDateString();
        }

        // Check if a shift record already exists for the current date
        $shiftRecord = $this->employeeRecord->employeeShiftRecords()
            ->where('shift_date', $currentDate)
            ->first();

        // If no shift record exists, create a new one
        if (!$shiftRecord) {
            $this->employeeRecord->employeeShiftRecords()->create([
                'shift_date' => $currentDate,
                'start_shift' => null,
                'start_lunch' => null,
                'end_lunch' => null,
                'end_shift' => null,
            ]);
        }
    }
}