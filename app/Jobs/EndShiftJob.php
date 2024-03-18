<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;


class EndShiftJob implements ShouldQueue
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
        $now = Carbon::now(Auth::user()->timezone)->toDateTimeString();

        $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $this->userId)
            ->where('shift_date', Carbon::now()->toDateString())
            ->firstOrFail();

        $employeeShiftRecord->shift_ended = $now;
        $employeeShiftRecord->save();
    }
}
