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
            // Add user_id column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'user_id')) {
                try {
                    DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `user_id` BIGINT UNSIGNED NULL AFTER `id`');
                    
                    // Add foreign key if users table exists
                    if (Schema::hasTable('users')) {
                        try {
                            DB::statement('ALTER TABLE `incident_reports` ADD CONSTRAINT `incident_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE');
                        } catch (\Exception $e) {
                            // Foreign key might already exist, ignore
                        }
                    }
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
            
            // Add title column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'title')) {
                try {
                    DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `title` VARCHAR(255) NULL');
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
            
            // Add name column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'name')) {
                try {
                    DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `name` VARCHAR(255) NULL');
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
            
            // Add narration column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'narration')) {
                try {
                    DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `narration` TEXT NULL');
                } catch (\Exception $e) {
                    // Column might already exist, ignore
                }
            }
            
            // Add date column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'date')) {
                try {
                    DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `date` DATE NULL');
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
            // Drop foreign key first
            try {
                DB::statement('ALTER TABLE `incident_reports` DROP FOREIGN KEY `incident_reports_user_id_foreign`');
            } catch (\Exception $e) {
                // Foreign key might not exist, ignore
            }
            
            $columnsToDrop = ['user_id', 'title', 'name', 'narration', 'date'];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('incident_reports', $column)) {
                    try {
                        DB::statement("ALTER TABLE `incident_reports` DROP COLUMN `{$column}`");
                    } catch (\Exception $e) {
                        // Column might not exist, ignore
                    }
                }
            }
        }
    }
};

