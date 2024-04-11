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

        // Get two shift schedules
        $shiftSchedules = ShiftSchedule::take(2)->get();

        // Assign two shifts to each employee
        foreach ($employees as $employee) {
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
