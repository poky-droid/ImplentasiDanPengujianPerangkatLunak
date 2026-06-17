<?php

namespace App\Models;

use Database\Factories\UserFactory;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Favorit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'jenis_kelamin',
        'tanggal_lahir',
        'pekerjaan',
        'kota_asal',
        'status',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }

    /**
     * Cek apakah user sudah memfavoritkan kos tertentu.
     */
    public function isFavorit(int $kos_id): bool
    {
        return $this->favorit()->where('kos_id', $kos_id)->exists();
    }
}