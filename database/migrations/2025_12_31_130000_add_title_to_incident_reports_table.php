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
            // Add user_id column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'user_id')) {
                Schema::table('incident_reports', function (Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable();
                });
                
                // Add foreign key after adding the column
                try {
                    Schema::table('incident_reports', function (Blueprint $table) {
                        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                    });
                } catch (\Exception $e) {
                    // Foreign key might already exist or users table doesn't exist, ignore
                }
            }
            
            // Add title column if it doesn't exist
            if (!Schema::hasColumn('incident_reports', 'title')) {
                Schema::table('incident_reports', function (Blueprint $table) {
                    $table->string('title')->nullable();
                });
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
                // Drop foreign key first if it exists
                try {
                    $table->dropForeign(['user_id']);
                } catch (\Exception $e) {
                    // Foreign key might not exist, ignore
                }
                
                if (Schema::hasColumn('incident_reports', 'user_id')) {
                    $table->dropColumn('user_id');
                }
                
                if (Schema::hasColumn('incident_reports', 'title')) {
                    $table->dropColumn('title');
                }
            });
        }
    }
};
