<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class LuponCaseComplainant extends Model
{
    use HasFactory;

    protected $fillable = [   
        'lupon_case_id',
        'firstname',
        'middlename',
        'lastname',
        'contact_number',
        'address',
    ];


    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
