<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rule;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rule::create([
            'name' => 'Maximum Shift Duration',
            'description' => 'Employees cannot work more than 8 hours per shift.',
            'type' => 'shift_duration',
            'start_time' => null,
            'end_time' => null,
            'applicable_days' => null,
            'applicable_users' => null,
            'status' => 'active',
            'value' => 8 // 8 hours
        ]);

        Rule::create([
            'name' => 'Minimum Break Duration',
            'description' => 'Employees must take at least a 30-minute break after working for 5 hours.',
            'type' => 'break_duration',
            'start_time' => null,
            'end_time' => null,
            'applicable_days' => null,
            'applicable_users' => null,
            'status' => 'active',
            'value' => 30 // 30 minutes
        ]);

        // Add other rules similarly
        // ...

        Rule::create([
            'name' => 'Minimum Notice for Shift Change',
            'description' => 'Employees must be given at least a 24-hour notice for any shift changes.',
            'type' => 'shift_change_notice',
            'start_time' => null,
            'end_time' => null,
            'applicable_days' => null,
            'applicable_users' => null,
            'status' => 'active',
            'value' => 24 // 24 hours
        ]);
    }
}
