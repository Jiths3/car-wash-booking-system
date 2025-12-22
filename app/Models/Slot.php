<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{

    public function bookings()
{
    return $this->hasMany(Booking::class);
}


public function bookedMinutes()
{
    return $this->bookings()
        ->where('is_active', 'true')
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

protected $fillable = [
    'date',
    'start_time',
    'end_time',
    'total_minutes',
    'is_active',
];
    
}



