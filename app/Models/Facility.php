<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Relations\BelongsTo;
use Illuminate\Database\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility',
        'location',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function facilitySchedule(): HasMany
    {
        return $this->hasMany(FacilitySchedule::class);
    }
}
