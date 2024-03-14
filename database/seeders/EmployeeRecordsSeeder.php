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
                'user_id' => 1, // Assuming user with ID 1 exists
                'first_name' => 'John',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Doe',
                'default_shift_id' => 1, // Assuming shift with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user with ID 2 exists
                'first_name' => 'Jane',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Smith',
                'default_shift_id' => 2, // Assuming shift with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user with ID 3 exists
                'first_name' => 'Alice',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Johnson',
                'default_shift_id' => 3, // Assuming shift with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // Assuming user with ID 4 exists
                'first_name' => 'Bob',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Williams',
                'default_shift_id' => 4, // Assuming shift with ID 4 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // Assuming user with ID 5 exists
                'first_name' => 'Eva',
                'middle_name' => $faker->firstName(),
                'last_name' => 'Brown',
                'default_shift_id' => 5, // Assuming shift with ID 5 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the employees into the database
        DB::table('employee_records')->insert($employees);
    }
}
