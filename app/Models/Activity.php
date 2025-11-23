<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class Activity extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $table = 'bis_activities';
    protected $fillable = [
        'barangay_id',
        'title',
        'start',
        'end',
        'description',
        'location',
    ];

}
