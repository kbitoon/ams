<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreparednessChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_id',
        'item',
        'description',
        'order',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(PreparednessChecklist::class, 'checklist_id');
    }
}

