<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeShiftRecord;

class StartLunchJob implements ShouldQueue
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

        if ($shiftRecord && $shiftRecord->start_shift && !$shiftRecord->start_lunch) {
            $shiftRecord->start_lunch = now();
            $shiftRecord->save();
        }
    }
}