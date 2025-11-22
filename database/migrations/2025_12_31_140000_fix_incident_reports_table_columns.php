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
                DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `user_id` BIGINT UNSIGNED NULL AFTER `id`');
                
                // Add foreign key if users table exists
                try {
                    if (Schema::hasTable('users')) {
                        DB::statement('ALTER TABLE `incident_reports` ADD CONSTRAINT `incident_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE');
                    }
                } catch (\Exception $e) {
                    // Foreign key might already exist, ignore
                }
            }
            
            // Add title column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'title')) {
                DB::statement('ALTER TABLE `incident_reports` ADD COLUMN `title` VARCHAR(255) NULL');
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
            
            if (Schema::hasColumn('incident_reports', 'user_id')) {
                DB::statement('ALTER TABLE `incident_reports` DROP COLUMN `user_id`');
            }
            
            if (Schema::hasColumn('incident_reports', 'title')) {
                DB::statement('ALTER TABLE `incident_reports` DROP COLUMN `title`');
            }
        }
    }
};

