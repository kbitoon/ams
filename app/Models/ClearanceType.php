<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClearanceType extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'name',
        'amount',
        'requirement',
    ];

    /**
     * @return HasMany
     */
    public function clearances(): HasMany
    {
        return $this->hasMany(Clearance::class);
    }
}
