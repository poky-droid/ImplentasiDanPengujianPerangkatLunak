<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Owner;
use App\Models\Booking;
use App\Models\Kos;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 
    
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalOwners = User::where('role', 'owner')->count();
        $bookingAktif = Booking::count();

        // Compute pendapatan from confirmed payments (join pembayarans -> bookings)
        $pendapatan = 0;
        try {
            $pendapatan = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'selesai'])
                ->join('bookings', 'pembayarans.booking_id', '=', 'bookings.id')
                ->sum('bookings.total');
            // If there are no pembayaran records, fall back to summing completed bookings
            if (!$pendapatan) {
                $pendapatan = Booking::where('status', 'completed')->sum('total');
            }
        } catch (\Throwable $e) {
            // If table or column missing, keep fallback mock value
            $pendapatan = 0;
        }
        $bookingTerbaru = Booking::latest()->take(5)->get();
        
        // Get recent kos pengajuan (show owner name, kos name, and kos status)
        $pengajuanTerbaru = Kos::with('owner')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($kos) {
                return (object) [
                    'nama' => $kos->owner?->name ?? 'Pemilik',
                    'properti' => $kos->nama ?? '-',
                    'status' => $kos->status ?? 'pending',
                ];
            });

        return view('admin.dashboard', compact('totalUsers', 'totalOwners', 'bookingAktif', 'pendapatan', 'bookingTerbaru', 'pengajuanTerbaru'));
    }
}
