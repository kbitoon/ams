<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Clearance Types
        if (Schema::hasTable('clearance_types')) {
            Schema::table('clearance_types', function (Blueprint $table) {
                if (!Schema::hasColumn('clearance_types', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Announcement Categories
        if (Schema::hasTable('announcement_categories')) {
            Schema::table('announcement_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('announcement_categories', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Information Categories
        if (Schema::hasTable('information_categories')) {
            Schema::table('information_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('information_categories', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Complaint Categories
        if (Schema::hasTable('complaint_categories')) {
            Schema::table('complaint_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('complaint_categories', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Item Categories
        if (Schema::hasTable('item_categories')) {
            Schema::table('item_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('item_categories', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }

        // Lupon PDF Contents
        if (Schema::hasTable('lupon_pdf_contents')) {
            Schema::table('lupon_pdf_contents', function (Blueprint $table) {
                if (!Schema::hasColumn('lupon_pdf_contents', 'barangay_id')) {
                    $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                    $table->index('barangay_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('clearance_types')) {
            Schema::table('clearance_types', function (Blueprint $table) {
                if (Schema::hasColumn('clearance_types', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('announcement_categories')) {
            Schema::table('announcement_categories', function (Blueprint $table) {
                if (Schema::hasColumn('announcement_categories', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('information_categories')) {
            Schema::table('information_categories', function (Blueprint $table) {
                if (Schema::hasColumn('information_categories', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('complaint_categories')) {
            Schema::table('complaint_categories', function (Blueprint $table) {
                if (Schema::hasColumn('complaint_categories', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('item_categories')) {
            Schema::table('item_categories', function (Blueprint $table) {
                if (Schema::hasColumn('item_categories', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }

        if (Schema::hasTable('lupon_pdf_contents')) {
            Schema::table('lupon_pdf_contents', function (Blueprint $table) {
                if (Schema::hasColumn('lupon_pdf_contents', 'barangay_id')) {
                    $table->dropIndex(['barangay_id']);
                    $table->dropColumn('barangay_id');
                }
            });
        }
    }
};
