<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BreaksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('breaks')->insert([
                'id' => $i + 1,
                'break_date' => $faker->date(),
                'break_start' => $faker->time(),
                'break_end' => $faker->time(),
                'created_at' => now(),
                'updated_at' => now(),
                'employee_shift_record_id' => rand(1, 10), // Assuming you have employee_shift_records seeded already
            ]);
        }
    }
}
