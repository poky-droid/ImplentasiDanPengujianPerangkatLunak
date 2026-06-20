<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'kos_id',
        'kamar_id',
        'tanggal_sewa',
        'durasi',
        'total',
        'status',
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'total'        => 'integer',
        'durasi'       => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // Accessor: label & warna berdasarkan status
    public function getStatusLabelAttribute(): array
    {
        return match($this->status) {
            'pending'   => ['label' => 'Menunggu',     'class' => 'badge-pending'],
            'confirmed' => ['label' => 'Dikonfirmasi', 'class' => 'badge-confirmed'],
            'active'    => ['label' => 'Aktif',        'class' => 'badge-active'],
            'cancelled' => ['label' => 'Dibatalkan',   'class' => 'badge-cancelled'],
            'completed' => ['label' => 'Selesai',      'class' => 'badge-completed'],
            default     => ['label' => ucfirst($this->status), 'class' => 'badge-pending'],
        };
    }
}
