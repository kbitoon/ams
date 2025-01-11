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
        Schema::create('lupon_hearing_tracking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lupon_case_id');
            $table->foreign('lupon_case_id')->references('id')->on('lupon_cases');
            $table->datetime('date_time');
            $table->string('type');
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lupon_hearing_tracking');
    }
};
