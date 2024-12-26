<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class FacilitySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'facility_id',
        'name',
        'start',
        'end',
        'purpose',
        'status',
        'is_approved',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
 