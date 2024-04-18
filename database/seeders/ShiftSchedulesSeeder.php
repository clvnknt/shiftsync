<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShiftSchedule;

class ShiftSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shiftSchedules = [
            [
                'shift_name' => 'Day Shift', // Timezone: Asia/Manila (PH)
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '17:00:00',
                'shift_timezone' => '+08:00', // UTC+08:00 (Asia/Manila)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: Asia/Manila (PH)
                'start_shift_time' => '20:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '00:00:00', // Midnight
                'end_lunch_time' => '01:00:00', // 1:00 AM
                'end_shift_time' => '28:00:00', // 4:00 AM (next day)
                'shift_timezone' => '+08:00', // UTC+08:00 (Asia/Manila)
            ],
            [
                'shift_name' => 'Day Shift', // Timezone: Europe/London (UK)
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '17:00:00',
                'shift_timezone' => '+00:00', // UTC+00:00 (Europe/London)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: Europe/London (UK)
                'start_shift_time' => '20:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '00:00:00', // Midnight
                'end_lunch_time' => '01:00:00', // 1:00 AM
                'end_shift_time' => '28:00:00', // 4:00 AM (next day)
                'shift_timezone' => '+00:00', // UTC+00:00 (Europe/London)
            ],
            [
                'shift_name' => 'Day Shift', // Timezone: America/New_York (US)
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '17:00:00',
                'shift_timezone' => '-04:00', // UTC-04:00 (America/New_York)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: America/New_York (US)
                'start_shift_time' => '20:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '00:00:00', // Midnight
                'end_lunch_time' => '01:00:00', // 1:00 AM
                'end_shift_time' => '28:00:00', // 4:00 AM (next day)
                'shift_timezone' => '-04:00', // UTC-04:00 (America/New_York)
            ],
            [
                'shift_name' => 'Day Shift', // Timezone: Australia/Sydney (AU)
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '17:00:00',
                'shift_timezone' => '+10:00', // UTC+10:00 (Australia/Sydney)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: Australia/Sydney (AU)
                'start_shift_time' => '20:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '00:00:00', // Midnight
                'end_lunch_time' => '01:00:00', // 1:00 AM
                'end_shift_time' => '28:00:00', // 4:00 AM (next day)
                'shift_timezone' => '+10:00', // UTC+10:00 (Australia/Sydney)
            ],
        ];

        foreach ($shiftSchedules as $shiftScheduleData) {
            ShiftSchedule::create($shiftScheduleData);
        }
    }
}