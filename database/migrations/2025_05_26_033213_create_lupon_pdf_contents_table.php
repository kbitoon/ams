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
        Schema::create('lupon_pdf_contents', function (Blueprint $table) {
            $table->id();
            $table->string('left_logo')->nullable();
            $table->string('right_logo')->nullable();
            $table->string('captain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lupon_pdf_contents');
    }
};
