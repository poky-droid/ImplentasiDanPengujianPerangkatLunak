@extends('layout.app')

@section('title', 'List Booking')
@section('page-title', 'List Booking')

@section('content')

<div class="table-section">
    <div class="table-header">
        <h2 class="section-title">Riwayat Booking</h2>
        <div style="margin-left:auto;">
            <div class="search-box">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                    type="text"
                    class="search-input"
                    placeholder="Cari booking..."
                    oninput="filterTable(this.value)"
                >
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <table id="bookingTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Penyewa</th>
                    <th>Nama Kost</th>
                    <th>Check-in</th>
                    <th>Durasi</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                <tr data-search="{{ strtolower($b->user->name . ' ' . $b->kos->nama) }}">
                    <td class="td-muted" style="font-size:12px; font-family: monospace;">#{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td style="font-weight:600;">{{ $b->user->name ?? '-' }}</td>
                    <td>{{ $b->kos->nama ?? '-' }}</td>
                    <td class="td-muted">{{ \Carbon\Carbon::parse($b->checkin)->format('d M Y') }}</td>
                    <td class="td-muted">{{ $b->durasi }} bulan</td>
                    <td style="font-weight:600;">Rp {{ number_format($b->total, 0, ',', '.') }}</td>
                    <td>
                        @if($b->status === 'aktif')
                            <span class="badge badge-success">Aktif</span>
                        @elseif($b->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($b->status === 'selesai')
                            <span class="badge badge-gray">Selesai</span>
                        @else
                            <span class="badge badge-danger">Dibatalkan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#9ca3af; padding:40px;">Belum ada data booking</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($bookings->hasPages())
    <div class="pagination">
        @if($bookings->onFirstPage())
            <button class="page-btn" disabled>‹</button>
        @else
            <a href="{{ $bookings->previousPageUrl() }}" class="page-btn">‹</a>
        @endif
        @foreach($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $page == $bookings->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($bookings->hasMorePages())
            <a href="{{ $bookings->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <button class="page-btn" disabled>›</button>
        @endif
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function filterTable(val) {
    document.querySelectorAll('#bookingTable tbody tr[data-search]').forEach(row => {
        row.style.display = row.dataset.search.includes(val.toLowerCase()) ? '' : 'none';
    });
}
</script>
@endpush
