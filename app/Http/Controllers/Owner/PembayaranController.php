<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Kos;

class PembayaranController extends Controller
{
    /**
     * Halaman manajemen pembayaran untuk owner.
     * Mengambil data dari tabel bookings berdasarkan kos milik owner.
     */
    public function index(Request $request)
    {
        // Ambil semua kos milik owner yang sedang login
        $kosIds = Kos::where('owner_id', Auth::id())->pluck('id');

        $query = Booking::with(['user', 'kos'])
            ->whereIn('kos_id', $kosIds);

        // Filter status (opsional)
        $status = $request->get('status');
        if ($status) {
            $query->where('status', $status);
        }

        // Filter kos (opsional)
        $kosId = $request->get('kos_id');
        if ($kosId) {
            $query->where('kos_id', $kosId);
        }

        // Cari berdasarkan nama/email penyewa
        $search = $request->get('search');
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pembayarans = $query->latest()->paginate(10)->withQueryString();

        // Hitung statistik finansial
        $allBookings = Booking::whereIn('kos_id', $kosIds)->get();
        
        $stats = [
            'total_pendapatan'   => $allBookings->whereIn('status', ['confirmed', 'active', 'completed'])->sum('total'),
            'potensi_pendapatan' => $allBookings->where('status', 'pending')->sum('total'),
            'transaksi_berhasil' => $allBookings->whereIn('status', ['confirmed', 'active', 'completed'])->count(),
            'transaksi_pending'  => $allBookings->where('status', 'pending')->count(),
        ];

        // Daftar kos milik owner untuk dropdown filter
        $kosList = Kos::where('owner_id', Auth::id())->get(['id', 'nama']);

        return view('owner.pembayaran.index', compact('pembayarans', 'stats', 'kosList', 'status', 'kosId', 'search'));
    }
}
