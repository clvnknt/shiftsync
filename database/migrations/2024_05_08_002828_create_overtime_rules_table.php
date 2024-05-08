<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimeRulesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('overtime_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_shift_record_id')->nullable();
            $table->string('name');
            $table->string('condition');
            $table->integer('regular_hours');
            $table->float('overtime_rate');
            $table->enum('approval_status', ['pending', 'approved', 'denied'])->default('pending');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('employee_shift_record_id')->references('id')->on('employee_shift_records')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_rules');
    }
}

