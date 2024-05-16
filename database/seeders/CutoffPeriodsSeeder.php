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
        // Define timezones
        $timezones = [
            'Asia/Manila',
            'Europe/London',
            'America/New_York',
            'Australia/Sydney',
        ];

        // Define the year
        $year = 2024;

        // Loop through each timezone
        foreach ($timezones as $timezone) {
            // Set the timezone
            date_default_timezone_set($timezone);
            $currentMonth = Carbon::create($year, 1, 1, 0, 0, 0, $timezone);

            // Loop through each month of the year
            for ($i = 1; $i <= 12; $i++) {
                // Set the current month
                $currentMonth->month = $i;

                // Get the number of days in the month
                $endDay = $currentMonth->daysInMonth;

                // Create record for 1-15 period
                $startDate1 = $currentMonth->copy()->startOfMonth();
                $endDate1 = $currentMonth->copy()->startOfMonth()->addDays(14)->endOfDay();
                $utcOffset = $currentMonth->copy()->offsetHours;
                $utcOffsetFormatted = sprintf('%+03d:00', $utcOffset);

                // Find or create cutoff period
                CutoffPeriod::updateOrCreate([
                    'period' => 'Cutoff Period 1 ' . $currentMonth->format('F Y'),
                    'start_date' => $startDate1,
                    'end_date' => $endDate1,
                    'cutoff_timezone' => $utcOffsetFormatted,
                ]);

                // Create record for 16-end of month period
                $startDate2 = $currentMonth->copy()->startOfMonth()->addDays(15);
                $endDate2 = $currentMonth->copy()->endOfMonth();

                // Find or create cutoff period
                CutoffPeriod::updateOrCreate([
                    'period' => 'Cutoff Period 2 ' . $currentMonth->format('F Y'),
                    'start_date' => $startDate2,
                    'end_date' => $endDate2,
                    'cutoff_timezone' => $utcOffsetFormatted,
                ]);
            }
        }
    }
}