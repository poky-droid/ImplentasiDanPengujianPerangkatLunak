<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kos;

class KosSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'           => 'Kos Putri Melati',
                'alamat'         => 'Jl. Jatiwangun, Purwokerto Selatan',
                'deskripsi'      => 'Kos putri nyaman dan bersih berada di pusat kota. Dekat kampus UNSOED dan fasilitas lengkap.',
                'harga'          => 1600000,
                'tipe'           => 'putri',
                'luas_kamar'     => '3 x 4 m',
                'kamar_mandi'    => 'Dalam',
                'fasilitas'      => ['Wi-Fi', 'AC', 'Laundry', 'K.M Dalam', 'Parkir'],
                'foto'           => [],
                'kamar_tersedia' => 3,
                'rating'         => 4.5,
                'is_eksklusif'   => true,
            ],
            [
                'nama'           => 'Kos Putra Anggrek',
                'alamat'         => 'Jl. Merdeka No. 10, Purwokerto Utara',
                'deskripsi'      => 'Kos putra strategis dekat kampus, lingkungan aman dan kondusif untuk belajar.',
                'harga'          => 1200000,
                'tipe'           => 'putra',
                'luas_kamar'     => '3 x 3 m',
                'kamar_mandi'    => 'Luar',
                'fasilitas'      => ['Wi-Fi', 'Parkir'],
                'foto'           => [],
                'kamar_tersedia' => 5,
                'rating'         => 4.2,
                'is_eksklusif'   => false,
            ],
            [
                'nama'           => 'Kos Campur Mawar',
                'alamat'         => 'Jl. Ahmad Yani No. 5, Purwokerto Timur',
                'deskripsi'      => 'Kos campur dengan fasilitas lengkap, cocok untuk mahasiswa dan karyawan.',
                'harga'          => 1800000,
                'tipe'           => 'campur',
                'luas_kamar'     => '4 x 4 m',
                'kamar_mandi'    => 'Dalam',
                'fasilitas'      => ['Wi-Fi', 'AC', 'Laundry', 'K.M Dalam'],
                'foto'           => [],
                'kamar_tersedia' => 2,
                'rating'         => 4.7,
                'is_eksklusif'   => true,
            ],
        ];

        foreach ($data as $item) {
            Kos::create($item);
        }
    }
}