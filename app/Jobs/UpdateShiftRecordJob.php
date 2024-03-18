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
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userTimezone = Auth::user()->timezone;
        $today = Carbon::now($userTimezone)->toDateString();

        $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->firstOrFail();
        $defaultShiftId = $employeeRecord->default_shift_id;

        $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
            'employee_id' => $this->userId,
            'shift_date' => $today,
        ]);

        if ($employeeShiftRecord->exists && $employeeShiftRecord->shift_date != $today) {
            $employeeShiftRecord->fill([
                'shift_id' => $defaultShiftId,
                'shift_started' => null,
                'lunch_started' => null,
                'lunch_ended' => null,
                'shift_ended' => null,
            ]);
        } elseif ($employeeShiftRecord->exists && $employeeShiftRecord->shift_id != $defaultShiftId) {
            $employeeShiftRecord->shift_id = $defaultShiftId;
        }

        $employeeShiftRecord->save();
    }
}
