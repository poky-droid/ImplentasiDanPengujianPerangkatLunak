<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Dashboard Owner - Rumantra</title>
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
            --info:        #4FC3F7;
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

        /* ════════════════════════════════════════
           SIDEBAR
        ════════════════════════════════════════ */
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
            overflow: hidden; padding: 3px;
            flex-shrink: 0;
        }
        .sidebar-logo img { width: 36px; height: 36px; object-fit: contain; }

        .sidebar-brand {
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .sidebar-user {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--sage-light), var(--sage-dark));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px; color: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }
        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-info { overflow: hidden; }
        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-user-role {
            font-size: 11px;
            color: var(--sage-light);
            font-weight: 500;
            margin-top: 2px;
        }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 12px 12px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: rgba(255,255,255,0.7);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 2px;
            transition: background .2s, color .2s;
            cursor: pointer;
        }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: rgba(255,255,255,0.15); color: #fff; font-weight: 600; }
        .nav-item svg { flex-shrink: 0; opacity: .8; }
        .nav-item.active svg { opacity: 1; }
        .nav-badge {
            margin-left: auto;
            background: var(--gold);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 12px;
            border-radius: 10px;
            border: none;
            background: rgba(229,115,115,0.15);
            color: #ef9a9a;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s, color .2s;
            text-decoration: none;
        }
        .btn-logout:hover { background: rgba(229,115,115,0.3); color: #ef5350; }

        /* ════════════════════════════════════════
           MAIN CONTENT
        ════════════════════════════════════════ */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left { display: flex; align-items: center; gap: 16px; }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: var(--text-dark);
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-light);
        }
        .topbar-breadcrumb span:last-child { color: var(--text-dark); font-weight: 600; }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-date {
            font-size: 13px;
            color: var(--text-light);
        }

        .btn-add-kos {
            display: flex;
            align-items: center;
            gap: 7px;
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, transform .15s;
        }
        .btn-add-kos:hover { background: var(--sage-dark); transform: translateY(-1px); }

        .topbar-icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--text-mid);
            text-decoration: none;
            transition: border-color .2s, color .2s;
            position: relative;
        }
        .topbar-icon-btn:hover { border-color: var(--sage-light); color: var(--sage-deeper); }

        .notif-dot {
            width: 8px; height: 8px;
            background: var(--danger);
            border-radius: 50%;
            position: absolute;
            top: 6px; right: 6px;
            border: 1.5px solid var(--white);
        }

        /* ── Page body ── */
        .page-body { padding: 32px 36px; flex: 1; }

        /* ── Welcome Banner ── */
        .welcome-banner {
            background: linear-gradient(135deg, var(--sage-deeper) 0%, #2E6B40 50%, var(--sage-dark) 100%);
            border-radius: 20px;
            padding: 32px 36px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -60px; right: 100px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .welcome-text { position: relative; z-index: 1; }
        .welcome-greeting {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }
        .welcome-sub {
            font-size: 13px;
            color: rgba(255,255,255,0.65);
            line-height: 1.6;
        }

        .welcome-illustration {
            position: relative; z-index: 1;
            display: flex;
            gap: 12px;
        }
        .welcome-stat-mini {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            padding: 16px 20px;
            text-align: center;
            min-width: 90px;
            backdrop-filter: blur(4px);
        }
        .welcome-stat-mini-value {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
        }
        .welcome-stat-mini-label {
            font-size: 11px;
            color: rgba(255,255,255,0.65);
            margin-top: 4px;
        }

        /* ── Stat Cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 22px 24px;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: transform .2s, box-shadow .2s;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--card-hover); }
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
            border-radius: 14px 0 0 14px;
        }
        .stat-card.green::after  { background: linear-gradient(to bottom, #66BB6A, #388E3C); }
        .stat-card.blue::after   { background: linear-gradient(to bottom, #4FC3F7, #0277BD); }
        .stat-card.gold::after   { background: linear-gradient(to bottom, var(--gold-light), var(--gold)); }
        .stat-card.purple::after { background: linear-gradient(to bottom, #CE93D8, #8E24AA); }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-card.green  .stat-icon { background: #E8F5E9; }
        .stat-card.blue   .stat-icon { background: #E1F5FE; }
        .stat-card.gold   .stat-icon { background: #FFF8E1; }
        .stat-card.purple .stat-icon { background: #F3E5F5; }

        .stat-info { flex: 1; }
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 500;
        }
        .stat-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 8px;
        }
        .stat-trend.up   { color: #4CAF50; }
        .stat-trend.down { color: var(--danger); }

        /* ── Content Grid ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
        }

        /* ── Section Card ── */
        .section-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .section-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .section-head-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
        }
        .section-head-action {
            font-size: 13px;
            color: var(--sage-deeper);
            text-decoration: none;
            font-weight: 600;
            transition: color .2s;
        }
        .section-head-action:hover { color: var(--sage-dark); }

        /* ── KOS TABLE ── */
        .kos-table { width: 100%; border-collapse: collapse; }
        .kos-table th {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text-light);
            padding: 12px 24px;
            text-align: left;
            background: #FAFBFA;
            border-bottom: 1px solid var(--border);
        }
        .kos-table td {
            padding: 14px 24px;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
            color: var(--text-dark);
            vertical-align: middle;
        }
        .kos-table tr:last-child td { border-bottom: none; }
        .kos-table tr:hover td { background: #FAFBFA; }

        .kos-row-info { display: flex; align-items: center; gap: 12px; }
        .kos-row-img {
            width: 44px; height: 44px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--sage-bg);
            flex-shrink: 0;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .kos-row-img img { width: 100%; height: 100%; object-fit: cover; }
        .kos-row-name { font-weight: 600; font-size: 13px; color: var(--text-dark); }
        .kos-row-loc { font-size: 11px; color: var(--text-light); margin-top: 2px; display: flex; align-items: center; gap: 3px; }

        .badge {
            display: inline-flex;
            align-items: center;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }
        .badge-active   { background: #E8F5E9; color: #2E7D32; }
        .badge-inactive { background: #FFF3E0; color: #E65100; }
        .badge-putri    { background: #FFE8EF; color: #C0516A; }
        .badge-putra    { background: #E8F0FF; color: #4A6BC0; }
        .badge-campur   { background: #E8F5E9; color: #2E7D32; }
        .badge-exclusive{ background: #FFF3D6; color: #B8860B; }

        .table-actions { display: flex; gap: 6px; }
        .btn-icon {
            width: 30px; height: 30px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--text-mid);
            text-decoration: none;
            transition: all .2s;
        }
        .btn-icon:hover { border-color: var(--sage-light); color: var(--sage-deeper); background: var(--sage-bg); }
        .btn-icon.danger:hover { border-color: var(--danger); color: var(--danger); background: #FFF5F5; }

        /* ── Activity feed ── */
        .activity-list { padding: 8px 0; }
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 24px;
            border-bottom: 1px solid var(--border);
            transition: background .2s;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: #FAFBFA; }

        .activity-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .activity-icon.booking  { background: #E1F5FE; color: #0277BD; }
        .activity-icon.payment  { background: #E8F5E9; color: #2E7D32; }
        .activity-icon.review   { background: #FFF8E1; color: #F57C00; }
        .activity-icon.chat     { background: #EDE7F6; color: #6A1B9A; }

        .activity-body { flex: 1; min-width: 0; }
        .activity-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .activity-desc { font-size: 12px; color: var(--text-light); margin-top: 2px; line-height: 1.5; }
        .activity-time { font-size: 11px; color: var(--text-light); flex-shrink: 0; margin-top: 2px; }

        /* ── Quick Links ── */
        .quick-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding: 20px 24px;
        }
        .quick-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 16px 10px;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            background: var(--white);
            cursor: pointer;
            text-decoration: none;
            color: var(--text-mid);
            font-size: 12px;
            font-weight: 600;
            transition: all .2s;
            text-align: center;
        }
        .quick-link:hover { border-color: var(--sage-light); background: var(--sage-bg); color: var(--sage-deeper); transform: translateY(-2px); }
        .quick-link-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            background: var(--sage-bg);
        }
        .quick-link:hover .quick-link-icon { background: rgba(58,85,64,0.1); }

        /* ── Empty state ── */
        .empty-state {
            padding: 48px 24px;
            text-align: center;
            color: var(--text-light);
        }
        .empty-state svg { margin-bottom: 16px; opacity: .4; }
        .empty-state p { font-size: 14px; margin-bottom: 16px; }
        .empty-state a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--sage-deeper);
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background .2s;
        }
        .empty-state a:hover { background: var(--sage-dark); }

        /* ── Sidebar overlay (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 199;
        }

        /* ── Responsive ── */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .content-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger-btn { display: flex; }
            .sidebar-overlay { display: none; }
            .sidebar-overlay.show { display: block; }
            .page-body { padding: 24px 20px; }
            .topbar { padding: 0 20px; }
            .welcome-banner { flex-direction: column; align-items: flex-start; gap: 20px; }
        }
        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .welcome-illustration { flex-wrap: wrap; }
        }
    </style>
</head>
<body>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════ -->
<aside class="sidebar" id="sidebar">

    <!-- Brand -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
        </div>
        <a href="{{ route('owner.dashboard') }}" class="sidebar-brand">Rumantra</a>
    </div>

    <!-- User info -->
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

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>

        <a href="{{ route('owner.dashboard') }}" class="nav-item active" id="nav-dashboard">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('owner.kos.index') }}" class="nav-item" id="nav-kos">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                <path d="M9 21V12h6v9"/>
            </svg>
            Kelola Kos
            @if(isset($kosList) && $kosList->count() > 0)
                <span class="nav-badge">{{ $kosList->count() }}</span>
            @endif
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Manajemen</div>

        <a href="{{ route('booking.create', ['kos' => 1]) }}" class="nav-item" id="nav-booking" onclick="return false;" style="pointer-events:none; opacity:.5;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            Booking
        </a>

        <a href="#" class="nav-item" id="nav-pembayaran">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="1" y="4" width="22" height="16" rx="2"/>
                <path d="M1 10h22"/>
            </svg>
            Pembayaran
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Komunikasi</div>

        <a href="{{ route('owner.notifications') }}" class="nav-item" id="nav-notif">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            Notifikasi
            @php
                $navUnreadCount = \App\Models\OwnerNotification::forOwner(auth()->id())->unread()->count();
            @endphp
            @if($navUnreadCount > 0)
                <span class="nav-badge">{{ $navUnreadCount }}</span>
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

    <!-- Logout -->
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

<!-- ════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════ -->
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
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                <span>Owner</span>
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Dashboard</span>
            </div>
        </div>

        <div class="topbar-right">
            <span class="topbar-date">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>

            <a href="{{ route('owner.notifications') }}" class="topbar-icon-btn" title="Notifikasi">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                @php
                    $topbarUnread = \App\Models\OwnerNotification::forOwner(auth()->id())->unread()->count();
                @endphp
                @if($topbarUnread > 0)
                    <span class="notif-dot" style="background:var(--danger);width:10px;height:10px;top:4px;right:4px;"></span>
                @endif
            </a>

            <a href="{{ route('kos.create') }}" class="btn-add-kos">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Kos
            </a>
        </div>
    </header>

    <!-- Page body -->
    <div class="page-body">

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <div class="welcome-greeting">
                    👋 Halo, {{ auth()->user()->name }}!
                </div>
                <div class="welcome-sub">
                    Selamat datang di dashboard Pemilik Kos.<br>
                    Kelola properti dan pantau aktivitas kos Anda dari sini.
                </div>
            </div>
            <div class="welcome-illustration">
                <div class="welcome-stat-mini">
                    <div class="welcome-stat-mini-value">{{ $kosList->count() }}</div>
                    <div class="welcome-stat-mini-label">Total Kos</div>
                </div>
                <div class="welcome-stat-mini">
                    <div class="welcome-stat-mini-value">{{ $kosList->where('status', 'aktif')->count() }}</div>
                    <div class="welcome-stat-mini-label">Kos Aktif</div>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="stats-grid">
            <!-- Total Kos -->
            <div class="stat-card green">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#2E7D32" stroke-width="2">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $kosList->count() }}</div>
                    <div class="stat-label">Total Kos Dimiliki</div>
                    <div class="stat-trend up">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                        {{ $kosList->where('status', 'aktif')->count() }} aktif
                    </div>
                </div>
            </div>

            <!-- Total Kamar Terisi -->
            <div class="stat-card blue">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#0277BD" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value">
                        @php
                            $totalKamar = $kosList->sum(fn($k) => $k->kamar ? $k->kamar->count() : 0);
                        @endphp
                        {{ $totalKamar }}
                    </div>
                    <div class="stat-label">Total Kamar</div>
                    <div class="stat-trend up">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                        Dari semua kos
                    </div>
                </div>
            </div>

            <!-- Pendapatan -->
            <div class="stat-card gold">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#F57C00" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value" style="font-size:20px;">
                        @php
                            $minHarga = $kosList->min('harga') ?? 0;
                        @endphp
                        Rp{{ number_format($minHarga/1000, 0, ',', '.') }}k
                    </div>
                    <div class="stat-label">Harga Mulai /bulan</div>
                    <div class="stat-trend up">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                        Termurah
                    </div>
                </div>
            </div>

            <!-- Rating -->
            <div class="stat-card purple">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#8E24AA" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value">
                        @php
                            $avgRating = $kosList->avg('rating') ?? 0;
                        @endphp
                        {{ number_format($avgRating, 1) }}
                    </div>
                    <div class="stat-label">Rating Rata-rata</div>
                    <div class="stat-trend up">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                        Dari semua ulasan
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">

            <!-- LEFT: Kos Table -->
            <div class="section-card">
                <div class="section-head">
                    <span class="section-head-title">🏠 Kos yang Anda Kelola</span>
                    <a href="{{ route('owner.kos.index') }}" class="section-head-action">Lihat Semua →</a>
                </div>

                @if($kosList->count() > 0)
                <table class="kos-table">
                    <thead>
                        <tr>
                            <th>Properti</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kosList->take(6) as $kos)
                        @php
                            $badgeType = $kos->is_eksklusif ? 'badge-exclusive' : 'badge-' . $kos->tipe;
                            $badgeLabel = $kos->is_eksklusif ? 'Eksklusif' : ucfirst($kos->tipe);
                        @endphp
                        <tr>
                            <td>
                                <div class="kos-row-info">
                                    <div class="kos-row-img">
                                        @if($kos->foto_utama)
                                            <img src="{{ asset('storage/' . $kos->foto_utama) }}" alt="{{ $kos->nama }}">
                                        @else
                                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="rgba(74,107,80,0.5)" stroke-width="1.5">
                                                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="kos-row-name">{{ $kos->nama }}</div>
                                        <div class="kos-row-loc">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                                <circle cx="12" cy="10" r="3"/>
                                            </svg>
                                            {{ Str::limit($kos->alamat, 28) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge {{ $badgeType }}">{{ $badgeLabel }}</span></td>
                            <td><strong>{{ $kos->harga_format }}</strong><small style="color:var(--text-light)">/bln</small></td>
                            <td>
                                @if(isset($kos->status) && $kos->status === 'nonaktif')
                                    <span class="badge badge-inactive">Nonaktif</span>
                                @else
                                    <span class="badge badge-active">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('kos.show', $kos->id) }}" class="btn-icon" title="Lihat">
                                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('owner.kos.edit', $kos->id) }}" class="btn-icon" title="Edit">
                                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('owner.kos.destroy', $kos->id) }}" onsubmit="return confirm('Hapus kos ini?')" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon danger" title="Hapus">
                                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <svg width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                    <p>Anda belum menambahkan kos. Mulai tambahkan kos pertama Anda!</p>
                    <a href="{{ route('kos.create') }}">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Tambah Kos Pertama
                    </a>
                </div>
                @endif
            </div>

            <!-- RIGHT: Quick Links + Activity -->
            <div style="display:flex; flex-direction:column; gap:24px;">

                <!-- Quick Links -->
                <div class="section-card">
                    <div class="section-head">
                        <span class="section-head-title">⚡ Akses Cepat</span>
                    </div>
                    <div class="quick-links">
                        <a href="{{ route('kos.create') }}" class="quick-link">
                            <div class="quick-link-icon">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </div>
                            Tambah Kos
                        </a>
                        <a href="{{ route('owner.kos.index') }}" class="quick-link">
                            <div class="quick-link-icon">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="2">
                                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                                </svg>
                            </div>
                            Kelola Kos
                        </a>
                        <a href="{{ route('notifikasi.index') }}" class="quick-link">
                            <div class="quick-link-icon">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                </svg>
                            </div>
                            Notifikasi
                        </a>
                        <a href="{{ route('profile.index') }}" class="quick-link">
                            <div class="quick-link-icon">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            Profil Saya
                        </a>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="section-card" style="flex:1;">
                    <div class="section-head">
                        <span class="section-head-title">🕐 Aktivitas Terbaru</span>
                    </div>
                    <div class="activity-list">
                        @forelse($kosList->take(4) as $kos)
                        <div class="activity-item">
                            <div class="activity-icon booking">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                                </svg>
                            </div>
                            <div class="activity-body">
                                <div class="activity-title">{{ $kos->nama }}</div>
                                <div class="activity-desc">
                                    Kos {{ ucfirst($kos->tipe ?? 'campur') }} · {{ $kos->harga_format }}/bulan
                                </div>
                            </div>
                            <div class="activity-time">
                                @if($kos->created_at)
                                    {{ $kos->created_at->diffForHumans() }}
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                        @empty
                        <div style="padding:32px 24px; text-align:center; color:var(--text-light); font-size:13px;">
                            Belum ada aktivitas
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }
</script>

</body>
</html>