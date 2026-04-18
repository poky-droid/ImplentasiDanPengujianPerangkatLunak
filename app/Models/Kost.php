<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    protected $table = 'kost';
    protected $primaryKey = 'id_kost';

    protected $fillable = [
        'harga',
        'status'
    ];

    public function cekSedia(): bool
    {
        return strtolower($this->status) === 'tersedia';
    }
}