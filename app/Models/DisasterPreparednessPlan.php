<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisasterPreparednessPlan extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'disaster_type_id',
        'title',
        'description',
        'plan_type',
        'procedures',
        'responsible_person_id',
        'last_reviewed_date',
        'next_review_date',
        'is_active',
    ];

    protected $casts = [
        'last_reviewed_date' => 'date',
        'next_review_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function disasterType(): BelongsTo
    {
        return $this->belongsTo(DisasterType::class);
    }

    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_person_id');
    }
}

