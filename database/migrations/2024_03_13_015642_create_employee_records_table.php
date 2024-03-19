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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name'); //Employee's first name
            $table->string('middle_name'); //Employee's middle name
            $table->string('last_name'); //Employee's last name
            $table->string('profile_picture')->nullable(); //Employee's profile picture
            $table->bigInteger('role_id')->unsigned()->nullable(); //Employee's role (1 - Software Engineer, 2 - UI/UX Specialist, etc.)
            $table->bigInteger('department_id')->unsigned()->nullable(); //Employee's department (1 - Software Development, 2 - Human Resources, etc.)
            $table->bigInteger('default_shift_id')->unsigned(); //Employee's assigned shift (1 - Morning Shift, 2 - Night Shift, etc.)
            $table->bigInteger('address_id')->unsigned()->nullable(); //Employee's address 
            $table->foreign('default_shift_id')->references('id')->on('shifts')->onDelete('cascade')->after('address_id');
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