<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ShiftJobs\{
    StartShiftJob,
    StartLunchJob,
    EndLunchJob,
    EndShiftJob
};

class ShiftController extends Controller
{
    public function startShift(Request $request)
    {
        return $this->dispatchJobAndRedirect(StartShiftJob::class, $request->input('employeeRecordId'));
    }

    public function startLunch(Request $request)
    {
        return $this->dispatchJobAndRedirect(StartLunchJob::class, $request->input('employeeRecordId'));
    }
    
    public function endLunch(Request $request)
    {
        return $this->dispatchJobAndRedirect(EndLunchJob::class, $request->input('employeeRecordId'));
    }
    
    public function endShift(Request $request)
    {
        return $this->dispatchJobAndRedirect(EndShiftJob::class, $request->input('employeeRecordId'));
    }
    
    protected function dispatchJobAndRedirect($jobClass, $employeeRecordId)
    {
        dispatch(new $jobClass($employeeRecordId));
        return redirect()->route('inout');
    }
}