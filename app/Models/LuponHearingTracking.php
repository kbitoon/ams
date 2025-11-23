<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponHearingTracking extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $table = 'lupon_hearing_tracking';
    protected $fillable = [   
        'barangay_id',
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
