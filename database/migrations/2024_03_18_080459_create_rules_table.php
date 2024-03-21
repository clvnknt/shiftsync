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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->time('grace_period_end');
            $table->time('late_shift_start');
            $table->time('early_start_lunch');
            $table->time('late_end_lunch');
            $table->time('overtime');
            $table->time('hours_rendered');
            $table->enum('leave', ['paid', 'unpaid']);
            $table->boolean('is_absent')->default(false);
            $table->boolean('is_holiday')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
