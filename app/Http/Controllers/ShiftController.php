<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeShiftRecord;
use Illuminate\Routing\Controller;
use App\Jobs\ShiftJobs\StartShiftJob;
use App\Jobs\ShiftJobs\StartLunchJob;
use App\Jobs\ShiftJobs\EndLunchJob;
use App\Jobs\ShiftJobs\EndShiftJob;
use App\Jobs\TimesheetJobs\CalculateHoursRenderedJob;
use App\Jobs\TimesheetJobs\CalculateTardinessUndertime;


class ShiftController extends Controller
{
    private function dispatchAndRedirect(Request $request, $job, $successMessage)
    {
        $shiftRecordId = $request->input('employeeRecordId');
        dispatch(new $job($shiftRecordId));
        return redirect()->route('inout')->with('success', $successMessage);
    }

    public function startShift(Request $request)
    {
        return $this->dispatchAndRedirect($request, StartShiftJob::class, 'Start Shift logged successfully.');
    }

    public function startLunch(Request $request)
    {
        return $this->dispatchAndRedirect($request, StartLunchJob::class, 'Start Lunch logged successfully.');
    }

    public function endLunch(Request $request)
    {
        return $this->dispatchAndRedirect($request, EndLunchJob::class, 'End Lunch logged successfully.');
    }

    public function endShift(Request $request)
    {
        $response = $this->dispatchAndRedirect($request, EndShiftJob::class, 'End Shift logged successfully.');
    
        // After ending the shift, dispatch CalculateHoursRenderedJob for the current employee record
        $employeeRecordId = $request->input('employeeRecordId');
        dispatch(new CalculateHoursRenderedJob($employeeRecordId));
    
        // Dispatch CalculateTardinessUndertime job for the current employee record
        dispatch(new CalculateTardinessUndertime($employeeRecordId));
    
        return $response;
    }
}