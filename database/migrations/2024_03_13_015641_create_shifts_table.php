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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name'); // Shift Name (Morning Shift, Night Shift)
            $table->time('start_shift_time'); // Time when shift will start
            $table->time('shift_start_grace_period'); // Grace period when shift started but hasn't clocked in
            $table->time('lunch_start_time'); // Time when lunch will start
            $table->time('end_lunch_time'); // Time when lunch will end
            $table->time('end_shift_time'); // Time when shift will end
            $table->integer('break_frequency'); // Number of breaks the employee can have
            $table->time('break_duration')->default('00:00:00'); // Duration of the break (5 minutes, 10 minutes, 15 minutes)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
