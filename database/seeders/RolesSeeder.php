<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('roles')->insert([
                'name' => $faker->jobTitle,
                'description' => $faker->sentence,
                'department_id' => $faker->numberBetween(1, 10), // Assuming departments are already seeded
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
