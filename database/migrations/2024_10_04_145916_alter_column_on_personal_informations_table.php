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
        Schema::table('personal_informations', function(Blueprint $table) {
            $table->renameColumn('emergency_contact_1', 'emergency_contact_person');
            $table->renameColumn('emergency_contact_2', 'emergency_contact_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_informations', function(Blueprint $table) {
            $table->renameColumn('emergency_contact_1', 'emergency_contact_person');
            $table->renameColumn('emergency_contact_2', 'emergency_contact_number');
        });
    }
};
