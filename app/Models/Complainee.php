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
        'lastname',
        'firstname',
        'middle',
        'contact',
        'civil_status',
        'date_of_birth',
        'address',
        'place_of_birth',
        'occupation',
        'influence',
    ];

    /**
     * @return HasMany
     */
    public function blotter(): HasMany
    {
        return $this->hasMany(Blotter::class);
    }
}
