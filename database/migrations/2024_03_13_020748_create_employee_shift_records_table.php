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
            $table->unsignedBigInteger('employee_record_id');
            $table->unsignedBigInteger('employee_assigned_shift_id')->nullable(); //employee's assigned shift in th employee assigned shift table
            $table->date('shift_date');
            $table->time('start_shift')->nullable();
            $table->time('start_lunch')->nullable();
            $table->time('end_lunch')->nullable();
            $table->time('end_shift')->nullable();
            $table->unsignedInteger('shift_order')->nullable();
            $table->timestamps();

            // Correcting the foreign key constraint name
            $table->foreign('employee_record_id', 'fk_shift_record_employee_record_id')->references('id')->on('employee_records')->onDelete('cascade');
            $table->foreign('employee_assigned_shift_id', 'fk_shift_record_assigned_shift_id')->references('id')->on('employee_assigned_shifts')->onDelete('set null');
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
