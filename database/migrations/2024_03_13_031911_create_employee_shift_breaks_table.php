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
        Schema::create('employee_shift_breaks', function (Blueprint $table) {
            $table->id();
            //Shift
            $table->unsignedBigInteger('employee_record_id');
            //Shift Columns
            $table->date('break_date');
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->timestamps();
            //Employee Record Foreign Keys
            $table->foreign('employee_record_id')->references('id')->on('employee_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_shift_breaks');
    }
};
