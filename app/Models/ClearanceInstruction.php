<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceInstruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    /**
     * Get the current instruction content
     */
    public static function getContent(): string
    {
        $instruction = self::first();
        return $instruction ? $instruction->content : '';
    }

    /**
     * Update or create instruction
     */
    public static function updateContent(string $content): void
    {
        self::updateOrCreate(
            ['id' => 1],
            ['content' => $content]
        );
    }
}

