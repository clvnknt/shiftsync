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
            $shiftDate = now()->startOfMonth(); // Start with the first day of the current month

            // Generate 10 consecutive shift records for each user
            for ($i = 0; $i < 10; $i++) {
                DB::table('employee_shift_records')->insert([
                    'employee_id' => $userId,
                    'shift_id' => $faker->randomElement($shiftIds),
                    'shift_date' => $shiftDate->format('Y-m-d'),
                    'start_shift' => $faker->time(),
                    'start_lunch' => $faker->time(),
                    'end_lunch' => $faker->time(),
                    'end_shift' => $faker->time(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Move to the next day
                $shiftDate->addDay();
            }
        }
    }
}