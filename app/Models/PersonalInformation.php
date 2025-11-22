<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $table = 'personal_informations';

    protected $fillable = [
        'user_id',
       'contact_number',
        'birthdate',
        'father_firstname',
        'father_lastname',
        'mother_firstname',
        'mother_lastname',
        'address',
        'sitio',
        'blood_type',
        'willing_blood_donor',
        'occupation',
        'income',
        'civil_status',
        'education',
        'financial_assistance',
        'living_in_danger_zone',
        'registered_voter',
        'emergency_contact_person',
        'emergency_contact_number',
        'weight',
        'height',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
