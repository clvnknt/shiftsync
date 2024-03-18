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

class EnsureUserShiftRecordExistsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        $userTimezone = Auth::user()->timezone;
        $today = Carbon::now($userTimezone)->toDateString();

        $employeeShiftRecord = EmployeeShiftRecord::firstOrNew([
            'employee_id' => $this->userId,
            'shift_date' => $today,
        ]);

        if (!$employeeShiftRecord->exists) {
            $employeeShiftRecord->shift_id = $this->getDefaultShiftId($this->userId);
            $employeeShiftRecord->save();
        }
    }

    private function getDefaultShiftId($userId)
    {
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->firstOrFail();
        return $employeeRecord->default_shift_id;
    }
}
