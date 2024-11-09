<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CampaignUser extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    // /**
    //  * @return HasMany
    //  */
    // public function campaignIqs(): HasMany
    // {
    //     return $this->hasMany(CampaignIq::class);
    // }

    // /**
    //  * @return HasMany
    //  */
    // public function candidates(): HasMany
    // {
    //     return $this->hasMany(Candidate::class);
    // }

    // /**
    //  * @return HasMany
    //  */
    // public function activities(): HasMany
    // {
    //     return $this->hasMany(Activity::class);
    // }

    // /**
    //  * @return HasMany
    //  */
    // public function barangayLists(): HasMany
    // {
    //     return $this->hasMany(BarangayList::class);
    // }


    public function photoUrl()
    {
        return $this->photo
            ? asset('storage/'. auth()->user()->photo)
            : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
    
}
