<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'assigned_user_id',
        'task',
        'due_date',
        'is_completed'
    ];

    /**
     * Cast attributes to specific data types.
     */
    protected $casts = [
        'role_id' => 'integer',
        'assigned_user_id' => 'integer',
        'is_completed' => 'boolean',
        'due_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
