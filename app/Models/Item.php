<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'acquired',
        'name',
        'TotalQuantity',
        'QuantityLeft',
        'description',
        'AcquisitionCost',
        'category_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }
    
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

     /**
     * @return HasMany
     */
    public function itemSchedule(): HasMany
    {
        return $this->hasMany(ItemSchedule::class);
    }


}
