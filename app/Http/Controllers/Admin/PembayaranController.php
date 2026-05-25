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
}

