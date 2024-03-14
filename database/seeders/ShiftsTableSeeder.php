<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed multiple shifts
        $shifts = [
            [
                'shift_name' => 'Day Shift',
                'shift_start_time' => '08:00:00',
                'shift_end_time' => '16:00:00',
                'lunch_start_time' => '12:00:00',
                'lunch_end_time' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Night Shift',
                'shift_start_time' => '22:00:00',
                'shift_end_time' => '06:00:00',
                'lunch_start_time' => '02:00:00',
                'lunch_end_time' => '03:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Evening Shift',
                'shift_start_time' => '16:00:00',
                'shift_end_time' => '00:00:00',
                'lunch_start_time' => '18:00:00',
                'lunch_end_time' => '19:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Early Morning Shift',
                'shift_start_time' => '04:00:00',
                'shift_end_time' => '12:00:00',
                'lunch_start_time' => '08:00:00',
                'lunch_end_time' => '09:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Late Night Shift',
                'shift_start_time' => '00:00:00',
                'shift_end_time' => '08:00:00',
                'lunch_start_time' => '03:00:00',
                'lunch_end_time' => '04:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more shifts as needed
        ];

        // Insert the shifts into the database
        DB::table('shifts')->insert($shifts);
    }
}