<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerNotification extends Model
{
    use HasFactory;

    protected $table = 'owner_notifications';

    protected $fillable = [
        'owner_id',
        'judul',
        'isi',
        'tipe',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // ─── Relasi ──────────────────────────────────────────────────
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // ─── Scopes ──────────────────────────────────────────────────
    /**
     * Hanya notifikasi yang belum dibaca.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Notifikasi milik owner tertentu.
     */
    public function scopeForOwner($query, int $userId)
    {
        return $query->where('owner_id', $userId);
    }

    // ─── Helpers ─────────────────────────────────────────────────
    /**
     * Warna dot berdasarkan tipe notifikasi (untuk tampilan).
     */
    public function getDotColorAttribute(): string
    {
        return match ($this->tipe) {
            'booking'    => 'blue',
            'pembayaran' => 'green',
            'review'     => 'yellow',
            'sistem'     => 'red',
            default      => 'blue',
        };
    }

    /**
     * Label tipe dalam Bahasa Indonesia.
     */
    public function getTipeLabelAttribute(): string
    {
        return match ($this->tipe) {
            'booking'    => 'Booking',
            'pembayaran' => 'Pembayaran',
            'review'     => 'Ulasan',
            'sistem'     => 'Sistem',
            default      => 'Info',
        };
    }
}
