<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lupon Event Tracking
        if (Schema::hasTable('lupon_event_tracking')) {
            Schema::table('lupon_event_tracking', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_event_tracking', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Lupon Case Comments
        if (Schema::hasTable('lupon_case_comments')) {
            Schema::table('lupon_case_comments', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_case_comments', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Lupon Summon Tracking
        if (Schema::hasTable('lupon_summon_tracking')) {
            Schema::table('lupon_summon_tracking', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_summon_tracking', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Lupon Hearing Tracking
        if (Schema::hasTable('lupon_hearing_tracking')) {
            Schema::table('lupon_hearing_tracking', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_hearing_tracking', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('lupon_event_tracking')) {
            Schema::table('lupon_event_tracking', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_event_tracking', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('lupon_case_comments')) {
            Schema::table('lupon_case_comments', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_case_comments', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('lupon_summon_tracking')) {
            Schema::table('lupon_summon_tracking', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_summon_tracking', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('lupon_hearing_tracking')) {
            Schema::table('lupon_hearing_tracking', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_hearing_tracking', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }
    }
};
