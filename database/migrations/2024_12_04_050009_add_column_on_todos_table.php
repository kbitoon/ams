<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->after('user_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('assigned_user_id')->nullable()->after('role_id');
            $table->foreign('assigned_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['assigned_user_id']);
            $table->dropColumn(['role_id', 'assigned_user_id']);
        });
    }
};

