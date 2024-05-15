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
                'start_shift_time' => '00:00:00', // UTC, Converted from 08:00:00 (local time)
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '04:00:00', // UTC, Converted from 12:00:00 (local time)
                'end_lunch_time' => '05:00:00', // UTC, Converted from 13:00:00 (local time)
                'end_shift_time' => '09:00:00', // UTC, Converted from 17:00:00 (local time)
                'shift_timezone' => '+08:00', // UTC+08:00 (Asia/Manila)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: Asia/Manila (PH)
                'start_shift_time' => '12:00:00', // UTC, Converted from 20:00:00 (local time)
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '16:00:00', // UTC, Converted from 00:00:00 (local time)
                'end_lunch_time' => '17:00:00', // UTC, Converted from 01:00:00 (local time)
                'end_shift_time' => '20:00:00', // UTC, Converted from 04:00:00 (local time, next day)
                'shift_timezone' => '+08:00', // UTC+08:00 (Asia/Manila)
            ],
            [
                'shift_name' => 'Day Shift', // Timezone: Europe/London (UK)
                'start_shift_time' => '07:00:00', // UTC, Converted from 08:00:00 (local time)
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '11:00:00', // UTC, Converted from 12:00:00 (local time)
                'end_lunch_time' => '12:00:00', // UTC, Converted from 13:00:00 (local time)
                'end_shift_time' => '16:00:00', // UTC, Converted from 17:00:00 (local time)
                'shift_timezone' => '+01:00', // UTC+00:00 (Europe/London)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: Europe/London (UK)
                'start_shift_time' => '19:00:00', // UTC, Converted from 20:00:00 (local time)
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '23:00:00', // UTC, Converted from 00:00:00 (local time)
                'end_lunch_time' => '00:00:00', // UTC, Converted from 01:00:00 (local time)
                'end_shift_time' => '03:00:00', // UTC, Converted from 04:00:00 (local time, next day)
                'shift_timezone' => '+01:00', // UTC+00:00 (Europe/London)
            ],
            [
                'shift_name' => 'Day Shift', // Timezone: America/New_York
                'start_shift_time' => '12:00:00', // UTC, Converted from 08:00:00 (local time)
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '16:00:00', // UTC, Converted from 12:00:00 (local time)
                'end_lunch_time' => '17:00:00', // UTC, Converted from 13:00:00 (local time)
                'end_shift_time' => '21:00:00', // UTC, Converted from 17:00:00 (local time)
                'shift_timezone' => '-04:00', // UTC-04:00 (America/New_York)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: America/New_York
                'start_shift_time' => '00:00:00', // UTC, Converted from 20:00:00 (local time)
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '04:00:00', // UTC, Converted from 00:00:00 (local time)
                'end_lunch_time' => '05:00:00', // UTC, Converted from 01:00:00 (local time)
                'end_shift_time' => '08:00:00', // UTC, Converted from 04:00:00 (local time, next day)
                'shift_timezone' => '-04:00', // UTC-04:00 (America/New_York)
            ],
            [
                'shift_name' => 'Day Shift', // Timezone: Australia/Brisbane (AU)
                'start_shift_time' => '22:00:00', // UTC, Converted from 08:00:00 (local time, previous day)
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '02:00:00', // UTC, Converted from 12:00:00 (local time)
                'end_lunch_time' => '03:00:00', // UTC, Converted from 13:00:00 (local time)
                'end_shift_time' => '07:00:00', // UTC, Converted from 17:00:00 (local time)
                'shift_timezone' => '+10:00', // UTC+10:00 (Australia/Brisbane)
            ],
            [
                'shift_name' => 'Night Shift', // Timezone: Australia/Brisbane (AU)
                'start_shift_time' => '10:00:00', // UTC, Converted from 20:00:00 (local time, previous day)
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '14:00:00', // UTC, Converted from 00:00:00 (local time)
                'end_lunch_time' => '15:00:00', // UTC, Converted from 01:00:00 (local time)
                'end_shift_time' => '18:00:00', // UTC, Converted from 04:00:00 (local time, next day)
                'shift_timezone' => '+10:00', // UTC+10:00 (Australia/Brisbane)
            ],
        ];

        foreach ($shiftSchedules as $shiftScheduleData) {
            // Create the shift schedule record
            ShiftSchedule::create($shiftScheduleData);
        }
    }
}