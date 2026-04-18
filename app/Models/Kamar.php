<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    public function properti()
    {
        return $this->belongsTo(Properti::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
