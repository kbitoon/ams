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
            if (!Schema::hasColumn('clearances', 'verification_token')) {
                $table->string('verification_token', 64)->nullable()->unique()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clearances', function (Blueprint $table) {
            if (Schema::hasColumn('clearances', 'verification_token')) {
                $table->dropColumn('verification_token');
            }
        });
    }
};
