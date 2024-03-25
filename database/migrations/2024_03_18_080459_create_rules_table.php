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
            //Rules Table IDs
            $table->unsignedBigInteger('employee_record_id'); //connects it to one employee/employee record
            $table->unsignedBigInteger('employee_shift_record_id'); //connects it to one employee shift record 
            //Rules Table Columns
            $table->time('grace_period_end')->nullable(); //stores the time the employee ended their grace period
            $table->time('late_shift_start')->nullable(); //stores the total minute/hours of lateness before shift starts
            $table->time('early_start_lunch')->nullable(); //stores the total minute/hours of earlyness before lunch
            $table->time('late_end_lunch')->nullable(); //stores the total minute/hours of lateness after lunch
            $table->time('overtime')->nullable(); //stores the total minutes/hours of overtime incurred by the employee
            $table->time('hours_rendered')->nullable(); //stores the total hour rendered incurred by the employee
            $table->enum('leave', ['paid', 'unpaid']); //determines if the employee is on paid or unpaid leave
            $table->boolean('is_absent')->default(false); //determines if employee is absent the whole shift
            $table->boolean('is_holiday')->default(false); //determines if the shift is holiday
            $table->timestamps();
            //Foreign Key Constraints
            $table->foreign('employee_record_id')->references('id')->on('employee_records'); //creates a connection between one employee record
            $table->foreign('employee_shift_record_id')->references('id')->on('employee_shift_records'); //creates a connection between one or more employee shift records per day
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
