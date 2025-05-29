<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfContent extends Model
{
    use HasFactory;

    protected $table = 'lupon_pdf_contents';

    protected $fillable = [
        'header',
        'captain',
    ];
}
