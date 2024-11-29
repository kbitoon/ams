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
        Schema::table('complainees', function (Blueprint $table) {
            $table->string('middle')->nullable()->change();
            $table->string('contact')->nullable()->change();
            $table->string('civil_status')->nullable()->change();
            $table->string('date_of_birth')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('influence')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complainees', function (Blueprint $table) {
            $table->dropColumn(['middle']);
            $table->dropColumn(['contact']);
            $table->dropColumn(['civil_status']);
            $table->dropColumn(['date_of_birth']);
            $table->dropColumn(['address']);
            $table->dropColumn(['influence']);
        });
    }
};
