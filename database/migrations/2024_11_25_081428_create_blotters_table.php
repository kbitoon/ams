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
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('reported');
            $table->datetime('incident');
            $table->string('place');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middle');
            $table->string('contact');
            $table->string('civil');
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('place_of_birth')->nullable();
            $table->string('occupation')->nullable();
            $table->text('narration');
            $table->unsignedBigInteger('recorded_by')->nullable();
            $table->foreign('recorded_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('complainee_id')->nullable();
            $table->foreign('complainee_id')->references('id')->on('complainees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};
