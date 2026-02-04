<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LuponCase extends Model
{
    use HasFactory, BelongsToBarangay;

    /**
     * Generate the next chronological case number for the given date.
     * Format: YYYY-NNNN (e.g. 2025-0001). Sequence is per year and respects barangay scope.
     */
    public static function generateNextCaseNo(string $date): string
    {
        $year = Carbon::parse($date)->year;
        $count = static::whereYear('date', $year)->count();

        return $year . '-' . str_pad((string) ($count + 1), 4, '0', STR_PAD_LEFT);
    }

    protected $fillable = [   
        'barangay_id',
        'date',
        'case_no',
        'title',
        'nature',
        'complaint',
        'prayer',
        'status',
        'settled',
        'blotter_id',
        'end',
    ];


    /**
     * @return BelongsTo
     */
    public function blotter(): BelongsTo
    {
        return $this->belongsTo(Blotter::class);
    }

    public function luponCaseComments(): HasMany
    {
        return $this->hasMany(LuponCaseComment::class);
    }

    public function luponCaseComplainants(): HasMany
    {
        return $this->hasMany(LuponCaseComplainant::class);
    }

    public function luponCaseRespondents(): HasMany
    {
        return $this->hasMany(LuponCaseRespondent::class);
    }

    public function luponSummonTrackings(): HasMany
    {
        return $this->hasMany(LuponSummonTracking::class);
    }

    public function luponHearingTrackings(): HasMany
    {
        return $this->hasMany(LuponHearingTracking::class);
    }
    /**
     * @return MorphMany
     */
    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
