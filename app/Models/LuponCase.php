<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponCase extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [   
        'barangay_id',
        'date',
        'case_no',
        'title',
        'nature',
        'complaint',
        'prayer',
        'status',
        'settled',
        'blotter_id',
        'end',
    ];


    /**
     * @return BelongsTo
     */
    public function blotter(): BelongsTo
    {
        return $this->belongsTo(Blotter::class);
    }

    public function luponCaseComments(): HasMany
    {
        return $this->hasMany(LuponCaseComment::class);
    }

    public function luponCaseComplainants(): HasMany
    {
        return $this->hasMany(LuponCaseComplainant::class);
    }

    public function luponCaseRespondents(): HasMany
    {
        return $this->hasMany(LuponCaseRespondent::class);
    }

    public function luponSummonTrackings(): HasMany
    {
        return $this->hasMany(LuponSummonTracking::class);
    }

    public function luponHearingTrackings(): HasMany
    {
        return $this->hasMany(LuponHearingTracking::class);
    }
    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
