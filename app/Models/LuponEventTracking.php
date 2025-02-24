<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponEventTracking extends Model
{
    use HasFactory;

    protected $table = 'lupon_event_tracking';
    protected $fillable = [   
        'user_id',
        'event_description',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

 /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
