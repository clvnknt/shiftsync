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
            $table->unsignedBigInteger('user_id'); //employee should be connected to one user
            $table->unsignedBigInteger('department_id'); //employee should be connected to one department
            $table->unsignedBigInteger('role_id'); //employee should be connected to one role
            $table->unsignedBigInteger('address_id'); //employee should be connected to one to two address (primary and temporary)
            $table->unsignedBigInteger('emergency_contact_id'); //employee should be connected to one emergency contact
            $table->unsignedBigInteger('shift_break_id'); //employee should be connected to one shift break
            $table->string('employee_first_name'); //first name of the employee
            $table->string('employee_middle_name');  //middle name of the employee
            $table->string('employee_last_name'); //last name of the employee
            $table->string('employee_suffix'); //suffix of the employee
            $table->enum('employee_gender', ['male', 'female', 'other']);
            $table->integer('employee_age'); //age of the employee
            $table->date('employee_birthdate'); //birthdate of the employee
            $table->string('employee_profile_picture'); //profile picture of the employee
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //create a connection between the users table
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade'); //creates a connection between departments table
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); //creates a connection between roles table
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade'); //creates a connection between addresses table
            $table->foreign('emergency_contact_id')->references('id')->on('emergency_contacts')->onDelete('cascade'); //creates a connection between emergency_contacts table
            $table->foreign('shift_break_id')->references('id')->on('shift_breaks')->onDelete('cascade'); //creates a connection between shifts table
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