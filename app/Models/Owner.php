<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
    public function propertis()
    {
        return $this->hasMany(Properti::class);
    }

    /**
     * Relasi: semua kos milik owner ini.
     */
    public function kos()
    {
        return $this->hasMany(\App\Models\Kos::class, 'owner_id');
    }
}
