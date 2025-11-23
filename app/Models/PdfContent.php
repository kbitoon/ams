<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfContent extends Model
{
    use HasFactory, BelongsToBarangay;

    protected $table = 'lupon_pdf_contents';

    protected $fillable = [
        'barangay_id',
        'header',
        'captain',
        'footer',
        'watermark',
        'clearance_expiration_days',
    ];
}
