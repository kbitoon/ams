<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('incident_reports')) {
            // Use DB::statement to avoid issues with column ordering
            if (!Schema::hasColumn('incident_reports', 'image_path')) {
                try {
                    // Don't specify AFTER clause - just add at the end to avoid column dependency issues
                    DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_path` VARCHAR(255) NULL');
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
            
            if (!Schema::hasColumn('incident_reports', 'image_position')) {
                try {
                    // Don't specify AFTER clause - just add at the end
                    DB::statement("ALTER TABLE `incident_reports` ADD COLUMN `image_position` ENUM('before', 'after') DEFAULT 'before'");
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('incident_reports')) {
            Schema::table('incident_reports', function (Blueprint $table) {
                if (Schema::hasColumn('incident_reports', 'image_position')) {
                    $table->dropColumn('image_position');
                }
                if (Schema::hasColumn('incident_reports', 'image_path')) {
                    $table->dropColumn('image_path');
                }
            });
        }
    }
};

