<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id','name','species','breed','birthdate','sex'];

    /**
     * A Pet belongs to one Owner.
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    /**
     * A Pet has many Appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}