@extends('layout.app')

@section('title', 'Pembayaran ke Owner')
@section('page-title', 'Pembayaran ke Owner')

@section('content')

<!-- STAT CARDS -->
<div class="stat-grid" style="grid-template-columns: repeat(2, 1fr); max-width: 520px; margin-bottom: 28px;">
    <div class="stat-card">
        <div class="stat-value">Rp {{ number_format($totalDibayarkan, 2, '.', '.') }}</div>
        <div class="stat-label">Total Dibayarkan</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">Rp {{ number_format($menungguTransfer, 2, '.', '.') }}</div>
        <div class="stat-label">Menunggu Transfer</div>
    </div>
</div>

<!-- TABLE -->
<div class="table-section">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Owner</th>
                    <th>Kos</th>
                    <th>Periode</th>
                    <th>Jumlah</th>
                    <th>Tgl Transfer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayarans as $p)
                <tr>
                    <td style="font-weight:600;">{{ $p->owner->name ?? '-' }}</td>
                    <td>{{ $p->kos->nama ?? '-' }}</td>
                    <td class="td-muted">{{ $p->periode }}</td>
                    <td style="font-weight:600;">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                    <td class="td-muted">
                        {{ $p->tgl_transfer ? \Carbon\Carbon::parse($p->tgl_transfer)->format('d M Y') : '-' }}
                    </td>
                    <td>
                        @if($p->status === 'selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($p->status === 'menunggu')
                            <span class="badge badge-warning">Menunggu</span>
                        @else
                            <span class="badge badge-info">Diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:#9ca3af; padding:40px;">Belum ada data pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pembayarans->hasPages())
    <div class="pagination">
        @if($pembayarans->onFirstPage())
            <button class="page-btn" disabled>‹</button>
        @else
            <a href="{{ $pembayarans->previousPageUrl() }}" class="page-btn">‹</a>
        @endif
        @foreach($pembayarans->getUrlRange(1, $pembayarans->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $pembayarans->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($pembayarans->hasMorePages())
            <a href="{{ $pembayarans->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <button class="page-btn" disabled>›</button>
        @endif
    </div>
    @endif
</div>

@endsection
