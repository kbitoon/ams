<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type_id',
        'purpose',
        'amount',
        'date',
        'notes',
        'contact_number',
        'approved_by',
        'status',
    ];
}
