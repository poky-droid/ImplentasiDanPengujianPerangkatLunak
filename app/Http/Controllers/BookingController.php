<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Kos;
use App\Models\OwnerNotification;

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

        // ── Kirim notifikasi ke owner kos ──────────────────────
        try {
            $booking->load(['user', 'kos']);
            OwnerNotification::createBookingNotif($kos->owner_id, $booking);
        } catch (\Throwable $e) {
            // Jangan gagalkan transaksi booking karena notifikasi gagal
            \Log::warning('Gagal membuat notifikasi booking: ' . $e->getMessage());
        }

        return redirect()->route('pembayaran.create', $booking->id);
    }

    /**
     * Tampilkan riwayat transaksi/booking penyewa.
     */
    public function history()
    {
        $bookings = Booking::with(['kos', 'kamar'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Ambil info pembayaran untuk masing-masing booking
        foreach ($bookings as $b) {
            $b->pembayaran = \App\Models\Pembayaran::where('booking_id', $b->id)->first();
        }

        return view('booking_history', compact('bookings'));
    }

    /**
     * Batalkan pesanan oleh penyewa.
     */
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Update status booking ke cancelled
        $booking->update([
            'status' => 'cancelled'
        ]);

        // Batalkan pembayaran terkait jika ada
        $pembayaran = \App\Models\Pembayaran::where('booking_id', $booking->id)->first();
        if ($pembayaran) {
            $pembayaran->update([
                'status_pembayaran' => 'ditolak'
            ]);
        }

        return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}