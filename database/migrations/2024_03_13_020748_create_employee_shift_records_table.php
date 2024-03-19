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
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('shift_id')->unsigned();
            $table->date('shift_date'); //Date of employee's shift
            $table->time('start_shift')->nullable(); //Time when employee started shift
            $table->time('start_lunch')->nullable(); //Time when employee started lunch
            $table->time('end_lunch')->nullable(); //Time when employee ended lunch
            $table->time('end_shift')->nullable(); //Time when employee ended shift
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