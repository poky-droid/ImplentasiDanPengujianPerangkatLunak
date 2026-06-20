<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Notifikasi — Rumantra</title>
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
            --gold-light:  #E8C97A;
            --border:      #E2EAE3;
            --danger:      #E57373;
            --success:     #66BB6A;
            --sidebar-w:   260px;
            --card-shadow: 0 2px 16px rgba(58,85,64,0.10);
            --card-hover:  0 8px 32px rgba(58,85,64,0.18);
            --radius:      14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* ═══════════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sage-deeper);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 200;
            transition: transform .3s ease;
        }
        .sidebar-header {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-logo {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: rgba(255,255,255,0.12);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: 3px; flex-shrink: 0;
        }
        .sidebar-logo img { width: 36px; height: 36px; object-fit: contain; }
        .sidebar-brand {
            font-size: 16px; font-weight: 800;
            color: #fff; letter-spacing: 1.8px;
            text-transform: uppercase; text-decoration: none;
        }
        .sidebar-user {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 12px;
        }
        .sidebar-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: linear-gradient(135deg, var(--sage-light), var(--sage-dark));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px; color: #fff; flex-shrink: 0; overflow: hidden;
        }
        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-info { overflow: hidden; }
        .sidebar-user-name {
            font-size: 14px; font-weight: 600; color: #fff;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role { font-size: 11px; color: var(--sage-light); font-weight: 500; margin-top: 2px; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
            text-transform: uppercase; color: rgba(255,255,255,0.35); padding: 12px 12px 6px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 11px;
            padding: 11px 12px; border-radius: 10px; text-decoration: none;
            color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500;
            margin-bottom: 2px; transition: background .2s, color .2s; cursor: pointer;
        }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: rgba(255,255,255,0.15); color: #fff; font-weight: 600; }
        .nav-item svg { flex-shrink: 0; opacity: .8; }
        .nav-item.active svg { opacity: 1; }
        .nav-badge {
            margin-left: auto; background: var(--gold); color: #fff;
            font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px;
        }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 11px 12px; border-radius: 10px; border: none;
            background: rgba(229,115,115,0.15); color: #ef9a9a;
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
            cursor: pointer; transition: background .2s, color .2s; text-decoration: none;
        }
        .btn-logout:hover { background: rgba(229,115,115,0.3); color: #ef5350; }
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.4); z-index: 199;
        }

        /* ═══════════════════════════════════════
           MAIN CONTENT
        ═══════════════════════════════════════ */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px; height: 68px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger-btn {
            display: none; background: none; border: none; cursor: pointer;
            padding: 6px; color: var(--text-dark);
        }
        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 14px; color: var(--text-light);
        }
        .topbar-breadcrumb span:last-child { color: var(--text-dark); font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-date { font-size: 13px; color: var(--text-light); }
        .topbar-icon-btn {
            width: 38px; height: 38px; border-radius: 10px;
            border: 1.5px solid var(--border); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-mid); text-decoration: none;
            transition: border-color .2s, color .2s; position: relative;
        }
        .topbar-icon-btn:hover { border-color: var(--sage-light); color: var(--sage-deeper); }
        .topbar-icon-btn.active-notif { border-color: var(--sage); color: var(--sage-deeper); background: var(--sage-bg); }
        .notif-badge-top {
            position: absolute; top: -5px; right: -5px;
            min-width: 18px; height: 18px; padding: 0 4px;
            background: var(--danger); color: #fff;
            font-size: 10px; font-weight: 700;
            border-radius: 9px; border: 2px solid var(--white);
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Page body ── */
        .page-body { padding: 32px 36px; flex: 1; }

        /* ── Page Header ── */
        .page-header-bar {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-title-group { }
        .page-title {
            font-size: 22px; font-weight: 800; color: var(--text-dark);
            display: flex; align-items: center; gap: 10px; margin-bottom: 4px;
        }
        .page-title svg { color: var(--sage-deeper); }
        .page-subtitle { font-size: 13px; color: var(--text-light); }

        /* ── Mark All Button ── */
        .btn-mark-all {
            display: flex; align-items: center; gap: 7px;
            background: var(--sage-deeper); color: #fff;
            border: none; border-radius: 10px; padding: 9px 18px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: background .2s, transform .15s;
        }
        .btn-mark-all:hover { background: var(--sage-dark); transform: translateY(-1px); }
        .btn-mark-all:disabled { background: var(--text-light); cursor: not-allowed; transform: none; }

        /* ── Alert Flash ── */
        .flash-alert {
            display: flex; align-items: center; gap: 10px;
            padding: 14px 20px; border-radius: 12px; margin-bottom: 20px;
            font-size: 14px; font-weight: 500;
        }
        .flash-alert.success { background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }

        /* ── Notification List ── */
        .notif-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .notif-filters {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
        }
        .filter-btn {
            padding: 6px 16px; border-radius: 20px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 600; cursor: pointer; border: 1.5px solid var(--border);
            background: var(--white); color: var(--text-mid); transition: all .2s;
        }
        .filter-btn:hover { border-color: var(--sage-light); color: var(--sage-deeper); }
        .filter-btn.active { background: var(--sage-deeper); color: #fff; border-color: var(--sage-deeper); }

        .notif-list { }

        .notif-row {
            display: flex; align-items: flex-start; gap: 16px;
            padding: 18px 24px; border-bottom: 1px solid var(--border);
            transition: background .15s; position: relative;
        }
        .notif-row:last-child { border-bottom: none; }
        .notif-row:hover { background: var(--sage-bg); }
        .notif-row.unread { background: #F5FAF6; }
        .notif-row.unread::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--sage);
            border-radius: 0 2px 2px 0;
        }

        /* dot icon */
        .notif-icon {
            width: 42px; height: 42px; border-radius: 50%;
            flex-shrink: 0; display: flex; align-items: center; justify-content: center;
            margin-top: 2px;
        }
        .notif-icon.green  { background: #d1fae5; }
        .notif-icon.blue   { background: #dbeafe; }
        .notif-icon.yellow { background: #fef9c3; }
        .notif-icon.red    { background: #fee2e2; }
        .notif-icon.green  svg { color: #10b981; }
        .notif-icon.blue   svg { color: #3b82f6; }
        .notif-icon.yellow svg { color: #f59e0b; }
        .notif-icon.red    svg { color: #ef4444; }

        /* content */
        .notif-body { flex: 1; min-width: 0; }
        .notif-row-title {
            font-size: 14px; font-weight: 700; color: var(--text-dark);
            margin-bottom: 4px; line-height: 1.3;
        }
        .notif-row-isi {
            font-size: 13px; color: var(--text-mid);
            line-height: 1.6; margin-bottom: 6px;
        }
        .notif-meta {
            display: flex; align-items: center; gap: 12px;
        }
        .notif-date { font-size: 11px; color: var(--text-light); }
        .notif-tipe-badge {
            font-size: 10px; font-weight: 700; padding: 3px 10px;
            border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .tipe-booking    { background: #dbeafe; color: #1d4ed8; }
        .tipe-pembayaran { background: #d1fae5; color: #065f46; }
        .tipe-review     { background: #fef9c3; color: #92400e; }
        .tipe-sistem     { background: #fee2e2; color: #991b1b; }
        .notif-unread-dot {
            width: 8px; height: 8px; background: var(--sage); border-radius: 50%;
        }

        /* actions */
        .notif-actions { flex-shrink: 0; display: flex; align-items: flex-start; gap: 8px; padding-top: 2px; }
        .btn-read-one {
            font-size: 12px; font-weight: 600; color: var(--sage-dark);
            background: var(--sage-bg); border: 1px solid var(--border);
            border-radius: 8px; padding: 6px 12px; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all .2s;
            white-space: nowrap;
        }
        .btn-read-one:hover { background: var(--sage-deeper); color: #fff; border-color: var(--sage-deeper); }
        .btn-read-one:disabled { opacity: .4; cursor: default; }
        .read-label {
            font-size: 12px; color: var(--text-light); padding: 6px 0;
            display: flex; align-items: center; gap: 4px;
        }

        /* ── Empty State ── */
        .empty-state {
            padding: 72px 24px; text-align: center; color: var(--text-light);
        }
        .empty-state svg { margin-bottom: 20px; opacity: .35; }
        .empty-icon-wrap {
            width: 80px; height: 80px; border-radius: 50%;
            background: var(--sage-bg); display: flex; align-items: center;
            justify-content: center; margin: 0 auto 20px;
        }
        .empty-state h3 { font-size: 17px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }
        .empty-state p { font-size: 13px; line-height: 1.7; }

        /* ── Stats Row ── */
        .stats-row {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;
        }
        .stat-mini {
            background: var(--white); border-radius: 12px;
            padding: 18px 20px; box-shadow: var(--card-shadow);
            display: flex; align-items: center; gap: 14px;
        }
        .stat-mini-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-mini-icon.all    { background: var(--sage-bg); color: var(--sage-deeper); }
        .stat-mini-icon.unread { background: #fee2e2; color: #ef4444; }
        .stat-mini-icon.read   { background: #d1fae5; color: #10b981; }
        .stat-mini-val { font-size: 22px; font-weight: 800; color: var(--text-dark); line-height: 1; }
        .stat-mini-lbl { font-size: 11px; color: var(--text-light); margin-top: 3px; }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger-btn { display: flex; }
            .sidebar-overlay.show { display: block; }
            .page-body { padding: 24px 20px; }
            .topbar { padding: 0 20px; }
            .stats-row { grid-template-columns: repeat(3, 1fr); }
            .page-header-bar { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
        @media (max-width: 600px) {
            .stats-row { grid-template-columns: 1fr 1fr; }
            .notif-actions { display: none; }
        }
    </style>
</head>
<body>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ═══════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
        </div>
        <a href="{{ route('owner.dashboard') }}" class="sidebar-brand">Rumantra</a>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">
            @if(auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="sidebar-user-info">
            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-user-role">🏠 Pemilik Kos</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>

        <a href="{{ route('owner.dashboard') }}" class="nav-item" id="nav-dashboard">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('owner.kos.index') }}" class="nav-item" id="nav-kos">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                <path d="M9 21V12h6v9"/>
            </svg>
            Kelola Kos
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Komunikasi</div>

        <a href="{{ route('owner.notifications') }}" class="nav-item active" id="nav-notif">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            Notifikasi
            @if($unreadCount > 0)
                <span class="nav-badge">{{ $unreadCount }}</span>
            @endif
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Akun</div>

        <a href="{{ route('profile.index') }}" class="nav-item" id="nav-profile">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profil Saya
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- ═══════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════ -->
<div class="main">

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <div class="topbar-breadcrumb">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span>Owner</span>
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Notifikasi</span>
            </div>
        </div>

        <div class="topbar-right">
            <span class="topbar-date">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>
            <a href="{{ route('owner.notifications') }}" class="topbar-icon-btn active-notif" title="Notifikasi">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                @if($unreadCount > 0)
                    <span class="notif-badge-top">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                @endif
            </a>
        </div>
    </header>

    <!-- Page Body -->
    <div class="page-body">

        <!-- Flash success -->
        @if(session('success'))
            <div class="flash-alert success" id="flashAlert">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header-bar">
            <div class="page-title-group">
                <div class="page-title">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    Notifikasi
                </div>
                <div class="page-subtitle">
                    Kelola semua notifikasi dari sistem, booking, dan pembayaran
                </div>
            </div>

            @if($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('owner.notifications.readAll') }}" method="POST" id="markAllForm">
                    @csrf
                    <button type="submit" class="btn-mark-all" id="btnMarkAll">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Tandai Semua Dibaca
                    </button>
                </form>
            @else
                <button class="btn-mark-all" disabled title="Semua notifikasi sudah dibaca">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Semua Sudah Dibaca
                </button>
            @endif
        </div>

        <!-- Stats Mini -->
        <div class="stats-row">
            <div class="stat-mini">
                <div class="stat-mini-icon all">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-mini-val">{{ $notifications->count() }}</div>
                    <div class="stat-mini-lbl">Total Notifikasi</div>
                </div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-icon unread">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-mini-val">{{ $unreadCount }}</div>
                    <div class="stat-mini-lbl">Belum Dibaca</div>
                </div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-icon read">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-mini-val">{{ $notifications->where('is_read', true)->count() }}</div>
                    <div class="stat-mini-lbl">Sudah Dibaca</div>
                </div>
            </div>
        </div>

        <!-- Notification Card -->
        <div class="notif-card">

            @if($notifications->count() > 0)
                <div class="notif-list" id="notifList">
                    @foreach($notifications as $notif)
                        <div class="notif-row {{ $notif->is_read ? '' : 'unread' }}" id="notif-row-{{ $notif->id }}">

                            {{-- Icon berdasarkan tipe --}}
                            <div class="notif-icon {{ $notif->dot_color }}">
                                @if($notif->tipe === 'booking')
                                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <path d="M16 2v4M8 2v4M3 10h18"/>
                                    </svg>
                                @elseif($notif->tipe === 'pembayaran')
                                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <rect x="1" y="4" width="22" height="16" rx="2"/>
                                        <path d="M1 10h22"/>
                                    </svg>
                                @elseif($notif->tipe === 'review')
                                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                @else
                                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="notif-body">
                                <div class="notif-row-title">
                                    {{ $notif->judul }}
                                </div>
                                <div class="notif-row-isi">{{ $notif->isi }}</div>
                                <div class="notif-meta">
                                    <span class="notif-date">
                                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:3px;">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                        {{ $notif->created_at->locale('id')->diffForHumans() }}
                                        &nbsp;·&nbsp;
                                        {{ $notif->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                                    </span>
                                    <span class="notif-tipe-badge tipe-{{ $notif->tipe }}">{{ $notif->tipe_label }}</span>
                                    @if(!$notif->is_read)
                                        <span class="notif-unread-dot" title="Belum dibaca"></span>
                                    @endif
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="notif-actions">
                                @if(!$notif->is_read)
                                    <button class="btn-read-one"
                                            id="btn-read-{{ $notif->id }}"
                                            onclick="markOneRead({{ $notif->id }}, this)">
                                        Tandai Dibaca
                                    </button>
                                @else
                                    <span class="read-label">
                                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Dibaca
                                    </span>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

            @else
                {{-- Empty State --}}
                <div class="empty-state">
                    <div class="empty-icon-wrap">
                        <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="var(--sage-light)" stroke-width="1.5">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                    </div>
                    <h3>Belum Ada Notifikasi</h3>
                    <p>Notifikasi terkait booking, pembayaran,<br>dan ulasan akan muncul di sini.</p>
                </div>
            @endif

        </div>
    </div><!-- /page-body -->
</div><!-- /main -->

<script>
    // ── SIDEBAR MOBILE ────────────────────────────────────
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }

    // ── MARK ONE AS READ (AJAX) ────────────────────────────
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function markOneRead(id, btn) {
        btn.disabled = true;
        btn.textContent = '…';

        fetch(`/owner/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const row = document.getElementById('notif-row-' + id);
                if (row) {
                    row.classList.remove('unread');
                    // Hapus garis hijau kiri dengan menghapus style before (via class)
                    // Ganti tombol dengan label "Dibaca"
                    const actDiv = btn.closest('.notif-actions');
                    actDiv.innerHTML = `
                        <span class="read-label">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Dibaca
                        </span>`;
                    // Hapus dot belum dibaca
                    const dot = row.querySelector('.notif-unread-dot');
                    if (dot) dot.remove();
                }
                updateBadgeCounts(-1);
            }
        })
        .catch(() => {
            btn.disabled = false;
            btn.textContent = 'Tandai Dibaca';
            alert('Terjadi kesalahan, coba lagi.');
        });
    }

    function updateBadgeCounts(delta) {
        // Update badge di topbar
        const badge = document.querySelector('.notif-badge-top');
        if (badge) {
            let current = parseInt(badge.textContent.replace('+','')) || 0;
            let newVal = Math.max(0, current + delta);
            if (newVal === 0) {
                badge.remove();
                // Disable mark all button
                const btnMarkAll = document.getElementById('btnMarkAll');
                if (btnMarkAll) {
                    btnMarkAll.disabled = true;
                    btnMarkAll.textContent = 'Semua Sudah Dibaca';
                }
            } else {
                badge.textContent = newVal > 99 ? '99+' : newVal;
            }
        }
        // Update nav badge di sidebar
        const navBadge = document.querySelector('#nav-notif .nav-badge');
        if (navBadge) {
            let current = parseInt(navBadge.textContent) || 0;
            let newVal = Math.max(0, current + delta);
            if (newVal === 0) navBadge.remove();
            else navBadge.textContent = newVal;
        }
        // Update stat card belum dibaca
        const statMini = document.querySelectorAll('.stat-mini-val');
        if (statMini[1]) {
            let cur = parseInt(statMini[1].textContent) || 0;
            statMini[1].textContent = Math.max(0, cur + delta);
        }
        if (statMini[2]) {
            let cur = parseInt(statMini[2].textContent) || 0;
            statMini[2].textContent = Math.max(0, cur - delta);
        }
    }

    // ── AUTO-HIDE FLASH ────────────────────────────────────
    const flash = document.getElementById('flashAlert');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity .5s';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 3500);
    }
</script>

</body>
</html>
