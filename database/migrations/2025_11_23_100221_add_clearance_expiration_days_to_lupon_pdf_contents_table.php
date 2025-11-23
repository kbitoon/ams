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
        Schema::table('lupon_pdf_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('lupon_pdf_contents', 'clearance_expiration_days')) {
                $table->integer('clearance_expiration_days')->default(30)->after('captain');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lupon_pdf_contents', function (Blueprint $table) {
            if (Schema::hasColumn('lupon_pdf_contents', 'clearance_expiration_days')) {
                $table->dropColumn('clearance_expiration_days');
            }
        });
    }
};
