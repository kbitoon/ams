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
        // Disaster Types
        Schema::create('disaster_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('severity_levels')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
        });

        // Disaster Events
        Schema::create('disaster_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_type_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'active', 'resolved', 'cancelled'])->default('draft');
            $table->enum('severity', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('affected_areas')->nullable();
            $table->integer('estimated_affected_population')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('status');
            $table->index('start_date');
        });

        // Disaster Preparedness Plans
        Schema::create('disaster_preparedness_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_type_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('plan_type', ['evacuation', 'communication', 'resource_allocation', 'emergency_response', 'recovery', 'other'])->default('other');
            $table->text('procedures')->nullable();
            $table->foreignId('responsible_person_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('last_reviewed_date')->nullable();
            $table->date('next_review_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
        });

        // Preparedness Checklists
        Schema::create('preparedness_checklists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_type_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
        });

        // Preparedness Checklist Items
        Schema::create('preparedness_checklist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_id')->constrained('preparedness_checklists')->onDelete('cascade');
            $table->string('item');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });

        // Checklist Completions (for tracking when checklists are completed)
        Schema::create('checklist_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_id')->constrained('preparedness_checklists')->onDelete('cascade');
            $table->foreignId('disaster_event_id')->nullable()->constrained('disaster_events')->onDelete('cascade');
            $table->foreignId('completed_by')->constrained('users')->onDelete('cascade');
            $table->json('completed_items'); // Array of checklist_item_ids
            $table->text('notes')->nullable();
            $table->dateTime('completed_at');
            $table->timestamps();
            
            $table->index('checklist_id');
            $table->index('disaster_event_id');
        });

        // Evacuation Centers
        Schema::create('evacuation_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->string('name');
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('capacity');
            $table->json('facilities')->nullable();
            $table->foreignId('contact_person_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('contact_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
        });

        // Disaster Response Teams
        Schema::create('disaster_response_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('team_leader_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
        });

        // Disaster Response Team Members
        Schema::create('disaster_response_team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('disaster_response_teams')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('role', ['member', 'deputy_leader'])->default('member');
            $table->string('specialization')->nullable();
            $table->string('contact_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['team_id', 'user_id']);
        });

        // Disaster Alerts/Warnings
        Schema::create('disaster_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_event_id')->nullable()->constrained('disaster_events')->onDelete('cascade');
            $table->enum('alert_type', ['warning', 'watch', 'advisory', 'evacuation'])->default('advisory');
            $table->enum('severity', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->string('title');
            $table->text('message');
            $table->json('affected_areas')->nullable();
            $table->foreignId('issued_by')->constrained('users')->onDelete('cascade');
            $table->dateTime('issued_at');
            $table->dateTime('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('disaster_event_id');
            $table->index('is_active');
            $table->index('issued_at');
        });

        // Disaster Monitoring Logs
        Schema::create('disaster_monitoring_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_event_id')->constrained('disaster_events')->onDelete('cascade');
            $table->foreignId('logged_by')->constrained('users')->onDelete('cascade');
            $table->enum('log_type', ['situation_update', 'resource_status', 'casualty_report', 'damage_assessment', 'weather_update'])->default('situation_update');
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->json('casualties')->nullable(); // {injured: 0, missing: 0, deceased: 0}
            $table->json('damage_assessment')->nullable(); // {houses_damaged: 0, infrastructure: "text"}
            $table->text('weather_conditions')->nullable();
            $table->json('photos')->nullable();
            $table->dateTime('logged_at');
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('disaster_event_id');
            $table->index('logged_at');
        });

        // Disaster Resources
        Schema::create('disaster_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_event_id')->nullable()->constrained('disaster_events')->onDelete('cascade');
            $table->enum('resource_type', ['equipment', 'vehicle', 'facility', 'personnel', 'supplies'])->default('equipment');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('quantity', 10, 2)->default(1);
            $table->string('unit')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['available', 'in_use', 'damaged', 'unavailable'])->default('available');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assigned_team_id')->nullable()->constrained('disaster_response_teams')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('disaster_event_id');
            $table->index('status');
        });

        // Disaster Recovery Activities
        Schema::create('disaster_recovery_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_event_id')->constrained('disaster_events')->onDelete('cascade');
            $table->enum('activity_type', ['cleanup', 'reconstruction', 'rehabilitation', 'assistance_distribution', 'infrastructure_repair', 'other'])->default('other');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('responsible_person_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assigned_team_id')->nullable()->constrained('disaster_response_teams')->onDelete('set null');
            $table->date('start_date');
            $table->date('target_completion_date')->nullable();
            $table->date('actual_completion_date')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'cancelled'])->default('planned');
            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('actual_cost', 15, 2)->nullable();
            $table->integer('progress_percentage')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('disaster_event_id');
            $table->index('status');
        });

        // Disaster Reports
        Schema::create('disaster_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id')->nullable();
            $table->foreignId('disaster_event_id')->constrained('disaster_events')->onDelete('cascade');
            $table->enum('report_type', ['situation', 'damage_assessment', 'recovery_progress', 'final'])->default('situation');
            $table->string('title');
            $table->text('content');
            $table->foreignId('generated_by')->constrained('users')->onDelete('cascade');
            $table->date('report_date');
            $table->json('attachments')->nullable();
            $table->timestamps();
            
            $table->index('barangay_id');
            $table->index('disaster_event_id');
            $table->index('report_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disaster_reports');
        Schema::dropIfExists('disaster_recovery_activities');
        Schema::dropIfExists('disaster_resources');
        Schema::dropIfExists('disaster_monitoring_logs');
        Schema::dropIfExists('disaster_alerts');
        Schema::dropIfExists('disaster_response_team_members');
        Schema::dropIfExists('disaster_response_teams');
        Schema::dropIfExists('evacuation_centers');
        Schema::dropIfExists('checklist_completions');
        Schema::dropIfExists('preparedness_checklist_items');
        Schema::dropIfExists('preparedness_checklists');
        Schema::dropIfExists('disaster_preparedness_plans');
        Schema::dropIfExists('disaster_events');
        Schema::dropIfExists('disaster_types');
    }
};

