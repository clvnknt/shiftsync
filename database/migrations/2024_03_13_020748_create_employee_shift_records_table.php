<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeShiftRecordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_shift_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_record_id');
            $table->unsignedBigInteger('employee_shift_pivot_id')->nullable();
            $table->date('shift_date');
            $table->time('start_shift')->nullable();
            $table->time('start_lunch')->nullable();
            $table->time('end_lunch')->nullable();
            $table->time('end_shift')->nullable();
            $table->timestamps();

            $table->foreign('employee_record_id')->references('id')->on('employee_records')->onDelete('cascade');
            $table->foreign('employee_shift_pivot_id')->references('id')->on('employee_shift_pivot')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_shift_records');
    }
}