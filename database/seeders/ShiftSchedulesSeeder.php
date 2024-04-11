<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;
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
                'shift_name' => 'Day Shift',
                'start_shift_time' => '08:00:00',
                'shift_start_grace_period' => '00:10:00',
                'lunch_start_time' => '12:00:00',
                'end_lunch_time' => '13:00:00',
                'end_shift_time' => '17:00:00',
            ],
            [
                'shift_name' => 'Night Shift',
                'start_shift_time' => '20:00:00',
                'shift_start_grace_period' => '00:15:00',
                'lunch_start_time' => '00:00:00', // Midnight
                'end_lunch_time' => '01:00:00', // 1:00 AM
                'end_shift_time' => '04:00:00', // 4:00 AM
            ],
        ];
        foreach ($shiftSchedules as $shiftScheduleData) {
            ShiftSchedule::create($shiftScheduleData);
        }
        
    }
}
