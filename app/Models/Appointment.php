<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'vet_id', 'scheduled_at', 'status', 'notes'];

    // Appointment status ENUM values
    public const STATUS_PENDING   = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELED  = 'canceled';

    public const STATUS_LABELS = [
        self::STATUS_PENDING   => 'Pending',
        self::STATUS_CONFIRMED => 'Confirmed',
        self::STATUS_CANCELED  => 'Canceled',
    ];

    public const STATUS_BADGES = [
        self::STATUS_PENDING   => 'warning',
        self::STATUS_CONFIRMED => 'primary',
        self::STATUS_CANCELED  => 'secondary',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class, 'vet_id');
    }

    public function reaction()
    {
        return $this->hasOne(AppointmentReaction::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return self::STATUS_BADGES[$this->status] ?? 'dark';
    }
}