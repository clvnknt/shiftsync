<?php

namespace App\Jobs\ShiftJobs;

use App\Models\EmployeeShiftRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartShiftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $shiftRecordId;

    public function __construct($shiftRecordId)
    {
        $this->shiftRecordId = $shiftRecordId;
    }

    public function handle()
    {
        $shiftRecord = EmployeeShiftRecord::find($this->shiftRecordId);

        if ($shiftRecord && !$shiftRecord->start_shift) {
            $shiftRecord->start_shift = now();
            $shiftRecord->save();
        }
    }
}