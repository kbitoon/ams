<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class FacilitySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'name',
        'start',
        'end',
        'purpose',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
 