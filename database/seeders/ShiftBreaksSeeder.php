<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShiftBreak;

class ShiftBreaksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shiftBreaks = [
            [
                'break_name' => 'Coffee Break',
                'break_duration' => '00:15:00',
            ],
            [
                'break_name' => 'Tea Break',
                'break_duration' => '00:15:00',
            ],
        ];

        foreach ($shiftBreaks as $shiftBreaksData) {
            ShiftBreak::create($shiftBreaksData);
        }
    }
}