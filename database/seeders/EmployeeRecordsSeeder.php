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

        // Seed multiple employees
        $employees = [
            [
                'user_id' => 1,
                'first_name' => 'John',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Doe',
                'default_shift_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'first_name' => 'Jane',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Smith',
                'default_shift_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'first_name' => 'Alice',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Johnson',
                'default_shift_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'first_name' => 'Bob',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Williams',
                'default_shift_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'first_name' => 'Eva',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Brown',
                'default_shift_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the employees into the database
        DB::table('employee_records')->insert($employees);
    }
}

