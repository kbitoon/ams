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
            $table->string('birthdate');
            $table->string('father_firstname');
            $table->string('father_lastname');
            $table->string('mother_firstname');
            $table->string('mother_lastname');
            $table->string('address');
            $table->string('sitio');
            $table->string('blood_type');
            $table->string('occupation');
            $table->float('income');
            $table->string('civil_status');
            $table->string('education');
            $table->string('financial_assistance');
            $table->string('living_in_danger_zone');
            $table->string('registered_voter');
            $table->string('emergency_contact_1');
            $table->string('emergency_contact_2');
            $table->float('weight');
            $table->float('height');
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
