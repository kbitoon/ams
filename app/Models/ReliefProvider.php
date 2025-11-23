<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReliefProvider extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'name',
        'type',
        'contact_person',
        'contact_number',
        'email',
        'address',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function reliefOperations(): HasMany
    {
        return $this->hasMany(ReliefOperation::class);
    }

    public function reliefItems(): HasMany
    {
        return $this->hasMany(ReliefItem::class);
    }
}

