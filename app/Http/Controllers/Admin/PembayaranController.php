<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        // Mock data for payments
        $mockPembayarans = [
            (object)[
                'id' => 1,
                'owner' => (object)['name' => 'Owner 1'],
                'kos' => (object)['nama' => 'Kos A'],
                'periode' => 'Januari 2026',
                'jumlah' => 5000000,
                'tgl_transfer' => '2026-05-20',
                'status' => 'selesai'
            ],
            (object)[
                'id' => 2,
                'owner' => (object)['name' => 'Owner 2'],
                'kos' => (object)['nama' => 'Kos B'],
                'periode' => 'Februari 2026',
                'jumlah' => 3500000,
                'tgl_transfer' => null,
                'status' => 'menunggu'
            ],
            (object)[
                'id' => 3,
                'owner' => (object)['name' => 'Owner 3'],
                'kos' => (object)['nama' => 'Kos C'],
                'periode' => 'Maret 2026',
                'jumlah' => 4200000,
                'tgl_transfer' => '2026-05-18',
                'status' => 'selesai'
            ],
        ];

        // Paginate the mock data
        $page = request()->get('page', 1);
        $perPage = 15;
        $pembayarans = new LengthAwarePaginator(
            array_slice($mockPembayarans, ($page - 1) * $perPage, $perPage),
            count($mockPembayarans),
            $perPage,
            $page,
            ['path' => route('admin.pembayaran.index')]
        );

        // Calculate totals
        $totalDibayarkan = collect($mockPembayarans)
            ->where('status', 'selesai')
            ->sum('jumlah');
        
        $menungguTransfer = collect($mockPembayarans)
            ->where('status', 'menunggu')
            ->sum('jumlah');

        return view('admin.pembayaran', compact('pembayarans', 'totalDibayarkan', 'menungguTransfer'));
    }

    public function create($id = null)
    {
        $booking = \App\Models\Booking::with(['kos', 'kamar', 'user'])->findOrFail($id);

        if ($booking->user_id !== \Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $pembayaran = \App\Models\Pembayaran::where('booking_id', $booking->id)->first();

        return view('pembayaran', compact('booking', 'pembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode'     => 'required|string',
        ]);

        $booking = \App\Models\Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== \Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi agar satu booking tidak dapat membuat data pembayaran tunai yang sama lebih dari sekali
        $existing = \App\Models\Pembayaran::where('booking_id', $booking->id)
            ->where('metode_pembayaran', 'tunai')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Pembayaran tunai sudah pernah diajukan untuk pemesanan ini.');
        }

        if ($request->metode === 'cash') {
            \App\Models\Pembayaran::create([
                'booking_id'         => $booking->id,
                'user_id'            => \Auth::id(),
                'kos_id'             => $booking->kos_id,
                'metode_pembayaran'  => 'tunai',
                'status_pembayaran'  => 'pending',
                'tanggal_pembayaran' => now(),
            ]);

            try {
                $kos = \App\Models\Kos::find($booking->kos_id);
                if ($kos) {
                    \App\Models\OwnerNotification::create([
                        'owner_id'       => $kos->owner_id,
                        'judul'          => 'Pengajuan Pembayaran Tunai',
                        'isi'            => "Penyewa " . \Auth::user()->name . " telah mengajukan pembayaran tunai sebesar Rp " . number_format($booking->total, 0, ',', '.') . " untuk kos \"" . $kos->nama . "\". Silakan konfirmasi di menu Pembayaran.",
                        'tipe'           => 'pembayaran',
                        'reference_id'   => $booking->id,
                        'reference_type' => 'booking',
                    ]);
                }
            } catch (\Throwable $e) {
                \Log::warning('Gagal membuat notifikasi pembayaran tunai: ' . $e->getMessage());
            }

            return redirect()->route('pembayaran.create', $booking->id)->with('success', 'Berhasil mengajukan pembayaran tunai.');
        }

        return redirect()->back()->with('error', 'Metode pembayaran tidak didukung.');
    }

}
