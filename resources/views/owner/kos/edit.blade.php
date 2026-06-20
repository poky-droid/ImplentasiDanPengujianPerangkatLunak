@extends('layout.app')

@section('title', 'Edit Kos')
@section('page-title', 'Edit Kos')

@section('content')

<div class="card" style="max-width: 800px; margin: 0 auto; padding: 32px;">
    <h2 class="section-title" style="margin-bottom: 24px;">Form Edit Kos</h2>

    @if($errors->any())
        <div class="toast error" style="position:relative; margin-bottom: 20px; animation:none; width: 100%;">
            <ul style="margin-left: 16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('owner.kos.update', $kos->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Nama Kos -->
            <div class="form-group">
                <label class="form-label">Nama Kos <span style="color:var(--danger);">*</span></label>
                <input type="text" name="nama" class="form-input" value="{{ old('nama', $kos->nama) }}" placeholder="Contoh: Kos Putri Melati" required>
            </div>

            <!-- Harga / Bulan -->
            <div class="form-group">
                <label class="form-label">Harga Sewa / Bulan (Rp) <span style="color:var(--danger);">*</span></label>
                <input type="number" name="harga" class="form-input" value="{{ old('harga', $kos->harga) }}" placeholder="Contoh: 1500000" required>
            </div>
        </div>

        <!-- Alamat -->
        <div class="form-group">
            <label class="form-label">Alamat Lengkap <span style="color:var(--danger);">*</span></label>
            <input type="text" name="alamat" class="form-input" value="{{ old('alamat', $kos->alamat) }}" placeholder="Jl. Jatiwangun No. 12, Purwokerto" required>
        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label class="form-label">Deskripsi Kos</label>
            <textarea name="deskripsi" class="form-input" rows="4" placeholder="Jelaskan kenyamanan, peraturan, dan kelebihan kos Anda...">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <!-- Kategori Tipe -->
            <div class="form-group">
                <label class="form-label">Tipe Kos <span style="color:var(--danger);">*</span></label>
                <select name="tipe" class="form-select" required>
                    <option value="putri" {{ old('tipe', $kos->tipe) == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="putra" {{ old('tipe', $kos->tipe) == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="campur" {{ old('tipe', $kos->tipe) == 'campur' ? 'selected' : '' }}>Campur</option>
                </select>
            </div>

            <!-- Luas Kamar -->
            <div class="form-group">
                <label class="form-label">Luas Kamar</label>
                <input type="text" name="luas_kamar" class="form-input" value="{{ old('luas_kamar', $kos->luas_kamar) }}" placeholder="Contoh: 3 x 4 m">
            </div>

            <!-- Kamar Mandi -->
            <div class="form-group">
                <label class="form-label">Kamar Mandi <span style="color:var(--danger);">*</span></label>
                <select name="kamar_mandi" class="form-select" required>
                    <option value="dalam" {{ old('kamar_mandi', strtolower($kos->kamar_mandi)) == 'dalam' ? 'selected' : '' }}>Dalam</option>
                    <option value="luar" {{ old('kamar_mandi', strtolower($kos->kamar_mandi)) == 'luar' ? 'selected' : '' }}>Luar</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <!-- Jumlah Kamar Tersedia -->
            <div class="form-group">
                <label class="form-label">Jumlah Kamar Tersedia <span style="color:var(--danger);">*</span></label>
                <input type="number" name="kamar_available" id="kamar_available" class="form-input" style="display:none;" value="{{ $kos->kamar_tersedia }}">
                <input type="number" name="kamar_tersedia" class="form-input" value="{{ old('kamar_tersedia', $kos->kamar_tersedia) }}" min="0" required>
            </div>

            <!-- Status Aktif / Nonaktif -->
            <div class="form-group">
                <label class="form-label">Status <span style="color:var(--danger);">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="aktif" {{ old('status', $kos->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $kos->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- Exclusive Checkbox -->
            <div class="form-group" style="display: flex; flex-direction: column; justify-content: center; height: 100%;">
                <label class="form-label" style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-top: 15px;">
                    <input type="checkbox" name="is_eksklusif" value="1" {{ old('is_eksklusif', $kos->is_eksklusif) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    Kos Exclusive / Premium
                </label>
            </div>
        </div>

        <!-- Fasilitas (Checkbox list) -->
        <div class="form-group" style="margin-top: 10px;">
            <label class="form-label">Fasilitas Kamar & Umum</label>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 10px; padding: 12px; border: 1.5px solid var(--border); border-radius: 9px; background: var(--border-light);">
                @php
                    $availableFasilitas = ['Wi-Fi', 'AC', 'Laundry', 'K.M Dalam', 'Kasur', 'Lemari', 'Meja Belajar', 'Dapur Bersama', 'Parkir Motor', 'Parkir Mobil'];
                    $currentFasilitas = is_array($kos->fasilitas) ? $kos->fasilitas : [];
                @endphp
                @foreach($availableFasilitas as $fasilitas)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; cursor: pointer;">
                        <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}" {{ in_array($fasilitas, old('fasilitas', $currentFasilitas)) ? 'checked' : '' }}>
                        {{ $fasilitas }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Foto Upload -->
        <div class="form-group">
            <label class="form-label">Ganti/Tambah Foto (Pilih baru jika ingin mengganti)</label>
            <input type="file" name="foto[]" class="form-input" multiple accept="image/*" style="padding: 7px 10px;">
            <small style="color:var(--text-secondary); display:block; margin-top:4px;">Format file: JPG, JPEG, PNG, WEBP. Maks 2MB per file.</small>

            @if(!empty($kos->foto) && is_array($kos->foto))
                <div style="display: flex; gap: 10px; margin-top: 16px; flex-wrap: wrap;">
                    @foreach($kos->foto as $f)
                        <div style="position: relative;">
                            <img src="{{ asset('storage/' . $f) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1.5px solid var(--border);">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="modal-actions" style="margin-top: 32px; border-top: 1px solid var(--border); padding-top: 20px;">
            <a href="{{ route('owner.kos.index') }}" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Kos</button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputTersedia = document.querySelector('input[name="kamar_tersedia"]');
    const inputAvailable = document.getElementById('kamar_available');
    
    inputTersedia.addEventListener('input', function() {
        inputAvailable.value = this.value;
    });
});
</script>

@endsection
