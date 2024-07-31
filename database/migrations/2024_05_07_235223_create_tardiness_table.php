<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTardinessTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tardiness', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_shift_record_id');
            $table->boolean('is_late_start_shift')->default(false);
            $table->boolean('is_late_end_lunch')->default(false);
            $table->float('hours_late_start_shift')->nullable();
            $table->float('hours_late_end_lunch')->nullable();
            $table->timestamps();

            $table->foreign('employee_shift_record_id')->references('id')->on('employee_shift_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tardiness');
    }
}