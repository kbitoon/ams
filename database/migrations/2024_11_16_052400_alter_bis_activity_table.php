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
        Schema::table('bis_activities', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('description')->nullable()->change();
            $table->string('location')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bis_activities', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->text('description')->nullable(false)->change();
            $table->string('location')->nullable(false)->change();
        });
    }
};
