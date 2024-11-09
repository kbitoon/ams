<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'location',
        'barangay_list_id',
        'district',
    ];

    public function barangayList(): BelongsTo
    {
        return $this->belongsTo(BarangayList::class);
    }
}
