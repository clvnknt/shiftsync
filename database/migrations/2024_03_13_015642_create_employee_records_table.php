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
        Schema::create('employee_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('address_id')->unsigned()->nullable(); //Employee's address 
            $table->string('first_name'); //Employee's first name
            $table->string('middle_name'); //Employee's middle name
            $table->string('last_name'); //Employee's last name
            $table->string('profile_picture')->nullable(); //Employee's profile picture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_records');
    }
};
