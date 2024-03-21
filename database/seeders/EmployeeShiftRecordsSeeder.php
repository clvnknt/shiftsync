<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Illuminate\Support\Facades\DB;

class EmployeeShiftRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('employee_shift_records')->insert([
                'shift_date' => $faker->date(),
                'start_shift' => $faker->time(),
                'start_lunch' => $faker->time(),
                'end_lunch' => $faker->time(),
                'end_shift' => $faker->time(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
