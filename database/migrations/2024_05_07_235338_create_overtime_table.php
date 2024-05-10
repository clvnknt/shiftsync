<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimeTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('overtime', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_shift_record_id');
            $table->timestamp('overtime_started')->nullable();
            $table->timestamp('overtime_ended')->nullable();
            $table->float('overtime_hours')->nullable();
            $table->timestamps();

            $table->foreign('employee_shift_record_id')->references('id')->on('employee_shift_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime');
    }
}