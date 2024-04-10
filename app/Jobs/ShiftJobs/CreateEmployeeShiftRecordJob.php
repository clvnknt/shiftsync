<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftPivot;
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
    // Retrieve the current date
    $currentDate = Carbon::today();

    // Retrieve all active shift pivots for the current date
    $shiftPivots = EmployeeShiftPivot::where('is_active', true)
        ->whereDate('shift_date', $currentDate)
        ->get();

    // Iterate through each active shift pivot
    foreach ($shiftPivots as $pivot) {
        // Add null check before accessing is_active property
        if ($pivot && $pivot->is_active) {
            // Create a new shift record for the employee
            $this->employeeRecord->employeeShiftRecords()->create([
                'employee_shift_pivot_id' => $pivot->id,
                'shift_date' => $currentDate,
                'start_shift' => null,
                'start_lunch' => null,
                'end_lunch' => null,
                'end_shift' => null,
            ]);
        }
    }
}
}