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
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('contact_number', 11);
            $table->string('birthdate')->nullable();
            $table->string('father_firstname')->nullable();
            $table->string('father_lastname')->nullable();
            $table->string('mother_firstname')->nullable();
            $table->string('mother_lastname')->nullable();
            $table->string('address')->nullable();
            $table->string('sitio')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('occupation')->nullable();
            $table->float('income')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('education')->nullable();
            $table->string('financial_assistance')->nullable();
            $table->string('living_in_danger_zone')->nullable();
            $table->string('registered_voter')->nullable();
            $table->string('emergency_contact_1')->nullable();
            $table->string('emergency_contact_2')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_informations');
    }
};
