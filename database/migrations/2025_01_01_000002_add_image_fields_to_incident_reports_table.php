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
            Schema::table('incident_reports', function (Blueprint $table) {
                if (!Schema::hasColumn('incident_reports', 'image_path')) {
                    $table->string('image_path')->nullable()->after('narration');
                }
                if (!Schema::hasColumn('incident_reports', 'image_position')) {
                    $table->enum('image_position', ['before', 'after'])->default('before')->after('image_path');
                }
            });
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

