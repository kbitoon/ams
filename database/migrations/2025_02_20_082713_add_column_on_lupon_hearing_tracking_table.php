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
        Schema::table('lupon_hearing_tracking', function (Blueprint $table) {
            $table->string('secretary')->nullable();
            $table->string('presider')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lupon_hearing_tracking', function (Blueprint $table) {
            $table->dropColumn(['secretary']);
            $table->dropColumn(['presider']);
        });
    }
};