<?php

namespace App\Models\Concerns;

use App\Services\BarangayService;
use Illuminate\Database\Eloquent\Model;

trait BelongsToBarangay
{
    /**
     * Boot the trait
     */
    protected static function bootBelongsToBarangay(): void
    {
        // Add global scope
        static::addGlobalScope(new HasBarangayScope);

        // Auto-set barangay_id on create
        static::creating(function (Model $model) {
            if (empty($model->barangay_id)) {
                $model->barangay_id = BarangayService::getCurrentBarangayId();
            }
        });
    }

    /**
     * Scope a query to include all barangays (bypass scope)
     */
    public function scopeAllBarangays($query)
    {
        return $query->withoutGlobalScope(HasBarangayScope::class);
    }

    /**
     * Scope a query to a specific barangay
     */
    public function scopeForBarangay($query, int $barangayId)
    {
        return $query->withoutGlobalScope(HasBarangayScope::class)
                     ->where($query->getModel()->getTable() . '.barangay_id', $barangayId);
    }
}

