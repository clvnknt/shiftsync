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
        Schema::create('employee_shift_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_record_id');
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->foreign('employee_record_id')->references('id')->on('employee_records')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_shift_pivot');
    }
};
