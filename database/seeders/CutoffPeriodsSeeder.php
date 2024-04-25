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
            $currentMonth = Carbon::now()->startOfMonth()->setTimezone($timezone);
            $endDay = intval($endDate);

            // Create record for 1-15 period
            $startDate1 = $currentMonth->copy()->startOfMonth();
            $endDate1 = $currentMonth->copy()->startOfMonth()->addDays($endDay - 1)->endOfDay();
            $utcOffset = $currentMonth->copy()->offsetHours;
            $utcOffsetFormatted = sprintf('%+03d:00', $utcOffset);

            $cutoffPeriod1 = new CutoffPeriod([
                'period' => $currentMonth->format('F Y'),
                'start_date' => $startDate1,
                'end_date' => $endDate1,
                'cutoff_timezone' => $utcOffsetFormatted,
            ]);
            $cutoffPeriod1->save();

            // Create record for 16-end of month period
            $startDate2 = $currentMonth->copy()->startOfMonth()->addDays($endDay);
            $endDate2 = $currentMonth->copy()->endOfMonth();

            $cutoffPeriod2 = new CutoffPeriod([
                'period' => $currentMonth->format('F Y'),
                'start_date' => $startDate2,
                'end_date' => $endDate2,
                'cutoff_timezone' => $utcOffsetFormatted,
            ]);
            $cutoffPeriod2->save();
        }
    }
}