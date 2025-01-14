<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponCase extends Model
{
    use HasFactory;

    protected $fillable = [   
        'date',
        'case_no',
        'complaint',
        'prayer',
        'status',
        'blotter_id',
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

    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
