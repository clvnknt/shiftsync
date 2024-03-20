<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;

class EndLunchJob implements ShouldQueue
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
        $user = Auth::user();
        $now = Carbon::now($user->timezone)->toDateTimeString();

        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $this->userId)
            ->whereDate('shift_date', Carbon::now()->timezone($user->timezone)->toDateString())
            ->firstOrFail();

        $employeeShiftRecord->end_lunch = $now;
        $employeeShiftRecord->save();
    }
}
