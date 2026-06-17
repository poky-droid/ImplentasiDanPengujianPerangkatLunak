<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kos;

class KosController extends Controller
{
    public function index()
    {
        $kosList = Kos::where('owner_id', Auth::id())->latest()->paginate(10);
        return view('owner.kos.index', compact('kosList'));
    }

    public function create()
    {
        return view('owner.kos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $data['owner_id'] = Auth::id();

        Kos::create($data);

        return redirect()->route('owner.kos.index')->with('success', 'Kos berhasil ditambahkan');
    }

    public function edit(Kos $kos)
    {
        $this->authorize('update', $kos);
        return view('owner.kos.edit', compact('kos'));
    }

    public function update(Request $request, Kos $kos)
    {
        $this->authorize('update', $kos);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $kos->update($data);

        return redirect()->route('owner.kos.index')->with('success', 'Kos diperbarui');
    }

    public function destroy(Kos $kos)
    {
        $this->authorize('delete', $kos);
        $kos->delete();
        return redirect()->route('owner.kos.index')->with('success', 'Kos dihapus');
    }
}
