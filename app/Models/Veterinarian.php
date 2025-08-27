<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'vet_name',
        'phone',
        'license_number',
        'specialization',
    ];

    /**
     * Inverse of the one-to-one relationship on User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}