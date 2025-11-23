<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Families/Households Table
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->unsignedBigInteger('head_of_family_id'); // User ID of the head
            $table->string('family_name')->nullable(); // Optional family identifier
            $table->string('address')->nullable();
            $table->string('sitio')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('head_of_family_id');
            $table->foreign('head_of_family_id')->references('id')->on('users')->onDelete('restrict');
        });

        // Family Members (to track all members of a family)
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('user_id');
            $table->string('relationship')->nullable(); // e.g., "Head", "Spouse", "Child", "Parent", etc.
            $table->boolean('is_head')->default(false);
            $table->timestamps();
            
            $table->unique(['family_id', 'user_id']); // A user can only be in a family once
            $table->index('barangay_id');
            $table->index('family_id');
            $table->index('user_id');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Relief Types (e.g., Food Pack, Cash Assistance, Medical Supplies, etc.)
        Schema::create('relief_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->string('name');
            $table->string('unit')->nullable(); // e.g., "pack", "peso", "kg", "piece"
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
        });

        // Relief Operations (Main operation/event)
        Schema::create('relief_operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('purpose')->nullable(); // e.g., "Typhoon Relief", "COVID-19 Assistance", "Fire Victims"
            $table->date('operation_date');
            $table->string('status')->default('active'); // active, completed, cancelled
            $table->boolean('is_per_family')->default(false); // Whether this operation distributes per family
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('operation_date');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });

        // Relief Items (Inventory of relief goods)
        Schema::create('relief_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->unsignedBigInteger('relief_operation_id');
            $table->unsignedBigInteger('relief_type_id');
            $table->decimal('quantity_received', 15, 2)->default(0);
            $table->decimal('quantity_distributed', 15, 2)->default(0);
            $table->decimal('quantity_remaining', 15, 2)->default(0);
            $table->decimal('unit_cost', 15, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('relief_operation_id');
            $table->foreign('relief_operation_id')->references('id')->on('relief_operations')->onDelete('cascade');
            $table->foreign('relief_type_id')->references('id')->on('relief_types')->onDelete('restrict');
        });

        // Relief Distributions (Who received what, when, how much)
        Schema::create('relief_distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->unsignedBigInteger('relief_operation_id');
            $table->unsignedBigInteger('relief_item_id');
            $table->string('distribution_type')->default('individual'); // 'individual' or 'family'
            $table->unsignedBigInteger('user_id')->nullable(); // Individual recipient OR representative who received
            $table->unsignedBigInteger('family_id')->nullable(); // Family that received (if distribution_type = 'family')
            $table->unsignedBigInteger('head_of_family_id')->nullable(); // Head of family (for family distributions)
            $table->decimal('quantity', 15, 2);
            $table->decimal('amount', 15, 2)->nullable(); // If cash assistance
            $table->text('purpose')->nullable(); // Specific reason for this distribution
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('distributed_by')->nullable(); // Staff who distributed
            $table->timestamp('distributed_at');
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('relief_operation_id');
            $table->index('user_id');
            $table->index('family_id');
            $table->index('distributed_at');
            $table->foreign('relief_operation_id')->references('id')->on('relief_operations')->onDelete('cascade');
            $table->foreign('relief_item_id')->references('id')->on('relief_items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('restrict');
            $table->foreign('head_of_family_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('distributed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relief_distributions');
        Schema::dropIfExists('relief_items');
        Schema::dropIfExists('relief_operations');
        Schema::dropIfExists('relief_types');
        Schema::dropIfExists('family_members');
        Schema::dropIfExists('families');
    }
};

