<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Available roles in the system.
     */
    public const ROLES = [
        'admin',
        'owner',
        'veterinarian',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * One-to-one relationship to the Owner table.
     */
    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

    /**
     * One-to-one relationship to the Veterinarian table.
     */
    public function veterinarian()
    {
        return $this->hasOne(Veterinarian::class);
    }

    public function isVeterinarian(): bool
    {
        return $this->role === 'veterinarian';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}