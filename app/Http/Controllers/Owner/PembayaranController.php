<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Kos;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    /**
     * Halaman manajemen pembayaran untuk owner.
     * Mengambil data dari tabel pembayarans berdasarkan kos milik owner.
     */
    public function index(Request $request)
    {
        // Ambil semua kos milik owner yang sedang login
        $kosIds = Kos::where('owner_id', Auth::id())->pluck('id');

        $query = Pembayaran::with(['user', 'kos', 'booking'])
            ->whereIn('kos_id', $kosIds);

        // Filter status (opsional)
        $status = $request->get('status');
        if ($status) {
            $query->where('status_pembayaran', $status);
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

        // Hitung statistik finansial dari seluruh pembayaran masuk kos owner
        $allPayments = Pembayaran::whereIn('kos_id', $kosIds)->with('booking')->get();
        
        $stats = [
            'total_pendapatan'   => $allPayments->where('status_pembayaran', 'lunas')->sum(fn($p) => $p->booking->total ?? 0),
            'potensi_pendapatan' => $allPayments->where('status_pembayaran', 'pending')->sum(fn($p) => $p->booking->total ?? 0),
            'transaksi_berhasil' => $allPayments->where('status_pembayaran', 'lunas')->count(),
            'transaksi_pending'  => $allPayments->where('status_pembayaran', 'pending')->count(),
        ];

        // Daftar kos milik owner untuk dropdown filter
        $kosList = Kos::where('owner_id', Auth::id())->get(['id', 'nama']);

        return view('owner.pembayaran.index', compact('pembayarans', 'stats', 'kosList', 'status', 'kosId', 'search'));
    }

    /**
     * Konfirmasi pembayaran tunai menjadi lunas.
     */
    public function konfirmasiLunas($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // Verifikasi kepemilikan kos
        $kos = Kos::findOrFail($pembayaran->kos_id);
        if ($kos->owner_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $pembayaran->update([
            'status_pembayaran' => 'lunas'
        ]);

        if ($pembayaran->booking) {
            $pembayaran->booking->update([
                'status' => 'confirmed'
            ]);
        }

        // Buat notifikasi sukses konfirmasi
        try {
            \App\Models\OwnerNotification::create([
                'owner_id'       => Auth::id(),
                'judul'          => 'Pembayaran Dikonfirmasi',
                'isi'            => "Pembayaran tunai sebesar Rp " . number_format($pembayaran->booking->total ?? 0, 0, ',', '.') . " untuk kos \"" . $kos->nama . "\" telah dikonfirmasi sebagai lunas.",
                'tipe'           => 'pembayaran',
                'reference_id'   => $pembayaran->booking_id,
                'reference_type' => 'booking',
            ]);
        } catch (\Throwable $e) {
            \Log::warning('Gagal membuat notifikasi konfirmasi pembayaran: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pembayaran tunai berhasil dikonfirmasi sebagai LUNAS.');
    }

    /**
     * Tolak pengajuan pembayaran tunai.
     */
    public function tolakPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Verifikasi kepemilikan kos
        $kos = Kos::findOrFail($pembayaran->kos_id);
        if ($kos->owner_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $pembayaran->update([
            'status_pembayaran' => 'ditolak'
        ]);

        if ($pembayaran->booking) {
            $pembayaran->booking->update([
                'status' => 'cancelled'
            ]);
        }

        return redirect()->back()->with('success', 'Pembayaran tunai telah ditolak.');
    }
}
