@extends('layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- STAT CARDS -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-value">{{ number_format($totalUsers) }}</div>
        <div class="stat-label">Total user</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ number_format($totalOwners) }}</div>
        <div class="stat-label">Total Owner</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ number_format($bookingAktif) }}</div>
        <div class="stat-label">Booking Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">Rp {{ number_format($pendapatan / 1000000, 0) }} juta</div>
        <div class="stat-label">Pendapatan</div>
    </div>
</div>

<!-- DUAL TABLE GRID -->
<div class="dual-grid">

    <!-- Booking Terbaru -->
    <div class="table-section">
        <div class="table-header">
            <h2 class="section-title">Booking terbaru</h2>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Penyewa Kos</th>
                        <th>Kos</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookingTerbaru as $b)
                    <tr>
                        <td>{{ $b->user->name ?? '-' }}</td>
                        <td>{{ $b->kos->nama ?? '-' }}</td>
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
                        <td colspan="3" style="text-align:center; color:#9ca3af; padding: 24px;">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pengajuan Mitra Baru -->
    <div class="table-section">
        <div class="table-header">
            <h2 class="section-title">Pengajuan Mitra baru</h2>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Properti</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuanTerbaru as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->properti }}</td>
                        <td>
                            @if($p->status === 'aktif')
                                <span class="badge badge-success">Disetujui</span>
                            @elseif($p->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center; color:#9ca3af; padding: 24px;">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
