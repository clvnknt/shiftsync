<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeRecord;
use App\Models\Shift;

class EmployeeShiftPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some employee records and shifts from your database
        $employees = EmployeeRecord::all();
        $shifts = Shift::all();
        
        // Loop through the employee records and assign them to shifts
        foreach ($employees as $employee) {
            // Assign each employee to one or more shifts (You need to adjust this logic based on your requirements)
            $employee->shifts()->attach($shifts->random(rand(1, 2))->pluck('id'), ['employee_record_id' => $employee->id]);
        }
    }
}
