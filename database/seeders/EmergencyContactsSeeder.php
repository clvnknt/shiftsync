<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmergencyContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('emergency_contacts')->insert([
                'id' => $i + 1,
                'contact_first_name' => $faker->firstName,
                'contact_last_name' => $faker->lastName,
                'relationship' => $faker->randomElement(['Parent', 'Sibling', 'Spouse', 'Friend']),
                'phone_number' => $faker->phoneNumber,
                'street' => $faker->streetAddress,
                'city' => $faker->city,
                'country' => $faker->country,
                'postal_code' => $faker->postcode,
                'created_at' => now(),
                'updated_at' => now(),
                'employee_record_id' => rand(1, 10), // Assuming you have employee_records seeded already
            ]);
        }
    }
}