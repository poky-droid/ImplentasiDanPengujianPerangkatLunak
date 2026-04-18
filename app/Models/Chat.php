<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'user_id',
        'owner_id',
        'pesan',
        'waktu'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function kirimPesan()
    {
        return "Pesan berhasil dikirim: " . $this->pesan;
    }

    public function terimaPesan()
    {
        return "Pesan diterima pada " . $this->waktu . ": " . $this->pesan;
    }
}