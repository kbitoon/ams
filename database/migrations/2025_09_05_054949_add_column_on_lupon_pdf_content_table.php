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
            $table->string('footer')->nullable()->after('captain');
            $table->string('watermark')->nullable()->after('footer');
        });
    }

    public function down(): void
    {
        Schema::table('lupon_pdf_contents', function (Blueprint $table) {
           $table->dropColumn(['footer', 'watermark']);
        });
    }

};
