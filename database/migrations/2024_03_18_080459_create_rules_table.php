<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('applicable_days')->nullable();
            $table->string('applicable_users')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('inactive');
            $table->float('value')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rules');
    }
};