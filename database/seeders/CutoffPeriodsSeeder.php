<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CutoffPeriod;
use Carbon\Carbon;

class CutoffPeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the cutoff period end dates
        $endDates = [
            'Asia/Manila' => '15',
            'Europe/London' => '15',
            'America/New_York' => '15',
            'Australia/Sydney' => '15',
        ];

        foreach ($endDates as $timezone => $endDate) {
            $currentDate = Carbon::now('UTC')->startOfMonth()->setTimezone($timezone);
            $endDate = Carbon::now('UTC')->endOfMonth()->day($endDate)->endOfDay()->setTimezone($timezone);

            while ($currentDate->lte($endDate)) {
                $startDate = $currentDate->copy()->startOfMonth();
                $endDate = $currentDate->copy()->endOfMonth();
                $utcOffset = $currentDate->copy()->offsetHours;
                
                // Format UTC offset in +00:00 format
                $utcOffsetFormatted = sprintf('%+03d:00', $utcOffset);
                
                // Create individual columns for each timezone's UTC offset
                $cutoffPeriod = new CutoffPeriod([
                    'period' => $currentDate->format('F Y'),
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'cutoff_timezone' => $utcOffsetFormatted, // Store UTC offset in cutoff_timezone column
                ]);
                $cutoffPeriod->save();
                
                $currentDate->addMonth();
            }
        }
    }
}