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
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '16:00:00',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Night Shift',
                'start_shift_time' => '22:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '02:00:00',
                'end_lunch_time' => '03:00:00',
                'end_shift_time' => '06:00:00',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Evening Shift',
                'start_shift_time' => '16:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '18:00:00',
                'end_lunch_time' => '19:00:00',
                'end_shift_time' => '00:00:00',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Early Morning Shift',
                'start_shift_time' => '04:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '08:00:00',
                'end_lunch_time' => '09:00:00',
                'end_shift_time' => '12:00:00',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shift_name' => 'Late Night Shift',
                'start_shift_time' => '00:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '03:00:00',
                'end_lunch_time' => '04:00:00',
                'end_shift_time' => '08:00:00',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the shifts into the database
        DB::table('shifts')->insert($shifts);
    }
}

