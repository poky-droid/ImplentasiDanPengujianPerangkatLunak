<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $table = 'kos';

    protected $fillable = [
        'owner_id',
        'nama',
        'alamat',
        'deskripsi',
        'harga',
        'tipe',           // 'putri' | 'putra' | 'campur'
        'luas_kamar',     // contoh: '3 x 4 m'
        'kamar_mandi',    // 'dalam' | 'luar'
        'fasilitas',      // JSON array: ["WiFi","AC","Laundry"]
        'foto',           // JSON array path gambar
        'kamar_tersedia',
        'rating',
        'is_eksklusif',
    ];

    protected $casts = [
        'fasilitas'      => 'array',
        'foto'           => 'array',
        'harga'          => 'integer',
        'kamar_tersedia' => 'integer',
        'rating'         => 'float',
        'is_eksklusif'   => 'boolean',
    ];

    // ── Relasi ke Owner ──────────────────────────────────
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // ── Accessor: foto pertama sebagai thumbnail ─────────
    public function getFotoUtamaAttribute(): ?string
    {
        $fotos = $this->foto;
        return (!empty($fotos) && is_array($fotos)) ? $fotos[0] : null;
    }

    // ── Accessor: format harga rupiah ───────────────────
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // ── Scope: filter berdasarkan tipe ───────────────────
    public function scopeTipe($query, string $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    // ── Scope: filter harga maksimal ─────────────────────
    public function scopeMaxHarga($query, int $max)
    {
        return $query->where('harga', '<=', $max);
    }

    // ── Scope: hanya yang masih ada kamar ────────────────
    public function scopeTersedia($query)
    {
        return $query->where('kamar_tersedia', '>', 0);
    }
}