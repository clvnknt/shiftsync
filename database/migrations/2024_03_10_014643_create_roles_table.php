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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            //IDs
            $table->unsignedBigInteger('department_id'); //associates each role to a department
            //Columns
            $table->string('role_name'); //role name (ex. software engineer, ui/ux specialist)
            $table->string('role_description')->nullable(); //description of the role
            $table->timestamps();
            //Foreign Keys
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade'); //create a connection between the users table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
