<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lupon Cases
        if (Schema::hasTable('lupon_cases')) {
            Schema::table('lupon_cases', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_cases', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Lupon Case Complainants
        if (Schema::hasTable('lupon_cases_complainants')) {
            Schema::table('lupon_cases_complainants', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_cases_complainants', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Lupon Case Respondents
        if (Schema::hasTable('lupon_cases_respondents')) {
            Schema::table('lupon_cases_respondents', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_cases_respondents', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Blotters
        if (Schema::hasTable('blotters')) {
            Schema::table('blotters', function (Blueprint $table) {
                if (!Schema::hasColumn('blotters', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Complainees
        if (Schema::hasTable('complainees')) {
            Schema::table('complainees', function (Blueprint $table) {
                if (!Schema::hasColumn('complainees', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('lupon_cases')) {
            Schema::table('lupon_cases', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_cases', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('lupon_cases_complainants')) {
            Schema::table('lupon_cases_complainants', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_cases_complainants', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('lupon_cases_respondents')) {
            Schema::table('lupon_cases_respondents', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_cases_respondents', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('blotters')) {
            Schema::table('blotters', function (Blueprint $table) {
                if (Schema::hasColumn('blotters', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('complainees')) {
            Schema::table('complainees', function (Blueprint $table) {
                if (Schema::hasColumn('complainees', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }
    }
};
