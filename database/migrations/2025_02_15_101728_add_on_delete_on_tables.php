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
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases')
                  ->onDelete('cascade');
        });

        Schema::table('lupon_cases_complainants', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases')
                  ->onDelete('cascade');
        });

        Schema::table('lupon_cases_respondents', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases')
                  ->onDelete('cascade');
        });

        Schema::table('lupon_summon_tracking', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lupon_hearing_tracking', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases');
        });

        Schema::table('lupon_cases_complainants', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases');
        });

        // Reverse changes for `some_other_table`
        Schema::table('lupon_cases_respondents', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases');
        });

        Schema::table('lupon_summon_tracking', function (Blueprint $table) {
            $table->dropForeign(['lupon_case_id']);
            $table->foreign('lupon_case_id')
                  ->references('id')
                  ->on('lupon_cases');
        });
    }
};
