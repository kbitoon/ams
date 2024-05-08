<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'assetable_type',
        'assetable_id',
    ];

    /**
     * @return MorphTo
     */
    public function assetable(): MorphTo
    {
        return $this->morphTo();
    }
}
