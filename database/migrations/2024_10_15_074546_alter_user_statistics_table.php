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
        Schema::table('user_statistics', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'age']);
            $table->integer('total')->after('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_statistics', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
};
