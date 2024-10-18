<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;

class UserStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'total',
    ];

}
