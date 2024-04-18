<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeRecord;
use App\Models\EmployeeAssignedShift;
use App\Models\ShiftSchedule;

class AssignedShiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employee records
        $employees = EmployeeRecord::all();

        // Assign shifts to each employee based on their timezone
        foreach ($employees as $employee) {
            // Get the shift schedules based on the employee's timezone
            $shiftSchedules = ShiftSchedule::where('shift_timezone', $employee->employee_timezone)->get();

            // Assign shift schedules to the employee
            foreach ($shiftSchedules as $shiftSchedule) {
                EmployeeAssignedShift::create([
                    'employee_record_id' => $employee->id,
                    'shift_schedule_id' => $shiftSchedule->id,
                    'is_active' => true, // Assuming all shifts are active
                ]);
            }
        }
    }
}
