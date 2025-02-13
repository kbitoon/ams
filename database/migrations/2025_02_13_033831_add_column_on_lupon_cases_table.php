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
        Schema::table('lupon_cases', function (Blueprint $table) {
            $table->string('title')->nullable()->after('case_no');
            $table->string('nature')->nullable()->after('title');
            $table->date('end')->nullable()->after('blotter_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lupon_cases', function (Blueprint $table) {
            $table->dropColumn(['title']);
            $table->dropColumn(['nature']);
            $table->dropColumn(['end']);
        });
    }
};
