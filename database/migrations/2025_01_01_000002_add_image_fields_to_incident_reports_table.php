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
                    // Try to add after 'narration' if it exists, otherwise after 'date', otherwise at the end
                    if (Schema::hasColumn('incident_reports', 'narration')) {
                        $table->string('image_path')->nullable()->after('narration');
                    } elseif (Schema::hasColumn('incident_reports', 'date')) {
                        $table->string('image_path')->nullable()->after('date');
                    } else {
                        $table->string('image_path')->nullable();
                    }
                }
                if (!Schema::hasColumn('incident_reports', 'image_position')) {
                    // Add after image_path if it exists, otherwise at the end
                    if (Schema::hasColumn('incident_reports', 'image_path')) {
                        $table->enum('image_position', ['before', 'after'])->default('before')->after('image_path');
                    } else {
                        $table->enum('image_position', ['before', 'after'])->default('before');
                    }
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

