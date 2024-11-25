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
        Schema::create('complainees', function (Blueprint $table) {
            $table->id();
            $table->string('first');
            $table->string('last');
            $table->string('middle');
            $table->string('civil_status');
            $table->date('date_of_birth');
            $table->date('place_of_birth')->nullable();
            $table->string('address');
            $table->string('occupation')->nullable();
            $table->string('influence');
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complainees');
    }
};
