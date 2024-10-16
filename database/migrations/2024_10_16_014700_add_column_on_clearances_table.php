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
        Schema::table('clearances', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('contact_number');
            $table->string('sex')->after('date_of_birth');
            $table->string('civil_status')->after('sex');
            $table->string('precinct_no')->nullable()->after('civil_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clearances', function (Blueprint $table) {
            $table->dropColumn(['date_of_birth']);
            $table->dropColumn(['sex']);
            $table->dropColumn(['civil_status']);
            $table->dropColumn(['precinct_no']);
        });
    }
};
