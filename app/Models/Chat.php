<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'kos_id',
        'pesan',
        'dibaca',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
    ];

    // ── Relasi ──────────────────────────────────────────
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}