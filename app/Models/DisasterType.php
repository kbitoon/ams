<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisasterType extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'name',
        'description',
        'severity_levels',
        'is_active',
    ];

    protected $casts = [
        'severity_levels' => 'array',
        'is_active' => 'boolean',
    ];

    public function disasterEvents(): HasMany
    {
        return $this->hasMany(DisasterEvent::class);
    }

    public function preparednessPlans(): HasMany
    {
        return $this->hasMany(DisasterPreparednessPlan::class);
    }

    public function preparednessChecklists(): HasMany
    {
        return $this->hasMany(PreparednessChecklist::class);
    }
}

