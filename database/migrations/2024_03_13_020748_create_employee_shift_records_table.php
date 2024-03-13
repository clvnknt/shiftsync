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
            $table->id(); // This will create the primary key column 'id'
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('shift_id')->unsigned();
            $table->date('shift_date');
            $table->dateTime('shift_started')->nullable();
            $table->dateTime('lunch_started')->nullable();
            $table->dateTime('lunch_ended')->nullable();
            $table->dateTime('shift_ended')->nullable();
            $table->foreign('employee_id')->references('id')->on('employee_records')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->timestamps();

            $table->index('employee_id');
            $table->index('shift_id');
            $table->index('shift_date');
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