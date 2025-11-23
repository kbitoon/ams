<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'name',
        'description',
        'status',
        'calendar_color',
    ];

     /**
     * @return HasMany
     */
    public function vehicleSchedule(): HasMany
    {
        return $this->hasMany(VehicleSchedule::class);
    }

}
