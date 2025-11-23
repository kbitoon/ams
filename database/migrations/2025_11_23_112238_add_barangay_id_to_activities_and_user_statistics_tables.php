<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Activities
        if (Schema::hasTable('bis_activities')) {
            Schema::table('bis_activities', function (Blueprint $table) {
                if (!Schema::hasColumn('bis_activities', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // User Statistics
        if (Schema::hasTable('user_statistics')) {
            Schema::table('user_statistics', function (Blueprint $table) {
                if (!Schema::hasColumn('user_statistics', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('bis_activities')) {
            Schema::table('bis_activities', function (Blueprint $table) {
                if (Schema::hasColumn('bis_activities', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('user_statistics')) {
            Schema::table('user_statistics', function (Blueprint $table) {
                if (Schema::hasColumn('user_statistics', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }
    }
};
