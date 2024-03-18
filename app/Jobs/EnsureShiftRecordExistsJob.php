<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class EnsureShiftRecordExistsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $userId;

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
        $today = Carbon::now($userTimezone)->toDateString();

        $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
            'employee_id' => $this->userId,
            'shift_date' => $today,
        ]);

        if (!$employeeShiftRecord->exists) {
            $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->firstOrFail();
            $defaultShiftId = $employeeRecord->default_shift_id;

            $employeeShiftRecord->shift_id = $defaultShiftId;
            $employeeShiftRecord->save();
        }
    }
}
