<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    /**
     * Inverse of the one-to-one relationship on User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function appointments()
    {
         return $this->hasManyThrough(Appointment::class, Pet::class, 'owner_id', 'pet_id');
    }
}