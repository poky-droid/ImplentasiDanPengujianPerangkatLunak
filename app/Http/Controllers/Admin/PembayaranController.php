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
        // Fetch real pembayaran records from database, eager-load booking, kos and owner
        $pembayarans = \App\Models\Pembayaran::with(['booking.kos', 'kos.owner'])
            ->latest()
            ->paginate(15);

        // The amount for a pembayaran is stored on the related booking (booking.total).
        // Sum booking.total for payments that are marked as paid ('lunas')
        $totalDibayarkan = \App\Models\Pembayaran::where('status_pembayaran', 'lunas')
            ->join('bookings', 'pembayarans.booking_id', '=', 'bookings.id')
            ->sum('bookings.total');

        // Sum booking.total for payments that are pending confirmation
        $menungguTransfer = \App\Models\Pembayaran::where('status_pembayaran', 'pending')
            ->join('bookings', 'pembayarans.booking_id', '=', 'bookings.id')
            ->sum('bookings.total');

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
