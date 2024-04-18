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
        Schema::create('employee_assigned_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_record_id');
            $table->unsignedBigInteger('shift_schedule_id')->nullable(); //shift schedule table
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->foreign('employee_record_id', 'fk_assigned_shift_employee_record_id')->references('id')->on('employee_records')->onDelete('cascade');
            $table->foreign('shift_schedule_id', 'fk_assigned_shift_shift_schedule_id')->references('id')->on('shift_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_assigned_shifts');
    }
};
