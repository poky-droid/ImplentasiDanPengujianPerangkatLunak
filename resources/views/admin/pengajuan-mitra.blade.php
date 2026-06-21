@extends('layout.app')

@section('title', 'Pengajuan Mitra')
@section('page-title', 'Pengajuan Mitra')

@section('content')

<!-- STAT CARDS -->
<div class="stat-grid" style="grid-template-columns: repeat(3, 1fr); max-width: 600px; margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-value" style="font-size:36px;">{{ $menunggu }}</div>
        <div class="stat-label">Menunggu Riview</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="font-size:36px;">{{ $disetujui }}</div>
        <div class="stat-label">Disetujui</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="font-size:36px;">{{ $ditolak }}</div>
        <div class="stat-label">Ditolak</div>
    </div>
</div>

<!-- FILTER + TABLE -->
<div class="table-section">
    <div class="table-header" style="margin-bottom: 16px;">
        <div class="filter-tabs">
            <a href="{{ route('admin.pengajuan.index') }}"
               class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline' }}">
                Semua
            </a>
            <a href="{{ route('admin.pengajuan.index', ['status' => 'pending']) }}"
               class="btn {{ request('status') === 'pending' ? 'btn-primary' : 'btn-outline' }}">
                Pending
            </a>
            <a href="{{ route('admin.pengajuan.index', ['status' => 'aktif']) }}"
               class="btn {{ request('status') === 'aktif' ? 'btn-primary' : 'btn-outline' }}">
                Disetujui
            </a>
            <a href="{{ route('admin.pengajuan.index', ['status' => 'nonaktif']) }}"
               class="btn {{ request('status') === 'nonaktif' ? 'btn-primary' : 'btn-outline' }}">
                Ditolak
            </a>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Properti</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuans as $kos)
                <tr>
                    <td style="font-weight:600;">{{ $kos->owner?->name ?? 'Pemilik' }}</td>
                    <td class="td-muted">{{ $kos->owner?->email ?? '-' }}</td>
                    <td>{{ $kos->nama }}</td>
                    <td class="td-muted">{{ $kos->created_at->format('d M Y') }}</td>
                    <td>
                        @if($kos->status === 'aktif')
                            <span class="badge badge-success">Aktif</span>
                        @elseif($kos->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <button class="btn-icon" title="Detail" onclick="openModal('modalDetail{{ $kos->id }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            @if($kos->status === 'pending')
                            <form method="POST" action="{{ route('admin.pengajuan.setujui', $kos->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-icon" title="Setujui" style="border-color:#a7f3d0; color:#059669;">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.pengajuan.tolak', $kos->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-icon danger" title="Tolak">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- MODAL DETAIL -->
                <div class="modal-overlay" id="modalDetail{{ $kos->id }}">
                    <div class="modal" style="max-width:520px;">
                        <h3 class="modal-title">Detail Pengajuan Kos</h3>
                        <div style="display:grid; gap:14px;">
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">NAMA KOS</div>
                                <div style="font-weight:600;">{{ $kos->nama }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">PEMILIK</div>
                                <div class="td-muted">{{ $kos->owner?->name ?? '-' }} &mdash; {{ $kos->owner?->email ?? '-' }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">ALAMAT</div>
                                <div>{{ $kos->alamat ?? '-' }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">TANGGAL PENGAJUAN</div>
                                <div class="td-muted">{{ $kos->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">STATUS</div>
                                @if($kos->status === 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($kos->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="btn btn-outline" onclick="closeModal('modalDetail{{ $kos->id }}')">Tutup</button>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:#9ca3af; padding:40px;">Belum ada pengajuan mitra</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengajuans->hasPages())
    <div class="pagination">
        @if($pengajuans->onFirstPage())
            <button class="page-btn" disabled>‹</button>
        @else
            <a href="{{ $pengajuans->previousPageUrl() }}" class="page-btn">‹</a>
        @endif
        @foreach($pengajuans->getUrlRange(1, $pengajuans->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $pengajuans->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($pengajuans->hasMorePages())
            <a href="{{ $pengajuans->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <button class="page-btn" disabled>›</button>
        @endif
    </div>
    @endif
</div>

@endsection
