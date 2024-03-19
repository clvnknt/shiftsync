<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_shift_record_id')->nullable()->constrained()->onDelete('cascade');
            $table->time('grace_period_end'); // Time when employee starts shifts during the grace period
            $table->time('late_shift_start'); // Minutes/Hours when employee starts shift late
            $table->time('early_start_lunch'); // Minutes/Hours when employee starts lunch early
            $table->time('late_end_lunch'); // Minutes/Hours when employee ends lunch late
            $table->time('overtime'); // Minutes/Hours the employee is overtime
            $table->time('hours_rendered'); // Hours rendered that day
            $table->enum('leave', ['paid', 'unpaid']); // Indicates if the employee's leave is paid or unpaid
            $table->boolean('is_absent')->default(false); // Indicates if the employee is absent that day (not started shift)
            $table->boolean('is_holiday')->default(false); // Indicates if the employee's shift that day is during a holiday
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
