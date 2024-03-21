<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // Add foreign key constraint for employee_records table
    Schema::table('employee_records', function (Blueprint $table) {
        $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('role_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('default_shift_id')->constrained('shifts')->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        
        // Check if 'address_id' column exists before adding it
        if (!Schema::hasColumn('employee_records', 'address_id')) {
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('set null');
        }
    });

    // Add foreign key constraint for breaks table
    Schema::table('breaks', function (Blueprint $table) {
        $table->foreignId('employee_shift_record_id')->constrained()->onDelete('cascade');
    });

    // Add foreign key constraint for emergency_contacts table
    Schema::table('emergency_contacts', function (Blueprint $table) {
        $table->foreignId('employee_record_id')->constrained('employee_records')->onDelete('cascade');
    });

    // Add foreign key constraint for addresses table
    Schema::table('addresses', function (Blueprint $table) {
        $table->foreignId('employee_record_id')->constrained('employee_records')->onDelete('cascade');
    });

    // Add foreign key constraint for holidays table
    Schema::table('holidays', function (Blueprint $table) {
        $table->foreignId('rule_id')->constrained('rules')->onDelete('cascade');
    });

    // Add foreign key constraint for rules table
    Schema::table('rules', function (Blueprint $table) {
        $table->foreignId('employee_shift_record_id')->constrained('employee_shift_records')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_records', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['role_id']);
            $table->dropForeign(['default_shift_id']);
            $table->dropForeign(['address_id']);
        });

        Schema::table('breaks', function (Blueprint $table) {
            $table->dropForeign(['employee_shift_record_id']);
        });

        Schema::table('emergency_contacts', function (Blueprint $table) {
            $table->dropForeign(['employee_record_id']);
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['employee_record_id']);
        });

        Schema::table('holidays', function (Blueprint $table) {
            $table->dropForeign(['rule_id']);
        });

        Schema::table('rules', function (Blueprint $table) {
            $table->dropForeign(['employee_shift_record_id']);
        });
    }
}
