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
            return $fotos[0]; // path relatif dari storage/app/public/
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
                $images[] = 'storage/' . $f;
            }
        }

        // If no images exist, fill up with placeholder so gallery always has content
        while (count($images) < 3) {
            $images[] = 'images/default_kos.png';
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
}