<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
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
