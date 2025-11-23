<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Clearance extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'user_id',
        'name',
        'type_id',
        'purpose',
        'amount',
        'date',
        'notes',
        'contact_number',
        'approved_by',
        'status',
        'address',
        'date_of_birth',
        'sex',
        'civil_status',
        'precinct_no',
        'verification_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($clearance) {
            if (empty($clearance->verification_token)) {
                $clearance->verification_token = bin2hex(random_bytes(32));
            }
        });
    }

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
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ClearanceType::class);
    }

    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
