<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Items
        if (Schema::hasTable('items')) {
            Schema::table('items', function (Blueprint $table) {
                if (!Schema::hasColumn('items', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Item Schedules
        if (Schema::hasTable('item_schedules')) {
            Schema::table('item_schedules', function (Blueprint $table) {
                if (!Schema::hasColumn('item_schedules', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('items')) {
            Schema::table('items', function (Blueprint $table) {
                if (Schema::hasColumn('items', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('item_schedules')) {
            Schema::table('item_schedules', function (Blueprint $table) {
                if (Schema::hasColumn('item_schedules', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }
    }
};
