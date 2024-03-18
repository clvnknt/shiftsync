<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class EmployeeShiftRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Retrieve all user IDs
        $userIds = DB::table('users')->pluck('id');

        // Retrieve all shift IDs
        $shiftIds = DB::table('shifts')->pluck('id');

        // Loop through each user ID
        foreach ($userIds as $userId) {
            // Generate 10 shift records for each user
            for ($i = 0; $i < 10; $i++) {
                DB::table('employee_shift_records')->insert([
                    'employee_id' => $userId,
                    'shift_id' => $faker->randomElement($shiftIds),
                    'shift_date' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    'shift_started' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    'lunch_started' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    'lunch_ended' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    'shift_ended' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
