<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class EmployeeShiftRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_shift_records')->insert([
            'employee_id' => 1, // Assuming employee with ID 1 exists
            'shift_id' => 1, // Assuming shift with ID 1 exists
            'shift_date' => '2024-03-13',
            'shift_started' => '2024-03-13 08:00:00',
            'lunch_started' => '2024-03-13 12:00:00',
            'lunch_ended' => '2024-03-13 13:00:00',
            'shift_ended' => '2024-03-13 16:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
