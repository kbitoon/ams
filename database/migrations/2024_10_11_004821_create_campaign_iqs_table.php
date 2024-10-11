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
        Schema::create('campaign_iqs', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('familyname');
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('sitio')->nullable();
            $table->string('barangay');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('contact_number');
            $table->string('upline')->nullable();
            $table->string('designation')->nullable();
            $table->string('government_position')->nullable();
            $table->string('sector')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_iqs');
    }
};
