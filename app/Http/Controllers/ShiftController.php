<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Jobs\ShiftJobs\StartShiftJob;
use App\Jobs\ShiftJobs\StartLunchJob;
use App\Jobs\ShiftJobs\EndLunchJob;
use App\Jobs\ShiftJobs\EndShiftJob;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class ShiftController extends Controller
{
    public function startShift(Request $request)
    {
        // Dispatch the StartShiftJob
        StartShiftJob::dispatch();

        // Redirect to the 'inout' route
        return redirect()->route('inout');
    }
    
    public function startLunch(Request $request)
    {
        // Dispatch the StartLunchJob
        StartLunchJob::dispatch();

        // Redirect to the 'inout' route
        return redirect()->route('inout');
    }
    
    public function endLunch(Request $request)
    {
        // Dispatch the EndLunchJob
        EndLunchJob::dispatch();

        // Redirect to the 'inout' route
        return redirect()->route('inout');
    }
    
    public function endShift(Request $request)
    {
        // Dispatch the EndShiftJob
        EndShiftJob::dispatch();

        // Redirect to the 'inout' route
        return redirect()->route('inout');
    }    
}