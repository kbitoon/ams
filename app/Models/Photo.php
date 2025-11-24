<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path']; // Allow mass assignment for the path attribute

    /**
     * Get the full URL to the photo
     */
    public function getUrlAttribute(): string
    {
        // Use Storage::url() which generates the correct URL based on filesystem config
        return Storage::disk('public')->url($this->path);
    }
}
