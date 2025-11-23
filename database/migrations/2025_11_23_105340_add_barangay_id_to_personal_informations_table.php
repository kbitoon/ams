<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_informations', function (Blueprint $table) {
            if (!Schema::hasColumn('personal_informations', 'barangay_id')) {
                $table->unsignedBigInteger('barangay_id')->nullable()->after('id');
                $table->index('barangay_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('personal_informations', function (Blueprint $table) {
            if (Schema::hasColumn('personal_informations', 'barangay_id')) {
                $table->dropIndex(['barangay_id']);
                $table->dropColumn('barangay_id');
            }
        });
    }
};
