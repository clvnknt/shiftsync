<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeRecord;
use App\Models\Shift;
use App\Models\EmployeeShiftPivot;

class EmployeeShiftPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve all existing employees and the first two shifts created by ShiftsSeeder
        $employees = EmployeeRecord::all();
        $shifts = Shift::all()->take(2); // Take the first two shifts

        // Create pivot entries for each combination of employee and shift
        foreach ($employees as $employee) {
            foreach ($shifts as $index => $shift) {
                // Create pivot entry for the employee and shift
                $isActive = $index == 0 ? true : false;
                EmployeeShiftPivot::create([
                    'employee_record_id' => $employee->id,
                    'shift_id' => $shift->id,
                    'is_active' => $isActive,
                ]);
            }
        }
    }
}