<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ShiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shifts')->insert([
            [
                'shift_name' => 'Morning Shift',
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '08:15:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '16:00:00',
                'break_name' => 'Morning Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Afternoon Shift',
                'start_shift_time' => '13:00:00',
                'shift_start_grace_period' => '13:15:00',
                'lunch_start_time' => '17:00:00',
                'end_lunch_time' => '18:00:00',
                'end_shift_time' => '21:00:00',
                'break_name' => 'Afternoon Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Night Shift',
                'start_shift_time' => '21:00:00',
                'shift_start_grace_period' => '21:15:00',
                'lunch_start_time' => '01:00:00',
                'end_lunch_time' => '02:00:00',
                'end_shift_time' => '05:00:00',
                'break_name' => 'Night Break',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
            ],
            [
                'shift_name' => 'Evening Shift',
                'start_shift_time' => '16:00:00',
                'shift_start_grace_period' => '16:15:00',
                'lunch_start_time' => '20:00:00',
                'end_lunch_time' => '21:00:00',
                'end_shift_time' => '00:00:00',
                'break_name' => 'Evening Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Late Night Shift',
                'start_shift_time' => '22:00:00',
                'shift_start_grace_period' => '22:15:00',
                'lunch_start_time' => '02:00:00',
                'end_lunch_time' => '03:00:00',
                'end_shift_time' => '06:00:00',
                'break_name' => 'Late Night Break',
                'break_frequency' => 1,
                'break_duration' => '00:30:00',
            ],
            [
                'shift_name' => 'Early Morning Shift',
                'start_shift_time' => '05:00:00',
                'shift_start_grace_period' => '05:15:00',
                'lunch_start_time' => '09:00:00',
                'end_lunch_time' => '10:00:00',
                'end_shift_time' => '13:00:00',
                'break_name' => 'Early Morning Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Mid Morning Shift',
                'start_shift_time' => '09:00:00',
                'shift_start_grace_period' => '09:15:00',
                'lunch_start_time' => '13:00:00',
                'end_lunch_time' => '14:00:00',
                'end_shift_time' => '17:00:00',
                'break_name' => 'Mid Morning Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Mid Afternoon Shift',
                'start_shift_time' => '14:00:00',
                'shift_start_grace_period' => '14:15:00',
                'lunch_start_time' => '18:00:00',
                'end_lunch_time' => '19:00:00',
                'end_shift_time' => '22:00:00',
                'break_name' => 'Mid Afternoon Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Late Morning Shift',
                'start_shift_time' => '10:00:00',
                'shift_start_grace_period' => '10:15:00',
                'lunch_start_time' => '14:00:00',
                'end_lunch_time' => '15:00:00',
                'end_shift_time' => '18:00:00',
                'break_name' => 'Late Morning Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
            [
                'shift_name' => 'Late Afternoon Shift',
                'start_shift_time' => '15:00:00',
                'shift_start_grace_period' => '15:15:00',
                'lunch_start_time' => '19:00:00',
                'end_lunch_time' => '20:00:00',
                'end_shift_time' => '23:00:00',
                'break_name' => 'Late Afternoon Break',
                'break_frequency' => 2,
                'break_duration' => '00:15:00',
            ],
        ]);
    }
}