<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Kos;

class BookingController extends Controller
{
    public function create($id)
    {  
        $kos = Kos::findOrFail($id);

        // Pemilik kos tidak boleh memesan kos miliknya sendiri
        if (Auth::check() && Auth::id() === $kos->owner_id) {
            return redirect()->route('kos.show', $kos->id)
                ->with('error', 'Anda tidak dapat memesan kos yang Anda kelola sendiri.');
        }

        return view('booking', compact('kos'));
    }

    public function cekSedia($kamar_id): bool
    {
        $kamar = Kamar::find($kamar_id);
        if (!$kamar) return false;
        return $kamar->status === 'tersedia';
    }

    public function store(Request $request)
    {
        $kos = Kos::findOrFail($request->kos_id);

        // Pemilik kos tidak boleh memesan kos miliknya sendiri
        if (Auth::id() === $kos->owner_id) {
            return redirect()->route('kos.show', $kos->id)
                ->with('error', 'Anda tidak dapat memesan kos yang Anda kelola sendiri.');
        }

        $booking = Booking::create([
            'user_id'       => Auth::id(),
            'kos_id'        => $request->kos_id,
            'kamar_id'      => null,
            'tanggal_sewa'  => $request->tanggal_mulai,
            'durasi'        => $request->durasi,
            'total'         => $request->total,
            'status'        => 'pending',
        ]);

        return redirect()->route('pembayaran.create', $booking->id);
    }
}