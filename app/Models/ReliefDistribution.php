<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReliefDistribution extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'relief_operation_id',
        'relief_item_id',
        'distribution_type',
        'user_id',
        'family_id',
        'head_of_family_id',
        'quantity',
        'amount',
        'purpose',
        'notes',
        'distributed_by',
        'distributed_at',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'amount' => 'decimal:2',
        'distributed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($distribution) {
            $item = $distribution->reliefItem;
            $item->quantity_distributed += $distribution->quantity;
            $item->save();
        });

        static::updated(function ($distribution) {
            $item = $distribution->reliefItem;
            $oldQuantity = $distribution->getOriginal('quantity');
            $newQuantity = $distribution->quantity;
            $item->quantity_distributed += ($newQuantity - $oldQuantity);
            $item->save();
        });

        static::deleted(function ($distribution) {
            $item = $distribution->reliefItem;
            $item->quantity_distributed -= $distribution->quantity;
            $item->save();
        });
    }

    public function reliefOperation(): BelongsTo
    {
        return $this->belongsTo(ReliefOperation::class);
    }

    public function reliefItem(): BelongsTo
    {
        return $this->belongsTo(ReliefItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function headOfFamily(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_of_family_id');
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'distributed_by');
    }

    /**
     * Get the recipient name (individual or family)
     */
    public function getRecipientNameAttribute(): string
    {
        if ($this->distribution_type === 'family') {
            return $this->family?->headOfFamily?->name . ' (Family)' ?? 'Unknown Family';
        }
        return $this->user?->name ?? 'Unknown';
    }
}

