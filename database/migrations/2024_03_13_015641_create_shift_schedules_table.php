<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Employee's default shift schedules to follow
        Schema::create('shift_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name');
            $table->time('start_shift_time');
            $table->time('shift_start_grace_period')->nullable();
            $table->time('lunch_start_time');
            $table->time('end_lunch_time');
            $table->time('end_shift_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_schedules');
    }
};