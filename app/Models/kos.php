<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorit;

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
        'status',         // 'aktif' | 'nonaktif'
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

    // ── Relasi ke Favorit ────────────────────────────────
    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }

    // ── Accessor: foto pertama sebagai thumbnail ─────────
    public function getFotoUtamaAttribute(): ?string
    {
        $fotos = $this->foto;
        if (!empty($fotos) && is_array($fotos) && isset($fotos[0])) {
            $first = $fotos[0];
            // If already a data URI (base64) return as-is
            if (is_string($first) && str_starts_with($first, 'data:')) {
                return $first;
            }
            // Otherwise assume it's a storage path (e.g. kos/xxx.jpg) and return asset URL
            return asset('storage/' . ltrim($first, '/'));
        }
        return null;
    }

    // ── Accessor: list of all images with fallback support ──
    public function getImagesAttribute(): array
    {
        $fotos = $this->foto;
        $images = [];
        if (!empty($fotos) && is_array($fotos)) {
            foreach ($fotos as $f) {
                if (is_string($f) && str_starts_with($f, 'data:')) {
                    $images[] = $f;
                } else {
                    $images[] = asset('storage/' . ltrim($f, '/'));
                }
            }
        }

        return $images;
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

    // ── Scope: hanya kos yang aktif ─────────────────────
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}