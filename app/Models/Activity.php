<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'bis_activities';
    protected $fillable = [
        'title',
        'start',
        'end',
        'description',
        'location',
    ];

}
