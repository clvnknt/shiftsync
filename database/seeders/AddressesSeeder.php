<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('addresses')->insert([
                'id' => $i + 1,
                'street' => $faker->streetAddress,
                'city' => $faker->city,
                'country' => $faker->country,
                'postal_code' => $faker->postcode,
                'type' => $faker->randomElement(['primary', 'temporary']),
                'created_at' => now(),
                'updated_at' => now(),
                'employee_record_id' => rand(1, 10), // Assuming you have employee_records seeded already
            ]);
        }
    }
}
