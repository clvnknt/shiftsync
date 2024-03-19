<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class UpdateShiftRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userTimezone = Auth::user()->timezone;
        $now = Carbon::now($userTimezone);

        $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->firstOrFail();
        $defaultShiftId = $employeeRecord->default_shift_id;

        $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
            'employee_id' => $this->userId,
            'shift_date' => $now->toDateString(),
        ]);

        if ($employeeShiftRecord->exists && $employeeShiftRecord->shift_date != $now->toDateString()) {
            $employeeShiftRecord->fill([
                'shift_id' => $defaultShiftId,
                'start_shift' => $now->toTimeString(),
                'start_lunch' => null,
                'end_lunch' => null,
                'end_shift' => null,
            ]);
        } elseif ($employeeShiftRecord->exists && $employeeShiftRecord->shift_id != $defaultShiftId) {
            $employeeShiftRecord->shift_id = $defaultShiftId;
        }

        $employeeShiftRecord->save();
    }
}