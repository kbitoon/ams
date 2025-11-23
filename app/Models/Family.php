<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'head_of_family_id',
        'family_name',
        'address',
        'sitio',
        'notes',
    ];

    public function headOfFamily(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_of_family_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function reliefDistributions(): HasMany
    {
        return $this->hasMany(ReliefDistribution::class);
    }

    /**
     * Get all users in this family
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, FamilyMember::class, 'family_id', 'id', 'id', 'user_id');
    }
}

