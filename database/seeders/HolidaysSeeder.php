<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HolidaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('holidays')->insert([
                'id' => $i + 1,
                'name' => $faker->word(),
                'date' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
                'rule_id' => rand(1, 10), // Assuming you have rules seeded already
            ]);
        }
    }
}
