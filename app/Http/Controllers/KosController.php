<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class KosController extends Controller
{
    public function index()
    {
        $kosList = Kos::tersedia()
            ->aktif()
            ->whereHas('owner', function ($q) {
                $q->where('status', 'aktif');
            })
            ->latest()
            ->paginate(12);

        return view('kos-listing', compact('kosList'));
    }

    public function listing(Request $request)
    {
        $kategori = $request->get('kategori');

    $query = Kos::tersedia()->aktif(); // hanya kos berstatus aktif yang tampil ke publik

        if ($kategori === 'exclusive') {
            $query->where('is_eksklusif', true);
        } elseif (in_array($kategori, ['putri', 'putra', 'campur'])) {
            $query->where('tipe', $kategori);
        }

        $kosList = $query->latest()->paginate(8);

        return view('kos-listing', compact('kosList', 'kategori'));
    }

    public function show($id)
    {
        // hanya kos aktif yang bisa dibuka detailnya oleh publik
        $kos = Kos::tersedia()->findOrFail($id);
        return view('kos.kos-detail', compact('kos'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $kosList = Kos::tersedia()
            ->when($query, function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                  ->orWhere('alamat', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(8);

        return view('kos-search', compact('kosList', 'query'));
    }
}