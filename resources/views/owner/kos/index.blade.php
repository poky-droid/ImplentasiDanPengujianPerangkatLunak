@extends('layout.app')

@section('title', 'Kelola Kos')
@section('page-title', 'Kelola Kos')

@section('content')

<!-- STATISTIK RINGKAS -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-value">{{ $stats['total'] }}</div>
        <div class="stat-label">Total Kos</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color:var(--success);">{{ $stats['aktif'] }}</div>
        <div class="stat-label">Kos Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color:var(--danger);">{{ $stats['nonaktif'] }}</div>
        <div class="stat-label">Kos Nonaktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color:var(--info);">{{ $stats['kamar_tersedia'] }}</div>
        <div class="stat-label">Total Kamar Tersedia</div>
    </div>
</div>

<!-- DAFTAR KOS SECTION -->
<div class="table-section">
    <div class="table-header" style="flex-wrap: wrap; gap: 16px;">
        <h2 class="section-title">Daftar Kos Anda</h2>
        <div style="display:flex; gap:12px; align-items:center; flex-wrap: wrap; margin-left:auto;">
            <!-- Filter Kategori Buttons -->
            <div class="filter-tabs" style="display:flex; flex-wrap:wrap; gap:6px;">
                <a href="{{ route('owner.kos.index', ['kategori' => '', 'search' => $search]) }}" class="btn btn-outline btn-sm {{ !$kategori ? 'active' : '' }}">Semua</a>
                <a href="{{ route('owner.kos.index', ['kategori' => 'campur', 'search' => $search]) }}" class="btn btn-outline btn-sm {{ $kategori == 'campur' ? 'active' : '' }}">Campur</a>
                <a href="{{ route('owner.kos.index', ['kategori' => 'putri', 'search' => $search]) }}" class="btn btn-outline btn-sm {{ $kategori == 'putri' ? 'active' : '' }}">Putri</a>
                <a href="{{ route('owner.kos.index', ['kategori' => 'putra', 'search' => $search]) }}" class="btn btn-outline btn-sm {{ $kategori == 'putra' ? 'active' : '' }}">Putra</a>
                <a href="{{ route('owner.kos.index', ['kategori' => 'exclusive', 'search' => $search]) }}" class="btn btn-outline btn-sm {{ $kategori == 'exclusive' ? 'active' : '' }}">Exclusive</a>
            </div>
            
            <!-- Pencarian -->
            <form method="GET" action="{{ route('owner.kos.index') }}" style="display: flex; align-items: center; gap: 8px;">
                @if($kategori)
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                @endif
                <div class="search-box">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Cari nama, alamat..."
                        value="{{ $search }}"
                    >
                </div>
                <button type="submit" class="btn btn-outline btn-sm">Cari</button>
                @if($search || $kategori)
                    <a href="{{ route('owner.kos.index') }}" class="btn btn-outline btn-sm">Reset</a>
                @endif
            </form>

            <a href="{{ route('owner.kos.create') }}" class="btn btn-primary btn-sm">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Kos
            </a>
        </div>
    </div>

    <!-- Table Wrapper -->
    <div class="table-wrapper" style="margin-top: 16px; overflow-x: auto;">
        <table id="kosTable">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Kos</th>
                    <th>Kategori</th>
                    <th>Alamat</th>
                    <th>Harga / Bulan</th>
                    <th style="text-align: center;">Kamar Tersedia</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kosList as $kos)
                    <tr>
                        <td>
                            @if(!empty($kos->foto) && is_array($kos->foto) && count($kos->foto) > 0)
                                <img src="{{ asset('storage/' . $kos->foto[0]) }}" alt="{{ $kos->nama }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                            @else
                                <div style="width: 50px; height: 50px; background: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #9ca3af;">No Foto</div>
                            @endif
                        </td>
                        <td style="font-weight: 600;">{{ $kos->nama }}</td>
                        <td>
                            @if($kos->is_eksklusif)
                                <span class="badge badge-warning" style="margin-bottom: 2px;">Exclusive</span>
                            @endif
                            @if($kos->tipe === 'putri')
                                <span class="badge" style="background:#fce7f3; color:#db2777;">Putri</span>
                            @elseif($kos->tipe === 'putra')
                                <span class="badge" style="background:#dbeafe; color:#2563eb;">Putra</span>
                            @else
                                <span class="badge" style="background:#d1fae5; color:#059669;">Campur</span>
                            @endif
                        </td>
                        <td class="td-muted" title="{{ $kos->alamat }}">{{ Str::limit($kos->alamat, 35) }}</td>
                        <td style="font-weight: 600;">{{ $kos->harga_format ?? 'Rp ' . number_format($kos->harga, 0, ',', '.') }}</td>
                        <td class="td-muted" style="text-align: center; font-weight: 600;">{{ $kos->kamar_tersedia }}</td>
                        <td>
                            @if($kos->status === 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td class="td-muted">{{ $kos->created_at ? $kos->created_at->format('d M Y') : '-' }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('owner.kos.edit', $kos->id) }}" class="btn-icon" title="Edit">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button class="btn-icon danger" title="Hapus" onclick="confirmDelete({{ $kos->id }}, '{{ addslashes($kos->nama) }}')">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; color: #9ca3af; padding: 40px;">Belum ada data kos yang sesuai pencarian / filter.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    @if($kosList->hasPages())
    <div class="pagination">
        @if($kosList->onFirstPage())
            <button class="page-btn" disabled>‹</button>
        @else
            <a href="{{ $kosList->previousPageUrl() }}" class="page-btn">‹</a>
        @endif
        @foreach($kosList->getUrlRange(1, $kosList->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $kosList->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($kosList->hasMorePages())
            <a href="{{ $kosList->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <button class="page-btn" disabled>›</button>
        @endif
    </div>
    @endif
</div>

<!-- MODAL HAPUS KOS -->
<div class="modal-overlay" id="modalHapusKos">
    <div class="modal" style="max-width:400px;">
        <h3 class="modal-title">Hapus Kos</h3>
        <p style="color:#6b7280; font-size:14px; margin-bottom:20px;">Yakin ingin menghapus kos <strong id="hapusKosNama"></strong>?</p>
        <form method="POST" id="hapusKosForm" action="">
            @csrf
            @method('DELETE')
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalHapusKos')">Batal</button>
                <button type="submit" class="btn btn-primary" style="background:#ef4444;">Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('hapusKosNama').textContent = name;
    document.getElementById('hapusKosForm').action = `/owner/kos/${id}`;
    openModal('modalHapusKos');
}
</script>
@endpush
