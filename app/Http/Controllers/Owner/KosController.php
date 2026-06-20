<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kos;

class KosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');

        // Base query for logged in owner
        $baseQuery = Kos::where('owner_id', Auth::id());

        // Get stats based on owner's all kos
        $stats = [
            'total' => (clone $baseQuery)->count(),
            'aktif' => (clone $baseQuery)->where('status', 'aktif')->count(),
            'nonaktif' => (clone $baseQuery)->where('status', 'nonaktif')->count(),
            'kamar_tersedia' => (clone $baseQuery)->sum('kamar_tersedia'),
        ];

        // Apply filters/search for the list query
        $query = clone $baseQuery;

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('tipe', 'like', "%{$search}%");
            });
        }

        if ($kategori) {
            if ($kategori === 'exclusive') {
                $query->where('is_eksklusif', true);
            } elseif (in_array($kategori, ['putri', 'putra', 'campur'])) {
                $query->where('tipe', $kategori);
            }
        }

        $kosList = $query->latest()->paginate(10)->withQueryString();

        return view('owner.kos.index', compact('kosList', 'stats', 'search', 'kategori'));
    }

    public function create()
    {
        return view('owner.kos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'tipe' => 'required|string|in:campur,putri,putra',
            'luas_kamar' => 'nullable|string|max:50',
            'kamar_mandi' => 'required|string|in:dalam,luar',
            'fasilitas' => 'nullable|array',
            'kamar_tersedia' => 'required|integer|min:0',
            'is_eksklusif' => 'nullable',
            'status' => 'required|string|in:aktif,nonaktif',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['owner_id'] = Auth::id();
        $data['is_eksklusif'] = $request->has('is_eksklusif') || $request->get('is_eksklusif') == '1';

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('kos', 'public');
                $fotoPaths[] = $path;
            }
        }
        $data['foto'] = $fotoPaths;

        // Default empty array if no facilities selected
        if (!isset($data['fasilitas'])) {
            $data['fasilitas'] = [];
        }

        Kos::create($data);

        return redirect()->route('owner.kos.index')->with('success', 'Kos berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kos = Kos::findOrFail($id);

        if ($kos->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('owner.kos.edit', compact('kos'));
    }

    public function update(Request $request, $id)
    {
        $kos = Kos::findOrFail($id);

        if ($kos->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'tipe' => 'required|string|in:campur,putri,putra',
            'luas_kamar' => 'nullable|string|max:50',
            'kamar_mandi' => 'required|string|in:dalam,luar',
            'fasilitas' => 'nullable|array',
            'kamar_tersedia' => 'required|integer|min:0',
            'is_eksklusif' => 'nullable',
            'status' => 'required|string|in:aktif,nonaktif',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['is_eksklusif'] = $request->has('is_eksklusif') || $request->get('is_eksklusif') == '1';

        // Keep old facilities if not specified
        if (!isset($data['fasilitas'])) {
            $data['fasilitas'] = [];
        }

        if ($request->hasFile('foto')) {
            $fotoPaths = [];
            foreach ($request->file('foto') as $file) {
                $path = $file->store('kos', 'public');
                $fotoPaths[] = $path;
            }
            $data['foto'] = $fotoPaths;
        }

        $kos->update($data);

        return redirect()->route('owner.kos.index')->with('success', 'Kos diperbarui');
    }

    public function destroy($id)
    {
        $kos = Kos::findOrFail($id);

        if ($kos->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $kos->delete();

        return redirect()->route('owner.kos.index')->with('success', 'Kos berhasil dihapus');
    }
}
