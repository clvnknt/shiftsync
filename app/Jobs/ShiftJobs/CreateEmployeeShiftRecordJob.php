<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeRecord;
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
        $employeeTimezone = $this->employeeRecord->timezone;
        $currentDate = Carbon::now($employeeTimezone)->toDateString();

        $shiftRecord = $this->employeeRecord->employeeShiftRecords()
        ->where('shift_date', $currentDate)
        ->first();

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