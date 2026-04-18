<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
}
