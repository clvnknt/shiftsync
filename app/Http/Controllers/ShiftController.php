<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ShiftJobs\StartShiftJob;
use App\Jobs\ShiftJobs\StartLunchJob;
use App\Jobs\ShiftJobs\EndLunchJob;
use App\Jobs\ShiftJobs\EndShiftJob;

class ShiftController extends Controller
{
    public function startShift(Request $request)
    {
        StartShiftJob::dispatch();
        return redirect()->route('inout');
    }

    public function startLunch(Request $request)
    {
        StartLunchJob::dispatch();
        return redirect()->route('inout');
    }

    public function endLunch(Request $request)
    {
        EndLunchJob::dispatch();
        return redirect()->route('inout');
    }

    public function endShift(Request $request)
    {
        EndShiftJob::dispatch();
        return redirect()->route('inout');
    }
}
