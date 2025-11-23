<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisasterMonitoringLog extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'disaster_event_id',
        'logged_by',
        'log_type',
        'title',
        'description',
        'location',
        'casualties',
        'damage_assessment',
        'weather_conditions',
        'photos',
        'logged_at',
    ];

    protected $casts = [
        'casualties' => 'array',
        'damage_assessment' => 'array',
        'photos' => 'array',
        'logged_at' => 'datetime',
    ];

    public function disasterEvent(): BelongsTo
    {
        return $this->belongsTo(DisasterEvent::class);
    }

    public function loggedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'logged_by');
    }
}

