<?php

namespace App\Services;

class BarangayService
{
    /**
     * Get the current barangay ID from environment
     * Uses config() instead of env() for better caching support
     */
    public static function getCurrentBarangayId(): ?int
    {
        // Use config() instead of env() to support config caching
        $barangayId = config('barangay.id');
        return $barangayId ? (int) $barangayId : null;
    }

    /**
     * Check if barangay ID is set
     */
    public static function hasBarangayId(): bool
    {
        return !is_null(self::getCurrentBarangayId());
    }

    /**
     * Get barangay name from environment
     * Uses config() instead of env() for better caching support
     */
    public static function getCurrentBarangayName(): string
    {
        return config('barangay.name', 'Barangay');
    }
}

