<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentReaction extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'user_id', 'status', 'notes'];

    // Reaction status ENUM values
    public const STATUS_PENDING  = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_DECLINED = 'declined';

    public const STATUS_LABELS = [
        self::STATUS_PENDING  => 'Pending',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_DECLINED => 'Declined',
    ];

    public const STATUS_BADGES = [
        self::STATUS_PENDING  => 'info',
        self::STATUS_APPROVED => 'success',
        self::STATUS_DECLINED => 'danger',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return self::STATUS_BADGES[$this->status] ?? 'secondary';
    }

    public static function isValidStatus(string $status): bool
    {
        return in_array($status, array_keys(self::STATUS_LABELS), true);
    }
}