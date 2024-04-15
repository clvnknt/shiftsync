<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\Shift;

class TimesheetController extends Controller
{
    public function showTimesheet()
    {

     return view('employees.timesheet');
    }
}