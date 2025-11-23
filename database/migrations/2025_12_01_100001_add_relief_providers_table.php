<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Relief Providers/Entities Table (DSWD, NGOs, Private Organizations, etc.)
        Schema::create('relief_providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->string('name'); // e.g., "DSWD", "Red Cross", "Local NGO", "Private Donor"
            $table->string('type')->nullable(); // 'government', 'ngo', 'private', 'individual', 'other'
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('type');
        });

        // Add provider_id to relief_operations table
        Schema::table('relief_operations', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_id')->nullable()->after('created_by');
            $table->foreign('provider_id')->references('id')->on('relief_providers')->onDelete('set null');
            $table->index('provider_id');
        });

        // Optionally add provider_id to relief_items (if different providers provide different items)
        Schema::table('relief_items', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_id')->nullable()->after('relief_type_id');
            $table->foreign('provider_id')->references('id')->on('relief_providers')->onDelete('set null');
            $table->index('provider_id');
        });
    }

    public function down(): void
    {
        Schema::table('relief_items', function (Blueprint $table) {
            $table->dropForeign(['provider_id']);
            $table->dropColumn('provider_id');
        });

        Schema::table('relief_operations', function (Blueprint $table) {
            $table->dropForeign(['provider_id']);
            $table->dropColumn('provider_id');
        });

        Schema::dropIfExists('relief_providers');
    }
};

