<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReliefItem extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'relief_operation_id',
        'relief_type_id',
        'provider_id',
        'quantity_received',
        'quantity_distributed',
        'quantity_remaining',
        'unit_cost',
        'notes',
    ];

    protected $casts = [
        'quantity_received' => 'decimal:2',
        'quantity_distributed' => 'decimal:2',
        'quantity_remaining' => 'decimal:2',
        'unit_cost' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->quantity_remaining = $item->quantity_received - $item->quantity_distributed;
        });
    }

    public function reliefOperation(): BelongsTo
    {
        return $this->belongsTo(ReliefOperation::class);
    }

    public function reliefType(): BelongsTo
    {
        return $this->belongsTo(ReliefType::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ReliefProvider::class);
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(ReliefDistribution::class);
    }
}

