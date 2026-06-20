<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminKost - @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-bg: #1E3A35;
            --sidebar-text: #ffffff;
            --sidebar-muted: rgba(255,255,255,0.45);
            --sidebar-active-bg: rgba(255,255,255,0.15);
            --sidebar-hover-bg: rgba(255,255,255,0.08);
            --sidebar-width: 260px;
            --topbar-height: 64px;

            --bg-main: #F3F2EE;
            --bg-card: #ffffff;
            --text-primary: #1a1a1a;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;

            --accent: #1E3A35;
            --accent-hover: #162e29;
            --accent-light: #e8f0ef;

            --border: #e5e7eb;
            --border-light: #f3f4f6;

            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;

            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.12);
            --radius: 14px;
            --radius-sm: 8px;
            --radius-lg: 20px;

            --font-main: 'Plus Jakarta Sans', sans-serif;
        }

        html, body { height: 100%; }

        body {
            font-family: var(--font-main);
            background: var(--bg-main);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            overflow: hidden;
        }

        .sidebar-logo {
            padding: 28px 24px 20px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.3px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            flex-shrink: 0;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0 24px;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--sidebar-muted);
            padding: 16px 24px 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            margin: 2px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .nav-item:hover {
            background: var(--sidebar-hover-bg);
            color: #fff;
        }
        .nav-item.active {
            background: var(--sidebar-active-bg);
            color: #fff;
            font-weight: 600;
        }
        .nav-item svg { flex-shrink: 0; opacity: 0.8; }
        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .nav-item.keluar {
            color: rgba(255,255,255,0.55);
        }
        .nav-item.keluar:hover {
            color: #fca5a5;
            background: rgba(239,68,68,0.12);
        }

        /* ── MAIN LAYOUT ── */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: var(--topbar-height);
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.2px;
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .avatar:hover { opacity: 0.85; }

        /* ── PAGE CONTENT ── */
        .page-content {
            flex: 1;
            padding: 32px;
        }

        /* ── CARDS ── */
        .card {
            background: var(--bg-card);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 6px;
            font-weight: 500;
        }

        /* ── TABLE ── */
        .table-section { margin-bottom: 32px; }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            gap: 16px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.3px;
        }

        .table-wrapper {
            background: var(--bg-card);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--accent);
        }

        thead th {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 14px 18px;
            text-align: left;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border-light);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f9fafb; }

        tbody td {
            padding: 13px 18px;
            font-size: 13.5px;
            color: var(--text-primary);
        }

        .td-muted { color: var(--text-secondary); }

        /* ── BADGES ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }
        .badge-info    { background: #dbeafe; color: #1e40af; }
        .badge-gray    { background: #f3f4f6; color: #374151; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            text-decoration: none;
            white-space: nowrap;
            font-family: var(--font-main);
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }
        .btn-primary:hover { background: var(--accent-hover); box-shadow: 0 4px 12px rgba(30,58,53,0.3); }

        .btn-outline {
            background: transparent;
            color: var(--text-secondary);
            border: 1.5px solid var(--border);
        }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent); }

        .btn-outline.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 7px; }
        .btn-danger-outline {
            background: transparent;
            color: var(--danger);
            border: 1.5px solid #fca5a5;
            font-family: var(--font-main);
            border-radius: 7px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger-outline:hover { background: #fee2e2; }

        /* ── SEARCH ── */
        .search-box {
            position: relative;
        }
        .search-box svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        .search-input {
            background: #f1f0ec;
            border: none;
            border-radius: 50px;
            padding: 9px 18px 9px 40px;
            font-size: 13.5px;
            font-family: var(--font-main);
            color: var(--text-primary);
            outline: none;
            width: 260px;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .search-input::placeholder { color: var(--text-muted); }
        .search-input:focus { background: #eae9e4; box-shadow: 0 0 0 3px rgba(30,58,53,0.1); }

        /* ── FILTER TABS ── */
        .filter-tabs {
            display: flex;
            gap: 8px;
        }

        /* ── ACTION BUTTONS IN TABLE ── */
        .action-group { display: flex; gap: 6px; }

        .btn-icon {
            width: 30px; height: 30px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
            border: 1px solid var(--border);
            background: var(--bg-card);
            color: var(--text-secondary);
        }
        .btn-icon:hover { border-color: var(--accent); color: var(--accent); }
        .btn-icon.danger:hover { border-color: var(--danger); color: var(--danger); background: #fee2e2; }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(3px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }

        .modal {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 32px;
            width: 100%;
            max-width: 480px;
            box-shadow: var(--shadow-lg);
            transform: scale(0.96);
            transition: transform 0.2s;
        }
        .modal-overlay.open .modal { transform: scale(1); }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--text-primary);
        }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 7px;
        }
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 14px;
            font-family: var(--font-main);
            color: var(--text-primary);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
        }
        .form-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(30,58,53,0.1); }

        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 14px;
            font-family: var(--font-main);
            color: var(--text-primary);
            outline: none;
            background: #fff;
            cursor: pointer;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        /* ── DUAL TABLE GRID (Dashboard) ── */
        .dual-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
        }
        .empty-state svg { margin: 0 auto 12px; opacity: 0.3; }
        .empty-state p { font-size: 14px; }

        /* ── TOAST ── */
        .toast-container {
            position: fixed;
            bottom: 24px; right: 24px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .toast {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #1a1a1a;
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            animation: slideInToast 0.3s ease;
        }
        .toast.success { background: #065f46; }
        .toast.error { background: #991b1b; }
        @keyframes slideInToast {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── PAGINATION ── */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 20px;
        }
        .page-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            background: var(--bg-card);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
            color: var(--text-secondary);
            font-family: var(--font-main);
        }
        .page-btn:hover { border-color: var(--accent); color: var(--accent); }
        .page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
        .page-btn:disabled { opacity: 0.4; cursor: not-allowed; }

        @media (max-width: 900px) {
            .dual-grid { grid-template-columns: 1fr; }
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo">
        @if(auth()->check() && auth()->user()->role === 'owner')
            Rumantra Owner
        @else
            AdminKost
        @endif
    </div>
    <nav class="sidebar-nav">
        @if(auth()->check() && auth()->user()->role === 'owner')
            <a href="{{ route('owner.dashboard') }}" class="nav-item {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <div class="nav-section-label">Manajemen</div>
            <a href="{{ route('owner.kos.index') }}" class="nav-item {{ request()->routeIs('owner.kos.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/><path d="M9 21V12h6v9"/></svg>
                Kelola Kos
            </a>
            <a href="{{ route('owner.notifications') }}" class="nav-item {{ request()->routeIs('owner.notifications*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                Notifikasi
            </a>
            <a href="{{ route('profile.index') }}" class="nav-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profil Saya
            </a>
        @else
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <div class="nav-section-label">Manajemen</div>
            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                List User
            </a>
            <a href="{{ route('admin.owners.index') }}" class="nav-item {{ request()->routeIs('admin.owners.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                List Owner
            </a>
            <a href="{{ route('admin.pengajuan.index') }}" class="nav-item {{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Pengajuan Mitra
            </a>

            <div class="nav-section-label">Transaksi</div>
            <a href="{{ route('admin.bookings.index') }}" class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Booking
            </a>
            <a href="{{ route('admin.pembayaran.index') }}" class="nav-item {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Pembayaran
            </a>
            <a href="{{ route('admin.komplain.index') }}" class="nav-item {{ request()->routeIs('admin.komplain.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Komplain
            </a>
        @endif
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item keluar" style="width:100%; border:none; background:none; text-align:left;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<div class="main-wrapper">
    <header class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-right">
            <div class="avatar" title="{{ auth()->user()->name ?? 'Admin' }}">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
        </div>
    </header>

    <main class="page-content">
        @if(session('success'))
            <div class="toast success" style="position:relative;margin-bottom:16px;animation:none;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="toast error" style="position:relative;margin-bottom:16px;animation:none;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

<div class="toast-container" id="toastContainer"></div>

<script>
function showToast(msg, type = 'success') {
    const tc = document.getElementById('toastContainer');
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML = msg;
    tc.appendChild(t);
    setTimeout(() => t.remove(), 3500);
}

function openModal(id) {
    document.getElementById(id).classList.add('open');
}
function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}

// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', e => {
        if (e.target === overlay) overlay.classList.remove('open');
    });
});
</script>
@stack('scripts')
</body>
</html>
