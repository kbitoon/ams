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
        if (Schema::hasTable('incident_reports')) {
            // Use DB::statement to avoid issues with column ordering
            if (!Schema::hasColumn('incident_reports', 'image_path')) {
                try {
                    // Try to add after 'narration' if it exists
                    if (Schema::hasColumn('incident_reports', 'narration')) {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_path` VARCHAR(255) NULL AFTER `narration`');
                    } elseif (Schema::hasColumn('incident_reports', 'date')) {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_path` VARCHAR(255) NULL AFTER `date`');
                    } elseif (Schema::hasColumn('incident_reports', 'updated_at')) {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_path` VARCHAR(255) NULL AFTER `updated_at`');
                    } else {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_path` VARCHAR(255) NULL');
                    }
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
            
            if (!Schema::hasColumn('incident_reports', 'image_position')) {
                try {
                    // Add after image_path if it exists, otherwise at the end
                    if (Schema::hasColumn('incident_reports', 'image_path')) {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_position` ENUM(\'before\', \'after\') DEFAULT \'before\' AFTER `image_path`');
                    } elseif (Schema::hasColumn('incident_reports', 'updated_at')) {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_position` ENUM(\'before\', \'after\') DEFAULT \'before\' AFTER `updated_at`');
                    } else {
                        \DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `image_position` ENUM(\'before\', \'after\') DEFAULT \'before\'');
                    }
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

