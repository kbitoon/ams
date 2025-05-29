<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lupon_pdf_contents', function (Blueprint $table) {
            $table->renameColumn('left_logo', 'header');
            $table->dropColumn('right_logo');
        });
    }

    public function down(): void
    {
        Schema::table('lupon_pdf_contents', function (Blueprint $table) {
            $table->renameColumn('header', 'left_logo');
            $table->string('right_logo')->nullable();
        });
    }

};
