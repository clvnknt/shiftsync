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
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_first_name', 100);
            $table->string('contact_last_name', 100);
            $table->string('contact_relationship', 50);
            $table->string('contact_phone_number', 50);
            $table->string('contact_street', 255);
            $table->string('contact_city', 100);
            $table->string('contact_country', 100);
            $table->string('contact_postal_code', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};