<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
