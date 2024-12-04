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
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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


    /**
     * @return HasMany
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
    /**
     * @return HasMany
     */
    public function personalInformation(): HasOne
    {
        return $this->hasOne(PersonalInformation::class);
    }

    /**
     * @return HasMany
     */
    public function todo(): HasMany
    {
        return $this->hasOne(Todo::class);
    }


    /**
     * @return HasMany
     */
    public function clearances(): HasMany
    {
        return $this->hasMany(Clearance::class);
    }

    /**
     * @return HasMany
     */
    public function incidentReports(): HasMany
    {
        return $this->hasMany(incidentReport::class);
    }

    /**
     * @return HasMany
     */
    public function blotters(): HasMany
    {
        return $this->hasMany(Blotter::class);
    }


    /**
     * @return HasMany
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    /**
     * @return HasMany
     */
    public function informations(): HasMany
    {
        return $this->hasMany(Information::class);
    }

    /**
     * @return HasMany
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }



    public function photoUrl()
    {
        return $this->photo
            ? asset('storage/'. auth()->user()->photo)
            : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
    
}
