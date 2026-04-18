<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Booking;

class BookingController extends Controller
{
    public function cekSedia($kamar_id): bool
    {
        $kamar = Kamar::find($kamar_id);

        if (!$kamar) {
            return false;
        }

        return $kamar->status === 'tersedia';
    }

    public function store(Request $request)
    {
        if (!$this->cekSedia($request->kamar_id)) {
            return response()->json([
                'message' => 'Kamar tidak tersedia'
            ], 400);
        }

        Booking::create([
            'user_id' => auth()->id(),
            'kamar_id' => $request->kamar_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Booking berhasil'
        ]);
    }
}