<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Manajemen Pembayaran - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage:        #6B8F71;
            --sage-dark:   #4A6B50;
            --sage-deeper: #3A5540;
            --sage-light:  #A8C5AC;
            --sage-bg:     #EDF3EE;
            --cream:       #F8F6F1;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
            --text-mid:    #4A5C4D;
            --text-light:  #8A9E8D;
            --gold:        #C9A84C;
            --border:      #E2EAE3;
            --danger:      #E57373;
            --sidebar-w:   260px;
            --card-shadow: 0 2px 16px rgba(58,85,64,0.10);
            --radius:      14px;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--text-dark); min-height: 100vh; display: flex; }

        /* ═══ SIDEBAR ═══ */
        .sidebar { width: var(--sidebar-w); background: var(--sage-deeper); min-height: 100vh; display: flex; flex-direction: column; position: fixed; left: 0; top: 0; z-index: 200; transition: transform .3s ease; }
        .sidebar-header { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 12px; }
        .sidebar-logo { width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 3px; flex-shrink: 0; }
        .sidebar-logo img { width: 36px; height: 36px; object-fit: contain; }
        .sidebar-brand { font-size: 16px; font-weight: 800; color: #fff; letter-spacing: 1.8px; text-transform: uppercase; text-decoration: none; }
        .sidebar-user { padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 12px; }
        .sidebar-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--sage-light), var(--sage-dark)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: #fff; flex-shrink: 0; overflow: hidden; }
        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-name { font-size: 14px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: 11px; color: var(--sage-light); font-weight: 500; margin-top: 2px; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: rgba(255,255,255,0.35); padding: 12px 12px 6px; }
        .nav-item { display: flex; align-items: center; gap: 11px; padding: 11px 12px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500; margin-bottom: 2px; transition: background .2s, color .2s; }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: rgba(255,255,255,0.15); color: #fff; font-weight: 600; }
        .nav-item svg { flex-shrink: 0; opacity: .8; }
        .nav-item.active svg { opacity: 1; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout { display: flex; align-items: center; gap: 10px; width: 100%; padding: 11px 12px; border-radius: 10px; border: none; background: rgba(229,115,115,0.15); color: #ef9a9a; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500; cursor: pointer; transition: background .2s, color .2s; text-decoration: none; }
        .btn-logout:hover { background: rgba(229,115,115,0.3); color: #ef5350; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 199; }
        .sidebar-overlay.show { display: block; }

        /* ═══ MAIN ═══ */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 32px; height: 68px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger-btn { display: none; background: none; border: none; cursor: pointer; padding: 6px; color: var(--text-dark); }
        .topbar-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-light); }
        .topbar-breadcrumb span:last-child { color: var(--text-dark); font-weight: 600; }
        .page-body { padding: 32px 36px; flex: 1; }

        /* ═══ PAGE HEADING ═══ */
        .page-heading { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; }
        .page-heading h1 { font-size: 22px; font-weight: 700; margin-bottom: 4px; }
        .page-heading p { font-size: 13px; color: var(--text-light); }

        /* ═══ STAT CARDS ═══ */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: var(--white); border-radius: 12px; padding: 20px; box-shadow: var(--card-shadow); border: 1px solid var(--border); }
        .stat-card-title { font-size: 12px; font-weight: 600; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-card-value { font-size: 26px; font-weight: 800; color: var(--text-dark); margin-bottom: 4px; }
        .stat-card-value.highlight { color: var(--sage-deeper); }
        .stat-card-value.pending { color: #F57F17; }
        .stat-card-sub { font-size: 12px; color: var(--text-light); display: flex; align-items: center; gap: 6px; }

        /* ═══ TOOLBAR ═══ */
        .toolbar { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; flex-wrap: wrap; }
        .search-bar { display: flex; align-items: center; gap: 8px; background: var(--white); border: 1.5px solid var(--border); border-radius: 10px; padding: 8px 14px; flex: 1; min-width: 200px; transition: border-color .2s; }
        .search-bar:focus-within { border-color: var(--sage-light); }
        .search-bar input { border: none; outline: none; font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--text-dark); background: transparent; flex: 1; }
        .search-bar input::placeholder { color: var(--text-light); }
        .filter-select { border: 1.5px solid var(--border); border-radius: 10px; padding: 9px 36px 9px 14px; font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--text-mid); background: var(--white); outline: none; cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238A9E8D' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; transition: border-color .2s; }
        .filter-select:focus { border-color: var(--sage-light); }
        .btn-search { display: flex; align-items: center; gap: 6px; background: var(--sage-deeper); color: #fff; border: none; border-radius: 10px; padding: 9px 18px; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; transition: background .2s; }
        .btn-search:hover { background: var(--sage-dark); }

        /* ═══ STATUS FILTER TABS ═══ */
        .status-tabs { display: flex; gap: 6px; margin-bottom: 18px; flex-wrap: wrap; }
        .status-tab { padding: 7px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1.5px solid var(--border); text-decoration: none; color: var(--text-mid); background: var(--white); transition: all .2s; }
        .status-tab:hover { border-color: var(--sage-light); color: var(--sage-deeper); }
        .status-tab.active { background: var(--sage-deeper); border-color: var(--sage-deeper); color: #fff; }

        /* ═══ TABLE CARD ═══ */
        .table-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--card-shadow); overflow: hidden; }
        .table-head { padding: 16px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .table-head-title { font-size: 15px; font-weight: 700; }
        .table-head-count { font-size: 12px; color: var(--text-light); }

        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; color: var(--text-light); padding: 12px 20px; text-align: left; background: #FAFBFA; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 14px 20px; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--text-dark); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #FAFBFA; }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--sage-light), var(--sage-dark)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: #fff; flex-shrink: 0; overflow: hidden; }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-name { font-weight: 600; font-size: 13px; }
        .user-email { font-size: 11px; color: var(--text-light); margin-top: 1px; }

        /* Kos cell */
        .kos-name { font-weight: 600; font-size: 13px; color: var(--sage-deeper); text-decoration: none; }
        .kos-name:hover { text-decoration: underline; }

        /* Badges */
        .badge { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; }
        .badge-pending   { background: #FFF8E1; color: #F57F17; border: 1px solid #FFE082; }
        .badge-confirmed { background: #E3F2FD; color: #1565C0; border: 1px solid #BBDEFB; }
        .badge-active    { background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }
        .badge-completed { background: #EDE7F6; color: #4527A0; border: 1px solid #D1C4E9; }
        .badge-cancelled { background: #FFEBEE; color: #C62828; border: 1px solid #FFCDD2; }

        /* Empty state */
        .empty-state { padding: 64px 24px; text-align: center; }
        .empty-icon { width: 72px; height: 72px; border-radius: 20px; background: var(--sage-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
        .empty-title { font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 6px; }
        .empty-sub { font-size: 13px; color: var(--text-light); }

        /* Pagination */
        .pagination-wrap { padding: 16px 20px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; }
        .pagination-wrap nav ul { display: flex; gap: 4px; list-style: none; }
        .pagination-wrap nav ul li a,
        .pagination-wrap nav ul li span { display: flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; padding: 0 6px; border-radius: 8px; font-size: 13px; color: var(--text-mid); text-decoration: none; border: 1px solid var(--border); transition: all .2s; }
        .pagination-wrap nav ul li.active span { background: var(--sage-deeper); color: #fff; border-color: var(--sage-deeper); }
        .pagination-wrap nav ul li a:hover { border-color: var(--sage-light); color: var(--sage-deeper); }

        /* Responsive */
        @media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger-btn { display: flex; }
            .page-body { padding: 24px 16px; }
            .topbar { padding: 0 16px; }
        }
        @media (max-width: 600px) { .stats-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

@include('owner.partials.sidebar')

<!-- ═══ MAIN ═══ -->
<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <div class="topbar-breadcrumb">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                <span>Pembayaran</span>
            </div>
        </div>
    </header>

    <div class="page-body">

        <div class="page-heading">
            <div>
                <h1>Manajemen Pembayaran</h1>
                <p>Pantau semua transaksi dan pendapatan dari penyewa kos Anda</p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-title">Total Pendapatan</div>
                <div class="stat-card-value highlight">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</div>
                <div class="stat-card-sub">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#4A6B50" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Dari transaksi berhasil
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-title">Potensi Pendapatan</div>
                <div class="stat-card-value pending">Rp {{ number_format($stats['potensi_pendapatan'], 0, ',', '.') }}</div>
                <div class="stat-card-sub">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#F57F17" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Menunggu pembayaran/konfirmasi
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-title">Transaksi Berhasil</div>
                <div class="stat-card-value">{{ number_format($stats['transaksi_berhasil'], 0, ',', '.') }}</div>
                <div class="stat-card-sub">Penyewaan aktif / selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-title">Transaksi Pending</div>
                <div class="stat-card-value">{{ number_format($stats['transaksi_pending'], 0, ',', '.') }}</div>
                <div class="stat-card-sub">Dalam proses persetujuan</div>
            </div>
        </div>

        {{-- Filter form --}}
        <form method="GET" action="{{ route('owner.pembayaran.index') }}">
            <div class="toolbar">
                <div class="search-bar">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#8A9E8D" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg>
                    <input type="text" name="search" placeholder="Cari nama atau email penyewa..." value="{{ $search }}">
                </div>

                @if($kosList->count() > 1)
                <select name="kos_id" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Kos</option>
                    @foreach($kosList as $k)
                    <option value="{{ $k->id }}" {{ $kosId == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
                @endif

                <button type="submit" class="btn-search">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg>
                    Cari
                </button>

                @if($search || $kosId)
                <a href="{{ route('owner.pembayaran.index') }}" style="font-size:13px;color:var(--text-light);text-decoration:none;">Reset</a>
                @endif
            </div>

            {{-- Status tabs --}}
            <div class="status-tabs">
                <a href="{{ route('owner.pembayaran.index', array_merge(request()->except('status'), [])) }}"
                   class="status-tab {{ !$status ? 'active' : '' }}">Semua Status</a>
                <a href="{{ route('owner.pembayaran.index', array_merge(request()->except('status'), ['status'=>'pending'])) }}"
                   class="status-tab {{ $status=='pending' ? 'active' : '' }}">⏳ Pending</a>
                <a href="{{ route('owner.pembayaran.index', array_merge(request()->except('status'), ['status'=>'confirmed'])) }}"
                   class="status-tab {{ $status=='confirmed' ? 'active' : '' }}">✅ Lunas (Terkonfirmasi)</a>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-head">
                <span class="table-head-title">Riwayat Transaksi</span>
                <span class="table-head-count">{{ $pembayarans->total() }} transaksi</span>
            </div>

            @if($pembayarans->count() > 0)
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th># ID</th>
                            <th>Penyewa</th>
                            <th>Kos / Durasi</th>
                            <th>Tgl Transaksi</th>
                            <th>Total Tagihan</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $i => $bayar)
                        @php
                            $sl = $bayar->status_label;
                        @endphp
                        <tr>
                            <td style="color:var(--text-light);font-size:12px;font-weight:600;">
                                TRX-{{ str_pad($bayar->id, 5, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- Penyewa --}}
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        @if($bayar->user->avatar ?? null)
                                            <img src="{{ asset('storage/' . $bayar->user->avatar) }}" alt="">
                                        @else
                                            {{ strtoupper(substr($bayar->user->name ?? 'U', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $bayar->user->name ?? '-' }}</div>
                                        <div class="user-email">{{ $bayar->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kos --}}
                            <td>
                                <a href="{{ route('kos.show', $bayar->kos->id) }}" class="kos-name" target="_blank">{{ $bayar->kos->nama ?? '-' }}</a>
                                <div style="font-size:11px;color:var(--text-light);margin-top:2px;">
                                    Sewa {{ $bayar->durasi ?? 0 }} bulan
                                </div>
                            </td>

                            {{-- Tanggal --}}
                            <td>
                                <div style="font-weight:600;font-size:13px;">{{ $bayar->created_at->format('d M Y') }}</div>
                                <div style="font-size:11px;color:var(--text-light);">{{ $bayar->created_at->format('H:i') }}</div>
                            </td>

                            {{-- Total --}}
                            <td>
                                @if($bayar->total)
                                    <strong style="color:var(--text-dark);">Rp {{ number_format($bayar->total, 0, ',', '.') }}</strong>
                                @else
                                    <span style="color:var(--text-light)">-</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($bayar->status == 'pending')
                                    <span class="badge badge-pending">⏳ Belum Lunas</span>
                                @elseif(in_array($bayar->status, ['confirmed', 'active', 'completed']))
                                    <span class="badge badge-confirmed">✅ Lunas</span>
                                @else
                                    <span class="badge badge-cancelled">✕ Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($pembayarans->hasPages())
            <div class="pagination-wrap">
                {{ $pembayarans->links() }}
            </div>
            @endif

            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
                <div class="empty-title">
                    @if($status || $search || $kosId)
                        Tidak ada transaksi yang cocok
                    @else
                        Belum ada transaksi
                    @endif
                </div>
                <div class="empty-sub">
                    @if($status || $search || $kosId)
                        Coba ubah filter atau kata kunci pencarian.
                    @else
                        Transaksi pembayaran dari penyewa akan muncul di sini.
                    @endif
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

<script>
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('sidebarOverlay').classList.toggle('show'); }
    function closeSidebar()  { document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebarOverlay').classList.remove('show'); }
</script>
</body>
</html>
