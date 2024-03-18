<?php

namespace App\Jobs;

use App\Models\EmployeeShiftRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class FetchShiftRecordsInDateRangeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $startDate;
    protected $endDate;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct($userId, $startDate, $endDate)
    {
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();

        $shiftRecords = EmployeeShiftRecord::where('employee_id', $this->userId)
            ->whereBetween('shift_date', [$startDate, $endDate])
            ->get();

        // You can dispatch an event or perform additional actions with $shiftRecords if needed
    }
}
