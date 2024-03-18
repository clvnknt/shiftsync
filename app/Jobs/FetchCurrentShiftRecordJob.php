<?php

namespace App\Jobs;

use App\Models\EmployeeShiftRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchCurrentShiftRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $currentShiftRecord = EmployeeShiftRecord::where('employee_id', $this->userId)
            ->whereDate('shift_date', today())
            ->first();

        // You can dispatch an event or perform additional actions with $currentShiftRecord if needed
    }
}
