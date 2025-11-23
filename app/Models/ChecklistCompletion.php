<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChecklistCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_id',
        'disaster_event_id',
        'completed_by',
        'completed_items',
        'notes',
        'completed_at',
    ];

    protected $casts = [
        'completed_items' => 'array',
        'completed_at' => 'datetime',
    ];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(PreparednessChecklist::class, 'checklist_id');
    }

    public function disasterEvent(): BelongsTo
    {
        return $this->belongsTo(DisasterEvent::class);
    }

    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}

