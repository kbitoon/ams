<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id ',
        'reported',
        'incident',
        'place',
        'lastname',
        'firstname',
        'middle',
        'contact',
        'civil',
        'date_of_birth',
        'address',
        'place_of_birth',
        'occupation',
        'narration',
        'recorded_by',
        'complainee_id',
    ];

     /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
     /**
     * @return BelongsTo
     */
    public function complainee(): BelongsTo
    {
        return $this->belongsTo(Complainee::class);
    }

}
