<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Vehicles
        if (Schema::hasTable('vehicles')) {
            Schema::table('vehicles', function (Blueprint $table) {
                if (!Schema::hasColumn('vehicles', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Vehicle Schedules
        if (Schema::hasTable('vehicle_schedules')) {
            Schema::table('vehicle_schedules', function (Blueprint $table) {
                if (!Schema::hasColumn('vehicle_schedules', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Facilities
        if (Schema::hasTable('facilities')) {
            Schema::table('facilities', function (Blueprint $table) {
                if (!Schema::hasColumn('facilities', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Facility Schedules
        if (Schema::hasTable('facility_schedules')) {
            Schema::table('facility_schedules', function (Blueprint $table) {
                if (!Schema::hasColumn('facility_schedules', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('vehicles')) {
            Schema::table('vehicles', function (Blueprint $table) {
                if (Schema::hasColumn('vehicles', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('vehicle_schedules')) {
            Schema::table('vehicle_schedules', function (Blueprint $table) {
                if (Schema::hasColumn('vehicle_schedules', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('facilities')) {
            Schema::table('facilities', function (Blueprint $table) {
                if (Schema::hasColumn('facilities', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('facility_schedules')) {
            Schema::table('facility_schedules', function (Blueprint $table) {
                if (Schema::hasColumn('facility_schedules', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }
    }
};
