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
        Schema::create('employee_shift_records', function (Blueprint $table) {
            $table->id(); 
            $table->date('shift_date');
            $table->time('start_shift')->nullable();
            $table->time('start_lunch')->nullable();
            $table->time('end_lunch')->nullable();
            $table->time('end_shift')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_shift_records');
    }
};