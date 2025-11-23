<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisasterEvent extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'disaster_type_id',
        'title',
        'description',
        'status',
        'severity',
        'start_date',
        'end_date',
        'location',
        'latitude',
        'longitude',
        'affected_areas',
        'estimated_affected_population',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'affected_areas' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function disasterType(): BelongsTo
    {
        return $this->belongsTo(DisasterType::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(DisasterAlert::class);
    }

    public function monitoringLogs(): HasMany
    {
        return $this->hasMany(DisasterMonitoringLog::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(DisasterResource::class);
    }

    public function recoveryActivities(): HasMany
    {
        return $this->hasMany(DisasterRecoveryActivity::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(DisasterReport::class);
    }

    public function checklistCompletions(): HasMany
    {
        return $this->hasMany(ChecklistCompletion::class);
    }

    public function activeAlerts()
    {
        return $this->alerts()->where('is_active', true);
    }
}

