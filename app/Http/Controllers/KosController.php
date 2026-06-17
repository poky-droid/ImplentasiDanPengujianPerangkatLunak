<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class KosController extends Controller
{
    public function index()
    {
        $kosList = Kos::tersedia()->latest()->paginate(8);
        return view('kos-listing', compact('kosList'));
    }

    public function show($id)
    {
        $kos = Kos::findOrFail($id);
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