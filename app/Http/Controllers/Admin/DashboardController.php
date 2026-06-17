<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Owner;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    
    public function index()
    {
        $totalUsers = User::count();
        $totalOwners = Owner::count();
        $bookingAktif = Booking::count();
        $pendapatan = 5200000; // Mock data
        $bookingTerbaru = Booking::latest()->take(5)->get();
        
        // Get recent owner applications with their first property
        $pengajuanTerbaru = Owner::with('propertis')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($owner) {
                return (object) [
                    'nama' => $owner->nama ?? 'N/A',
                    'properti' => $owner->propertis->first()?->nama ?? 'N/A',
                    'status' => $owner->status ?? 'pending',
                ];
            });

        return view('admin.dashboard', compact('totalUsers', 'totalOwners', 'bookingAktif', 'pendapatan', 'bookingTerbaru', 'pengajuanTerbaru'));
    }
}
