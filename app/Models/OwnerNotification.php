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
        'reference_id',
        'reference_type',
    ];

    protected $casts = [
        'is_read'      => 'boolean',
        'reference_id' => 'integer',
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

    /**
     * Filter berdasarkan tipe.
     */
    public function scopeOfType($query, string $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    // ─── Helpers ─────────────────────────────────────────────────
    /**
     * Warna dot berdasarkan tipe notifikasi (untuk tampilan).
     */
    public function getDotColorAttribute(): string
    {
        return match ($this->tipe) {
            'booking'     => 'blue',
            'pembayaran'  => 'green',
            'review'      => 'yellow',
            'maintenance' => 'red',
            'chat'        => 'purple',
            'sistem'      => 'red',
            default       => 'blue',
        };
    }

    /**
     * Label tipe dalam Bahasa Indonesia.
     */
    public function getTipeLabelAttribute(): string
    {
        return match ($this->tipe) {
            'booking'     => 'Booking',
            'pembayaran'  => 'Pembayaran',
            'review'      => 'Ulasan',
            'maintenance' => 'Maintenance',
            'chat'        => 'Chat',
            'sistem'      => 'Sistem',
            default       => 'Info',
        };
    }

    /**
     * URL aksi berdasarkan tipe dan reference_id.
     * Digunakan di blade untuk tombol "Lihat Detail".
     */
    public function getReferenceUrlAttribute(): ?string
    {
        try {
            return match ($this->tipe) {
                // Booking: link ke detail booking owner, butuh reference_id
                'booking'    => $this->reference_id
                                    ? route('owner.booking.show', $this->reference_id)
                                    : route('owner.booking.index'),

                // Pembayaran: link ke halaman pembayaran owner
                'pembayaran' => route('owner.pembayaran.index'),

                // Chat: arahkan owner ke inbox chat owner dengan filter kos_id
                'chat'       => $this->reference_id
                                    ? route('owner.messages.inbox', ['kos_id' => $this->reference_id])
                                    : route('owner.messages.inbox'),

                // Tipe lain (maintenance, sistem, review) belum punya halaman detail
                default      => null,
            };
        } catch (\Throwable $e) {
            return null;
        }
    }

    // ─── Factory Helper (opsional) ────────────────────────────────
    /**
     * Buat notifikasi booking baru untuk owner kos.
     */
    public static function createBookingNotif(int $ownerId, Booking $booking): self
    {
        return self::create([
            'owner_id'       => $ownerId,
            'judul'          => 'Booking Baru Masuk',
            'isi'            => "Penyewa " . optional($booking->user)->name . " telah melakukan booking untuk kos \"" . optional($booking->kos)->nama . "\" mulai " . optional($booking->tanggal_sewa)->format('d/m/Y') . ".",
            'tipe'           => 'booking',
            'reference_id'   => $booking->id,
            'reference_type' => 'booking',
        ]);
    }

    /**
     * Buat notifikasi pembayaran baru untuk owner kos.
     */
    public static function createPembayaranNotif(int $ownerId, Booking $booking): self
    {
        return self::create([
            'owner_id'       => $ownerId,
            'judul'          => 'Pembayaran Diterima',
            'isi'            => "Pembayaran sebesar Rp " . number_format($booking->total, 0, ',', '.') . " dari " . optional($booking->user)->name . " untuk kos \"" . optional($booking->kos)->nama . "\" telah diterima.",
            'tipe'           => 'pembayaran',
            'reference_id'   => $booking->id,
            'reference_type' => 'booking',
        ]);
    }

    /**
     * Buat notifikasi chat baru untuk owner kos.
     */
    public static function createChatNotif(int $ownerId, int $kosId, string $userName, string $kosName): self
    {
        return self::create([
            'owner_id'       => $ownerId,
            'judul'          => 'Pesan Baru dari Penyewa',
            'isi'            => "Anda mendapat pesan baru dari {$userName} mengenai kos \"{$kosName}\".",
            'tipe'           => 'chat',
            'reference_id'   => $kosId,
            'reference_type' => 'chat',
        ]);
    }
}
