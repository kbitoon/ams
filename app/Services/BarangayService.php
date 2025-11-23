<?php

namespace App\Services;

class BarangayService
{
    /**
     * Get the current barangay ID from environment
     */
    public static function getCurrentBarangayId(): ?int
    {
        $barangayId = env('BARANGAY_ID');
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
     */
    public static function getCurrentBarangayName(): string
    {
        return env('BARANGAY_NAME', 'Barangay');
    }
}

