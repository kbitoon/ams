<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignIq extends Model
{
    use HasFactory;

    protected $table = 'campaign_iqs';

    protected $fillable = [
        'firstname',
        'familyname',
        'birthdate',
        'address',
        'sitio',
        'barangay',
        'city',
        'province',
        'contact_number',
        'upline',
        'designation',
        'government_position',
        'sector',
        'remarks',
        'status',
        'commitment',
    ];

    public $timestamps = true;
}
