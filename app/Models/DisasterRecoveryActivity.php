<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisasterRecoveryActivity extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'disaster_event_id',
        'activity_type',
        'title',
        'description',
        'location',
        'responsible_person_id',
        'assigned_team_id',
        'start_date',
        'target_completion_date',
        'actual_completion_date',
        'status',
        'budget',
        'actual_cost',
        'progress_percentage',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'target_completion_date' => 'date',
        'actual_completion_date' => 'date',
        'budget' => 'decimal:2',
        'actual_cost' => 'decimal:2',
    ];

    public function disasterEvent(): BelongsTo
    {
        return $this->belongsTo(DisasterEvent::class);
    }

    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_person_id');
    }

    public function assignedTeam(): BelongsTo
    {
        return $this->belongsTo(DisasterResponseTeam::class, 'assigned_team_id');
    }
}

