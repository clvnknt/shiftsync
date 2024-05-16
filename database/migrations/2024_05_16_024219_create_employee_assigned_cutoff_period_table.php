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
        Schema::create('employee_assigned_cutoff_periods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cutoff_period_id');
            $table->unsignedBigInteger('employee_record_id');
            $table->timestamps();

            $table->foreign('cutoff_period_id')->references('id')->on('cutoff_periods')->onDelete('cascade');
            $table->foreign('employee_record_id')->references('id')->on('employee_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_assigned_cutoff_period');
    }
};
