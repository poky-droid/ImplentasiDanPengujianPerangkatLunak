<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    protected $table = 'properti';
    protected $primaryKey = 'id_properti';

    protected $fillable = [
        'owner_id',
        'nama',
        'lokasi',
        'fasilitas'
    ];

    public $timestamps = false;

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }

    public function tampilkanDetail()
    {
        return [
            'id' => $this->id_properti,
            'nama' => $this->nama,
            'lokasi' => $this->lokasi,
            'fasilitas' => $this->fasilitas,
        ];
    }
}