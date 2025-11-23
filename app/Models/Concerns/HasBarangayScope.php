<?php

namespace App\Models\Concerns;

use App\Services\BarangayService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class HasBarangayScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $barangayId = BarangayService::getCurrentBarangayId();
        
        // Don't apply scope if BARANGAY_ID is not set (for backward compatibility)
        if (!$barangayId) {
            return;
        }
        
        // Strict filtering for all models - only show records with matching barangay_id
        // This ensures proper multi-tenancy isolation
        $builder->where($model->getTable() . '.barangay_id', $barangayId);
    }

    /**
     * Extend the query builder with the needed functions.
     */
    public function extend(Builder $builder): void
    {
        $builder->macro('withoutBarangayScope', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}

