<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Kelola Kos - Rumantra</title>
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

        /* Sidebar */
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

        /* Main */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 32px; height: 68px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger-btn { display: none; background: none; border: none; cursor: pointer; padding: 6px; color: var(--text-dark); }
        .topbar-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-light); }
        .topbar-breadcrumb span:last-child { color: var(--text-dark); font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .btn-add { display: flex; align-items: center; gap: 7px; background: var(--sage-deeper); color: #fff; border: none; border-radius: 10px; padding: 9px 18px; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; transition: background .2s, transform .15s; }
        .btn-add:hover { background: var(--sage-dark); transform: translateY(-1px); }

        .page-body { padding: 32px 36px; flex: 1; }

        /* Stats bar */
        .stats-bar { display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .stat-pill { background: var(--white); border-radius: 12px; padding: 14px 20px; box-shadow: var(--card-shadow); display: flex; align-items: center; gap: 10px; flex: 1; min-width: 130px; }
        .stat-pill-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-pill-value { font-size: 22px; font-weight: 800; color: var(--text-dark); }
        .stat-pill-label { font-size: 11px; color: var(--text-light); margin-top: 1px; }

        /* Toolbar */
        .toolbar { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
        .search-bar { display: flex; align-items: center; gap: 8px; background: var(--white); border: 1.5px solid var(--border); border-radius: 10px; padding: 8px 14px; flex: 1; min-width: 200px; transition: border-color .2s; }
        .search-bar:focus-within { border-color: var(--sage-light); }
        .search-bar input { border: none; outline: none; font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--text-dark); background: transparent; flex: 1; }
        .search-bar input::placeholder { color: var(--text-light); }
        .filter-select { border: 1.5px solid var(--border); border-radius: 10px; padding: 9px 36px 9px 14px; font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--text-mid); background: var(--white); outline: none; cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238A9E8D' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; transition: border-color .2s; }
        .filter-select:focus { border-color: var(--sage-light); }

        /* Table card */
        .table-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--card-shadow); overflow: hidden; }
        .table-head { padding: 16px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .table-head-title { font-size: 15px; font-weight: 700; color: var(--text-dark); }
        .table-head-count { font-size: 12px; color: var(--text-light); }

        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; color: var(--text-light); padding: 12px 20px; text-align: left; background: #FAFBFA; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 14px 20px; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--text-dark); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #FAFBFA; }

        .kos-row-info { display: flex; align-items: center; gap: 12px; }
        .kos-row-img { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; background: var(--sage-bg); flex-shrink: 0; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .kos-row-img img { width: 100%; height: 100%; object-fit: cover; }
        .kos-row-name { font-weight: 600; font-size: 13px; }
        .kos-row-loc { font-size: 11px; color: var(--text-light); margin-top: 2px; display: flex; align-items: center; gap: 3px; }

        .badge { display: inline-flex; align-items: center; font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
        .badge-active   { background: #E8F5E9; color: #2E7D32; }
        .badge-inactive { background: #FFF3E0; color: #E65100; }
    .badge-pending  { background: #FFF9E8; color: #C9A84C; }
        .badge-putri    { background: #FFE8EF; color: #C0516A; }
        .badge-putra    { background: #E8F0FF; color: #4A6BC0; }
        .badge-campur   { background: #E8F5E9; color: #2E7D32; }
        .badge-exclusive{ background: #FFF3D6; color: #B8860B; }

        .table-actions { display: flex; gap: 6px; }
        .btn-icon { width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-mid); text-decoration: none; transition: all .2s; }
        .btn-icon:hover { border-color: var(--sage-light); color: var(--sage-deeper); background: var(--sage-bg); }
        .btn-icon.danger:hover { border-color: var(--danger); color: var(--danger); background: #FFF5F5; }

        .empty-state { padding: 64px 24px; text-align: center; }
        .empty-icon { width: 72px; height: 72px; border-radius: 20px; background: var(--sage-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
        .empty-title { font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px; }
        .empty-sub { font-size: 13px; color: var(--text-light); margin-bottom: 24px; }

        /* Flash */
        .flash { padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 10px; }
        .flash-success { background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }
        .flash-error   { background: #FFEBEE; color: #C62828; border: 1px solid #FFCDD2; }

        /* Pagination */
        .pagination-wrap { padding: 16px 20px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; }
        .pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; }
        .pagination-wrap .page-item .page-link { display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 8px; font-size: 13px; color: var(--text-mid); text-decoration: none; border: 1px solid var(--border); transition: all .2s; }
        .pagination-wrap .page-item.active .page-link { background: var(--sage-deeper); color: #fff; border-color: var(--sage-deeper); }
        .pagination-wrap .page-item .page-link:hover { border-color: var(--sage-light); color: var(--sage-deeper); }

        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger-btn { display: flex; }
            .page-body { padding: 24px 16px; }
            .topbar { padding: 0 16px; }
        }
    </style>
</head>
<body>

@include('owner.partials.sidebar')

<!-- Main -->
<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <div class="topbar-breadcrumb">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/></svg>
                <span>Kelola Kos</span>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('owner.kos.create') }}" class="btn-add">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Kos
            </a>
        </div>
    </header>

    <div class="page-body">

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="flash flash-success">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Stats bar --}}
        <div class="stats-bar">
            <div class="stat-pill">
                <div class="stat-pill-icon" style="background:#E8F5E9;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#2E7D32" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/></svg>
                </div>
                <div>
                    <div class="stat-pill-value">{{ $stats['total'] }}</div>
                    <div class="stat-pill-label">Total Kos</div>
                </div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill-icon" style="background:#E1F5FE;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#0277BD" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="stat-pill-value">{{ $stats['aktif'] }}</div>
                    <div class="stat-pill-label">Aktif</div>
                </div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill-icon" style="background:#FFF3E0;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#E65100" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div>
                    <div class="stat-pill-value">{{ $stats['nonaktif'] }}</div>
                    <div class="stat-pill-label">Nonaktif</div>
                </div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill-icon" style="background:#EDE7F6;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#6A1B9A" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                </div>
                <div>
                    <div class="stat-pill-value">{{ $stats['kamar_tersedia'] }}</div>
                    <div class="stat-pill-label">Kamar Tersedia</div>
                </div>
            </div>
        </div>

        {{-- Toolbar --}}
        <form method="GET" action="{{ route('owner.kos.index') }}">
            <div class="toolbar">
                <div class="search-bar">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#8A9E8D" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg>
                    <input
                        type="text" name="search"
                        placeholder="Cari nama kos, alamat..."
                        value="{{ $search }}"
                    >
                </div>
                <select name="kategori" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Tipe</option>
                    <option value="putri"     {{ $kategori == 'putri'     ? 'selected' : '' }}>Putri</option>
                    <option value="putra"     {{ $kategori == 'putra'     ? 'selected' : '' }}>Putra</option>
                    <option value="campur"    {{ $kategori == 'campur'    ? 'selected' : '' }}>Campur</option>
                    <option value="exclusive" {{ $kategori == 'exclusive' ? 'selected' : '' }}>Exclusive</option>
                </select>
                <button type="submit" class="btn-add" style="background:var(--sage-dark);">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/></svg>
                    Cari
                </button>
                @if($search || $kategori)
                <a href="{{ route('owner.kos.index') }}" style="font-size:13px;color:var(--text-light);text-decoration:none;">Reset</a>
                @endif
            </div>
        </form>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-head">
                <span class="table-head-title">Daftar Kos Anda</span>
                <span class="table-head-count">{{ $kosList->total() }} kos ditemukan</span>
            </div>

            @if($kosList->count() > 0)
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Properti</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Kamar Tersedia</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kosList as $kos)
                            @if(!isset($kos->status) || $kos->status !== 'aktif')
                                @continue
                            @endif
                        @php
                            $badgeType  = $kos->is_eksklusif ? 'badge-exclusive' : 'badge-' . $kos->tipe;
                            $badgeLabel = $kos->is_eksklusif ? 'Eksklusif' : ucfirst($kos->tipe);
                        @endphp
                        <tr>
                            <td>
                                <div class="kos-row-info">
                                    <div class="kos-row-img">
                                        @if($kos->foto_utama)
                                            <img src="{{ asset('storage/' . $kos->foto_utama) }}" alt="{{ $kos->nama }}">
                                        @else
                                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="rgba(74,107,80,0.5)" stroke-width="1.5"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="kos-row-name">{{ $kos->nama }}</div>
                                        <div class="kos-row-loc">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                            {{ Str::limit($kos->alamat, 35) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge {{ $badgeType }}">{{ $badgeLabel }}</span></td>
                            <td><strong>{{ $kos->harga_format }}</strong><small style="color:var(--text-light)">/bln</small></td>
                            <td>
                                <span style="font-weight:700;font-size:15px;">{{ $kos->kamar_tersedia }}</span>
                                <small style="color:var(--text-light)"> kamar</small>
                            </td>
                            <td>
                                @if(isset($kos->status) && $kos->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif(isset($kos->status) && $kos->status === 'nonaktif')
                                    <span class="badge badge-inactive">Nonaktif</span>
                                @else
                                    <span class="badge badge-active">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('kos.show', $kos->id) }}" class="btn-icon" title="Lihat">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    <a href="{{ route('owner.kos.edit', $kos->id) }}" class="btn-icon" title="Edit">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('owner.kos.destroy', $kos->id) }}" onsubmit="return confirm('Hapus kos \'{{ $kos->nama }}\'?')" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon danger" title="Hapus">
                                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($kosList->hasPages())
            <div class="pagination-wrap">
                {{ $kosList->links() }}
            </div>
            @endif

            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="1.5">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                </div>
                <div class="empty-title">
                    @if($search || $kategori)
                        Tidak ada kos yang cocok
                    @else
                        Belum ada kos
                    @endif
                </div>
                <div class="empty-sub">
                    @if($search || $kategori)
                        Coba ubah kata kunci atau filter pencarian Anda.
                    @else
                        Mulai tambahkan kos pertama Anda sekarang!
                    @endif
                </div>
                @if(!$search && !$kategori)
                <a href="{{ route('owner.kos.create') }}" class="btn-add" style="display:inline-flex;margin:0 auto;">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Kos Pertama
                </a>
                @endif
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
