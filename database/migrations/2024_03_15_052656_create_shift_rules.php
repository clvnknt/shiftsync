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
        Schema::create('shift_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('grace_period')->default(0); // Grace period in minutes
            $table->integer('break_duration')->default(0); // Break duration in minutes
            $table->integer('overtime_threshold')->default(0); // Overtime threshold in minutes
            $table->integer('shift_started_lateness')->nullable(); // Shift started lateness in minutes
            $table->integer('end_lunch_lateness')->nullable(); // End lunch lateness in minutes
            $table->boolean('absent')->default(false);
            $table->boolean('overtime')->default(false);
            $table->boolean('other')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_rules');
    }
};
