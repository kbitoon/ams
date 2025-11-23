<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $barangayId = 1;
        
        // List of all tables with barangay_id column
        $tables = [
            'users',
            'clearances',
            'complaints',
            'information',
            'announcements',
            'todos',
            'personal_informations',
            'clearance_types',
            'announcement_categories',
            'information_categories',
            'complaint_categories',
            'item_categories',
            'lupon_pdf_contents',
            'items',
            'item_schedules',
            'vehicles',
            'vehicle_schedules',
            'facilities',
            'facility_schedules',
            'lupon_cases',
            'lupon_cases_complainants',
            'lupon_cases_respondents',
            'blotters',
            'complainees',
            'incident_reports',
            'bis_activities',
            'user_statistics',
            'lupon_event_tracking',
            'lupon_case_comments',
            'lupon_summon_tracking',
            'lupon_hearing_tracking',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'barangay_id')) {
                // Update all records where barangay_id is NULL to 1
                DB::table($table)
                    ->whereNull('barangay_id')
                    ->update(['barangay_id' => $barangayId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration cannot be safely reversed
        // as we cannot determine which records originally had NULL barangay_id
    }
};
