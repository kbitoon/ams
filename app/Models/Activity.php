<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'location',
        'barangay',
        'district',
    ];

    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
