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
        Schema::table('personal_informations', function (Blueprint $table) {
            if (!Schema::hasColumn('personal_informations', 'willing_blood_donor')) {
                $table->string('willing_blood_donor')->nullable()->after('blood_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_informations', function (Blueprint $table) {
            if (Schema::hasColumn('personal_informations', 'willing_blood_donor')) {
                $table->dropColumn('willing_blood_donor');
            }
        });
    }
};

