<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisasterResponseTeam extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $fillable = [
        'barangay_id',
        'name',
        'description',
        'team_leader_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function teamLeader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(DisasterResponseTeamMember::class, 'team_id');
    }

    public function activeMembers(): HasMany
    {
        return $this->members()->where('is_active', true);
    }
}

