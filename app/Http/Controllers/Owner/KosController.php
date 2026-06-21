<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            'status' => 'required|string|in:aktif,nonaktif,pending',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['owner_id'] = Auth::id();
        $data['is_eksklusif'] = $request->has('is_eksklusif') || $request->get('is_eksklusif') == '1';

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            // Store files in storage/app/public/kos and save relative paths in DB
            foreach ($request->file('foto') as $file) {
                try {
                    $path = $file->store('kos', 'public'); // e.g. kos/abcd.jpg
                    $fotoPaths[] = $path;
                } catch (\Exception $e) {
                    // if storing fails, ignore this file
                    continue;
                }
            }
        }
    $uploadedFiles = $request->file('foto');
    $uploadedCount = is_array($uploadedFiles) ? count($uploadedFiles) : 0;
    Log::info('OwnerKosController@store - uploaded files count', ['hasFile' => $request->hasFile('foto'), 'count' => $uploadedCount, 'saved' => count($fotoPaths)]);
        $data['foto'] = $fotoPaths;

        // Default empty array if no facilities selected
        if (!isset($data['fasilitas'])) {
            $data['fasilitas'] = [];
        }

    $kos = Kos::create($data);
    Log::info('OwnerKosController@store - kos created', ['id' => $kos->id, 'foto_saved' => $kos->foto]);

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
            'nama'           => 'required|string|max:255',
            'alamat'         => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'harga'          => 'required|integer|min:0',
            'tipe'           => 'required|string|in:campur,putri,putra',
            'luas_kamar'     => 'nullable|string|max:50',
            'kamar_mandi'    => 'required|string|in:dalam,luar',
            'fasilitas'      => 'nullable|array',
            'kamar_tersedia' => 'required|integer|min:0',
            'is_eksklusif'   => 'nullable',
            'status'         => 'required|string|in:aktif,nonaktif,pending',
            'foto_baru'      => 'nullable|array',
            'foto_baru.*'    => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto_hapus'     => 'nullable|array',
        ]);

        $data['is_eksklusif'] = $request->has('is_eksklusif');
        $data['fasilitas']    = $data['fasilitas'] ?? [];

        // DEBUG: log incoming image-related payload
        try {
            Log::info('OwnerKosController@update - request snapshot', [
                'kos_id' => $kos->id,
                'keys' => array_keys($request->all()),
                'foto_hapus' => $request->input('foto_hapus', []),
                'has_foto_baru' => $request->hasFile('foto_baru'),
                'foto_baru_names' => $request->file('foto_baru') ? array_map(fn($f)=>$f->getClientOriginalName(), (array)$request->file('foto_baru')) : [],
            ]);
        } catch (\Throwable $e) {
            // ignore logging errors
        }

        // 1. Mulai dari foto yang sudah ada (raw DB values)
        $existingFotos = $kos->foto ?? [];

        // Helper: normalize an incoming path to storage-relative path used by disk('public')
        $normalizeToStorage = function ($p) use ($request) {
            if (!is_string($p) || $p === '') return null;
            // data URI -> not a storage path
            if (str_starts_with($p, 'data:')) return null;
            // If already looks like storage-relative (no protocol and contains no '/storage/') return trimmed
            if (!preg_match('#^https?://#i', $p) && !str_contains($p, '/storage/')) {
                return ltrim($p, '/');
            }
            // If contains '/storage/' (full URL or path), extract part after '/storage/'
            $pos = strpos($p, '/storage/');
            if ($pos !== false) {
                return ltrim(substr($p, $pos + strlen('/storage/')), '/');
            }
            // If it's a full URL that may include the asset('storage') base, attempt to strip the asset base
            try {
                $storageUrl = asset('storage/');
                if (str_starts_with($p, $storageUrl)) {
                    return ltrim(substr($p, strlen($storageUrl)), '/');
                }
            } catch (\Throwable $e) {
                // ignore asset() issues and fall back
            }
            // As a last resort, strip protocol and domain and try to find '/storage/' later
            $parsed = preg_replace('#^https?://[^/]+#i', '', $p);
            $pos2 = strpos($parsed, '/storage/');
            if ($pos2 !== false) {
                return ltrim(substr($parsed, $pos2 + strlen('/storage/')), '/');
            }
            return ltrim($p, '/');
        };

        // 2. Hapus foto yang dipilih user untuk dihapus
        $toRemove = $request->input('foto_hapus', []);
        if (!empty($toRemove) && is_array($toRemove)) {
            // Build a set of normalized paths the user asked to remove
            $removeNormalized = [];
            foreach ($toRemove as $path) {
                $n = $normalizeToStorage($path);
                if ($n !== null) $removeNormalized[] = $n;
            }

            // Iterate existing fotos and delete matching ones (consider normalization)
            $kept = [];
            foreach ($existingFotos as $existing) {
                $nExisting = $normalizeToStorage($existing);
                if ($nExisting !== null && in_array($nExisting, $removeNormalized, true)) {
                    // Attempt delete only if file exists on disk
                    if (\Storage::disk('public')->exists($nExisting)) {
                        \Storage::disk('public')->delete($nExisting);
                    }
                    // skip adding to kept -> effectively removed
                    continue;
                }
                // not marked for removal -> keep
                $kept[] = $existing;
            }
            $existingFotos = array_values($kept);
        }

        // 3. Tambahkan foto baru jika ada
        if ($request->hasFile('foto_baru')) {
            foreach ($request->file('foto_baru') as $file) {
                try {
                    $path = $file->store('kos', 'public');
                    $existingFotos[] = $path;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
        // 3b. Also accept base64-embedded images (fallback from JS) under 'foto_baru_data[]'
        $fotoDataList = $request->input('foto_baru_data', []);
        if (!empty($fotoDataList) && is_array($fotoDataList)) {
            foreach ($fotoDataList as $i => $dataUri) {
                if (!is_string($dataUri) || !str_starts_with($dataUri, 'data:')) continue;
                try {
                    // parse data URI
                    [$meta, $content] = explode(',', $dataUri, 2) + [null, null];
                    if (!$content) continue;
                    // derive extension from meta e.g. data:image/png;base64
                    $ext = 'png';
                    if (preg_match('#data:image/([a-zA-Z0-9+]+)#', $meta, $m)) {
                        $ext = $m[1] === 'jpeg' ? 'jpg' : $m[1];
                    }
                    $decoded = base64_decode($content);
                    if ($decoded === false) continue;
                    $filename = uniqid('kos_') . '.' . $ext;
                    $path = 'kos/' . $filename;
                    \Storage::disk('public')->put($path, $decoded);
                    $existingFotos[] = $path;
                } catch (\Throwable $e) {
                    continue;
                }
            }
        }
        Log::info('OwnerKosController@update - foto_baru processed', ['hasFile' => $request->hasFile('foto_baru'), 'saved' => count($existingFotos)]);

        $data['foto'] = $existingFotos;

        try {
            Log::info('OwnerKosController@update - about to save', ['kos_id' => $kos->id, 'final_fotos' => $existingFotos]);
        } catch (\Throwable $e) {}

        // Hapus key yang tidak ada di fillable
        unset($data['foto_baru'], $data['foto_hapus']);

        $kos->update($data);

        return redirect()->route('owner.kos.index')->with('success', 'Kos berhasil diperbarui.');
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
