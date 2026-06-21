<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Kos;

class BookingController extends Controller
{
    /**
     * Daftar semua booking untuk kos milik owner yang login.
     */
    public function index(Request $request)
    {
        // ID semua kos milik owner ini
        $kosIds = Kos::where('owner_id', Auth::id())->pluck('id');

        // Filter
        $status  = $request->get('status');
        $kosId   = $request->get('kos_id');
        $search  = $request->get('search');

        $query = Booking::with(['user', 'kos'])
            ->whereIn('kos_id', $kosIds);

        if ($status) {
            $query->where('status', $status);
        }

        if ($kosId) {
            $query->where('kos_id', $kosId);
        }

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        // Stats
        $allBookings = Booking::whereIn('kos_id', $kosIds);
        $stats = [
            'total'     => (clone $allBookings)->count(),
            'pending'   => (clone $allBookings)->where('status', 'pending')->count(),
            'confirmed' => (clone $allBookings)->where('status', 'confirmed')->count(),
            'completed' => (clone $allBookings)->where('status', 'completed')->count(),
            'cancelled' => (clone $allBookings)->where('status', 'cancelled')->count(),
        ];

        // Daftar kos milik owner (untuk filter dropdown)
        $kosList = Kos::where('owner_id', Auth::id())->get(['id', 'nama']);

        return view('owner.booking.index', compact('bookings', 'stats', 'kosList', 'status', 'kosId', 'search'));
    }

    /**
     * Update status booking (konfirmasi / tolak / selesai).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:confirmed,cancelled,completed,active']);

        $booking = Booking::with('kos')->findOrFail($id);

        // Pastikan booking ini milik kos owner yang login
        if ($booking->kos->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized.');
        }

        $booking->update(['status' => $request->status]);

        // Sync payment status if payment exists
        $pembayaran = \App\Models\Pembayaran::where('booking_id', $booking->id)->first();
        if ($pembayaran) {
            if ($request->status === 'confirmed' || $request->status === 'active' || $request->status === 'completed') {
                $pembayaran->update(['status_pembayaran' => 'lunas']);
            } elseif ($request->status === 'cancelled') {
                $pembayaran->update(['status_pembayaran' => 'ditolak']);
            }
        }

        $labels = [
            'confirmed' => 'dikonfirmasi',
            'cancelled'  => 'dibatalkan',
            'completed'  => 'diselesaikan',
            'active'     => 'diaktifkan',
        ];

        return back()->with('success', 'Booking berhasil ' . ($labels[$request->status] ?? 'diperbarui') . '.');
    }

    /**
     * Detail booking.
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'kos'])->findOrFail($id);

        if ($booking->kos->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized.');
        }

        return view('owner.booking.show', compact('booking'));
    }
}
