<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeeRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('employee_records')->insert([
                'id' => $i + 1,
                'address_id' => rand(1, 10), // Assuming you have addresses seeded already
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'profile_picture' => $faker->imageUrl(), // Generate a random profile picture URL
                'created_at' => now(),
                'updated_at' => now(),
                'department_id' => rand(1, 10), // Assuming you have departments seeded already
                'role_id' => rand(1, 10), // Assuming you have roles seeded already
                'default_shift_id' => rand(1, 10), // Assuming you have shifts seeded already
                'user_id' => rand(1, 10),
            ]);
        }
    }
}
