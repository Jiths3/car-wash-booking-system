<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Slot extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'total_minutes',
        'is_active',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function bookedMinutes()
    {
        return $this->bookings()
            ->where('status', 'booked')
            ->sum('duration');
    }

    public function remainingMinutes()
    {
        return $this->total_minutes - $this->bookedMinutes();
    }

    public function canBook(int $duration): bool
    {
        return $this->remainingMinutes() >= $duration;
    }
}
