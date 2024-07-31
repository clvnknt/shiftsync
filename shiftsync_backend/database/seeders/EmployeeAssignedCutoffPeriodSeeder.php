<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeAssignedCutoffPeriod;
use App\Models\CutoffPeriod;
use App\Models\EmployeeRecord;
use Carbon\Carbon;

class EmployeeAssignedCutoffPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all employees
        $employees = EmployeeRecord::all();

        // Loop through each employee
        foreach ($employees as $employee) {
            // Get the employee's timezone
            $employeeTimezone = $employee->employee_timezone;

            // Get all existing cutoff periods for the employee's timezone
            $cutoffPeriods = CutoffPeriod::where('cutoff_timezone', $employeeTimezone)->get();

            // Assign existing cutoff periods to the employee
            foreach ($cutoffPeriods as $cutoffPeriod) {
                $employee->assignedCutoffPeriods()->create([
                    'cutoff_period_id' => $cutoffPeriod->id,
                    'employee_record_id' => $employee->id,
                ]);
            }
        }
    }
}
