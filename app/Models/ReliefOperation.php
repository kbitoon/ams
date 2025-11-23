<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReliefOperation extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'title',
        'description',
        'purpose',
        'operation_date',
        'status',
        'is_per_family',
        'provider_id',
        'created_by',
    ];

    protected $casts = [
        'operation_date' => 'date',
        'is_per_family' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ReliefProvider::class);
    }

    public function reliefItems(): HasMany
    {
        return $this->hasMany(ReliefItem::class);
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(ReliefDistribution::class);
    }
}

