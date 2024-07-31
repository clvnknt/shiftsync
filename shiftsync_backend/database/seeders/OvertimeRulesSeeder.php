<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OvertimeRule;

class OvertimeRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Night Differential Overtime
        OvertimeRule::create([
            'is_active' => true,
            'name' => 'Night Differential Overtime',
            'condition' => 'Shifts that start after 10:00 PM and end before 6:00 AM',
            'overtime_rate' => 1.25,
        ]);

        // Weekend Overtime
        OvertimeRule::create([
            'is_active' => true,
            'name' => 'Weekend Overtime',
            'condition' => 'Shifts that fall on Saturday or Sunday',
            'overtime_rate' => 1.5,
        ]);

        // Holiday Overtime
        OvertimeRule::create([
            'is_active' => true,
            'name' => 'Holiday Overtime',
            'condition' => 'Shifts that fall on recognized holidays',
            'overtime_rate' => 2.0,
        ]);

        // Long Shift Overtime
        OvertimeRule::create([
            'is_active' => true,
            'name' => 'Long Shift Overtime',
            'condition' => 'Shifts that exceed 9 hours in duration',
            'overtime_rate' => 1.5,
        ]);

        // Emergency Overtime
        OvertimeRule::create([
            'is_active' => true,
            'name' => 'Emergency Overtime',
            'condition' => 'Shifts worked during emergency situations',
            'overtime_rate' => 1.5,
        ]);
    }
}
