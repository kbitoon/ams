<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponHearingTracking extends Model
{
    use HasFactory;

    protected $table = 'lupon_hearing_tracking';
    protected $fillable = [   
        'lupon_case_id',
        'date_time',
        'type',
        'remarks',
        'secretary',
        'presider',
    ];

    public function luponCase(): BelongsTo
    {
        return $this->belongsTo(LuponCase::class);
    }
 /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
