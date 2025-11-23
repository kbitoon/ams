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
        // Also, for User model during authentication, we need to handle it differently
        if ($barangayId) {
            // For User model, allow NULL barangay_id during authentication
            // but still filter by barangay_id if it's set
            if ($model instanceof \App\Models\User) {
                // Allow users with matching barangay_id OR NULL barangay_id (for existing users)
                $builder->where(function ($query) use ($barangayId, $model) {
                    $query->where($model->getTable() . '.barangay_id', $barangayId)
                          ->orWhereNull($model->getTable() . '.barangay_id');
                });
            } else {
                // For other models, strict filtering
                $builder->where($model->getTable() . '.barangay_id', $barangayId);
            }
        }
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

