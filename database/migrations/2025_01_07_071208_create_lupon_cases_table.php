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
        Schema::create('lupon_cases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('case_no')->nullable();
            $table->text('complaint');
            $table->text('prayer');
            $table->string('status');
            $table->unsignedBigInteger('blotter_id');
            $table->foreign('blotter_id')->references('id')->on('blotters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lupon_cases');
    }
};
