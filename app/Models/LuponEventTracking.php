<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponEventTracking extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $table = 'lupon_event_tracking';
    protected $fillable = [   
        'barangay_id',
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
