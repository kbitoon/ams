<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Complainee extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'last',
        'first',
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
