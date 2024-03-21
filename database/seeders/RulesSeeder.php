<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('rules')->insert([
                'id' => $i + 1,
                'grace_period_end' => $faker->time(),
                'late_shift_start' => $faker->time(),
                'early_start_lunch' => $faker->time(),
                'late_end_lunch' => $faker->time(),
                'overtime' => $faker->time(),
                'hours_rendered' => $faker->time(),
                'leave' => $faker->randomElement(['paid', 'unpaid']),
                'is_absent' => $faker->boolean(),
                'is_holiday' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
                'employee_shift_record_id' => rand(1, 10), // Assuming you have employee_shift_records seeded already
            ]);
        }
    }
}
