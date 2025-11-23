<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class Information extends Model
{
    use HasFactory, BelongsToBarangay;

    const EXCERPT_LENGTH = 100;

    protected $fillable = [
        'barangay_id',
        'title',
        'content',
        'user_id',
        'category_id',
        'is_pinned',
        'public',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(InformationCategory::class);
    }

    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

    /**
     * @return string
     */
    public function excerpt($limit = null)
    {

        return Str::limit($this->content, is_null($limit) ? Information::EXCERPT_LENGTH : $limit);
    }
}
