@extends('layouts.app')

@section('title', 'List Komplain')
@section('page-title', 'List Komplain')

@section('content')

<div class="table-section">
    <div class="table-header">
        <h2 class="section-title">Daftar Komplain</h2>
        <div style="margin-left:auto;">
            <div class="filter-tabs">
                <a href="{{ route('admin.komplain.index') }}"
                   class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline' }}">
                    Semua
                </a>
                <a href="{{ route('admin.komplain.index', ['status' => 'belum']) }}"
                   class="btn {{ request('status') === 'belum' ? 'btn-primary' : 'btn-outline' }}">
                    Belum ditanganin
                </a>
                <a href="{{ route('admin.komplain.index', ['status' => 'selesai']) }}"
                   class="btn {{ request('status') === 'selesai' ? 'btn-primary' : 'btn-outline' }}">
                    Selesai
                </a>
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>no.Hp</th>
                    <th>Bergabung</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($komplains as $i => $k)
                <tr>
                    <td class="td-muted">{{ $komplains->firstItem() + $i }}</td>
                    <td style="font-weight:600;">{{ $k->user->name ?? '-' }}</td>
                    <td class="td-muted">{{ $k->user->email ?? '-' }}</td>
                    <td class="td-muted">{{ $k->user->phone ?? '-' }}</td>
                    <td class="td-muted">{{ $k->created_at->format('d M Y') }}</td>
                    <td>
                        @if($k->status === 'selesai')
                            <span class="badge badge-success">Selesai</span>
                        @else
                            <span class="badge badge-warning">Belum ditanganin</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <button class="btn-icon" title="Lihat Detail" onclick="openModal('modalKomplain{{ $k->id }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            @if($k->status !== 'selesai')
                            <form method="POST" action="{{ route('admin.komplain.selesai', $k->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-icon" title="Tandai Selesai" style="border-color:#a7f3d0; color:#059669;">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- MODAL DETAIL KOMPLAIN -->
                <div class="modal-overlay" id="modalKomplain{{ $k->id }}">
                    <div class="modal" style="max-width: 520px;">
                        <h3 class="modal-title">Detail Komplain</h3>
                        <div style="display:grid; gap:14px;">
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">DARI</div>
                                <div style="font-weight:600;">{{ $k->user->name ?? '-' }}</div>
                                <div style="font-size:13px; color:#9ca3af;">{{ $k->user->email ?? '' }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">SUBJEK</div>
                                <div>{{ $k->subjek ?? '-' }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">ISI KOMPLAIN</div>
                                <div style="line-height:1.6; color:#374151; font-size:14px; background:#f9fafb; padding:12px; border-radius:8px;">
                                    {{ $k->pesan ?? '-' }}
                                </div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">TANGGAL</div>
                                <div class="td-muted">{{ $k->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div>
                                <div style="font-size:12px; color:#9ca3af; font-weight:600; margin-bottom:4px;">STATUS</div>
                                @if($k->status === 'selesai')
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-warning">Belum ditanganin</span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-actions">
                            @if($k->status !== 'selesai')
                            <form method="POST" action="{{ route('admin.komplain.selesai', $k->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Tandai Selesai</button>
                            </form>
                            @endif
                            <button type="button" class="btn btn-outline" onclick="closeModal('modalKomplain{{ $k->id }}')">Tutup</button>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#9ca3af; padding:40px;">Belum ada komplain</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($komplains->hasPages())
    <div class="pagination">
        @if($komplains->onFirstPage())
            <button class="page-btn" disabled>‹</button>
        @else
            <a href="{{ $komplains->previousPageUrl() }}" class="page-btn">‹</a>
        @endif
        @foreach($komplains->getUrlRange(1, $komplains->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $komplains->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($komplains->hasMorePages())
            <a href="{{ $komplains->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <button class="page-btn" disabled>›</button>
        @endif
    </div>
    @endif
</div>

@endsection
