<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Daftar Kos - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage:        #6B8F71;
            --sage-dark:   #4A6B50;
            --sage-deeper: #3A5540;
            --sage-light:  #A8C5AC;
            --sage-bg:     #EDF3EE;
            --cream:       #F0F4F1;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
            --text-mid:    #4A5C4D;
            --text-light:  #8A9E8D;
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --card-shadow: 0 2px 16px rgba(74,107,80,0.10);
            --radius:      12px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main.main {
            flex: 1;
        }

        /* ─── FOOTER ─────────────────────────────────────── */
        footer {
            background: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            padding: 64px 32px 32px;
            font-family: 'DM Sans', sans-serif;
            margin-top: auto;
        }
        .footer-grid {
            max-width: 1100px;
            margin: 0 auto 40px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            align-items: start;
        }
        .footer-logo-wrap {
            display: flex;
            align-items: center;
        }
        .footer-logo-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .footer-logo-circle img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .footer-col-title {
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 20px;
            letter-spacing: -0.2px;
        }
        .footer-links {
            list-style: none;
        }
        .footer-links li {
            margin-bottom: 12px;
        }
        .footer-links a {
            font-size: 13px;
            color: #4b5563;
            text-decoration: none;
            transition: color .2s;
            font-weight: 400;
        }
        .footer-links a:hover {
            color: #3A5540;
        }
        .footer-social {
            display: flex;
            gap: 12px;
        }
        .social-btn {
            width: 32px;
            height: 32px;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #4b5563;
            transition: border-color .2s, color .2s, background-color .2s;
            background: #ffffff;
        }
        .social-btn:hover {
            border-color: #3A5540;
            color: #3A5540;
            background-color: #EDF3EE;
        }
        .social-btn svg {
            fill: currentColor;
            width: 14px;
            height: 14px;
        }
        .footer-bottom {
            max-width: 1100px;
            margin: 0 auto;
            border-top: 1px solid rgba(0,0,0,0.06);
            padding-top: 24px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            font-weight: 400;
            letter-spacing: 0.2px;
        }
        .footer-bottom a {
            color: inherit;
            text-decoration: none;
            margin: 0 4px;
        }
        .footer-bottom a:hover {
            color: #4b5563;
        }

        /* ─── NAVBAR ─────────────────────────────────────── */
        .navbar {
            background: var(--sage-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            height: 64px;
            border-bottom: 1px solid rgba(107,143,113,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-left { display: flex; align-items: center; gap: 20px; }
        .hamburger { cursor: pointer; display: flex; flex-direction: column; gap: 4px; }
        .hamburger span { display: block; width: 20px; height: 2px; background: var(--text-dark); border-radius: 2px; }

        .brand-wrap { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-logo {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 2px solid var(--sage-light);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            padding: 2px;
        }
        .brand-logo svg { width: 26px; height: 26px; }
        .brand-name {
            font-family: 'DM Sans', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .search-wrap {
            flex: 1;
            max-width: 480px;
            margin: 0 32px;
            display: flex;
            align-items: center;
            background: var(--white);
            border: 1.5px solid rgba(107,143,113,0.25);
            border-radius: 24px;
            overflow: hidden;
        }
        .search-wrap input {
            flex: 1;
            border: none;
            outline: none;
            padding: 10px 18px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            background: transparent;
        }
        .search-wrap input::placeholder { color: var(--text-light); }
        .btn-filter {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            padding: 10px 18px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
            white-space: nowrap;
        }
        .btn-filter:hover { background: var(--sage-dark); }

        .navbar-right { display: flex; align-items: center; gap: 20px; }
        .nav-icon {
            color: var(--text-mid);
            cursor: pointer;
            transition: color .2s;
            display: flex; align-items: center;
        }
        .nav-icon:hover { color: var(--sage-deeper); }

        /* ─── FAVORIT BUTTON ────────────────────────────── */
        .btn-favorit {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.92);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: transform 0.2s ease, background 0.2s ease;
        }
        .btn-favorit:hover { transform: scale(1.12); background: #fff; }
        .btn-favorit svg {
            transition: fill 0.2s ease, stroke 0.2s ease;
            fill: none;
            stroke: #9ca3af;
            stroke-width: 1.8;
        }
        .btn-favorit.active svg {
            fill: #ef4444;
            stroke: #ef4444;
        }
        .btn-favorit.pop {
            animation: heartPop 0.35s ease;
        }
        @keyframes heartPop {
            0%   { transform: scale(1); }
            40%  { transform: scale(1.4); }
            70%  { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        /* Toast favorit */
        .fav-toast {
            position: fixed;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%) translateY(12px);
            background: #1a1a1a;
            color: #fff;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s, transform 0.25s;
            z-index: 9999;
            white-space: nowrap;
        }
        .fav-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ─── NOTIFICATION PANEL ─────────────────────────── */
        .bell-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .bell-badge {
            position: absolute;
            top: -4px;
            right: -5px;
            width: 16px;
            height: 16px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #fff;
            font-size: 9px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }
        .notif-panel {
            position: absolute;
            top: calc(100% + 18px);
            right: -12px;
            width: 370px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 12px 48px rgba(0,0,0,0.15), 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid rgba(107,143,113,0.12);
            z-index: 999;
            opacity: 0;
            transform: translateY(-8px) scale(0.97);
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s ease;
            max-height: 520px;
            display: flex;
            flex-direction: column;
        }
        .notif-panel.open {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: all;
        }
        .notif-panel::before {
            content: '';
            position: absolute;
            top: -7px;
            right: 20px;
            width: 13px;
            height: 13px;
            background: #fff;
            border-left: 1px solid rgba(107,143,113,0.12);
            border-top: 1px solid rgba(107,143,113,0.12);
            transform: rotate(45deg);
            border-radius: 2px 0 0 0;
        }
        .notif-header {
            padding: 18px 20px 14px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .notif-header-title {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            font-family: 'DM Sans', sans-serif;
        }
        .notif-mark-all {
            font-size: 12px;
            color: #6b8f71;
            font-weight: 600;
            cursor: pointer;
            background: none;
            border: none;
            font-family: 'DM Sans', sans-serif;
            padding: 0;
        }
        .notif-mark-all:hover { color: #4a6b50; text-decoration: underline; }
        .notif-list {
            overflow-y: auto;
            flex: 1;
            scrollbar-width: thin;
            scrollbar-color: rgba(107,143,113,0.25) transparent;
        }
        .notif-list::-webkit-scrollbar { width: 4px; }
        .notif-list::-webkit-scrollbar-thumb { background: rgba(107,143,113,0.3); border-radius: 4px; }
        .notif-date-sep {
            text-align: center;
            font-size: 11px;
            font-weight: 600;
            color: #aaa;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'DM Sans', sans-serif;
        }
        .notif-date-sep::before, .notif-date-sep::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }
        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 13px 20px;
            transition: background 0.15s;
            cursor: pointer;
            border-bottom: 1px solid #fafafa;
        }
        .notif-item:hover { background: #f8faf8; }
        .notif-item:last-child { border-bottom: none; }
        .notif-dot {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2px;
        }
        .notif-dot.green  { background: #d1fae5; }
        .notif-dot.blue   { background: #dbeafe; }
        .notif-dot.red    { background: #fee2e2; }
        .notif-dot.yellow { background: #fef9c3; }
        .notif-dot-inner {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .notif-dot.green  .notif-dot-inner { background: #10b981; }
        .notif-dot.blue   .notif-dot-inner { background: #3b82f6; }
        .notif-dot.red    .notif-dot-inner { background: #ef4444; }
        .notif-dot.yellow .notif-dot-inner { background: #f59e0b; }
        .notif-content { flex: 1; min-width: 0; }
        .notif-title {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 3px;
            font-family: 'DM Sans', sans-serif;
            line-height: 1.3;
        }
        .notif-desc {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
            font-family: 'DM Sans', sans-serif;
            line-height: 1.4;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .notif-time {
            font-size: 11px;
            color: #aab4be;
            font-family: 'DM Sans', sans-serif;
        }

        /* ─── MAIN CONTENT ───────────────────────────────── */
        .main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 36px 24px 60px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .page-title { font-size: 20px; font-weight: 700; color: var(--text-dark); }
        .page-count { font-size: 13px; color: var(--text-light); margin-top: 2px; }

        .sort-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-mid);
        }
        .sort-wrap select {
            border: 1.5px solid rgba(107,143,113,0.3);
            border-radius: 8px;
            padding: 6px 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            background: var(--white);
            outline: none;
            cursor: pointer;
        }

        /* ─── KOS GRID ───────────────────────────────────── */
        .kos-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .kos-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
            border: 1px solid rgba(107,143,113,0.08);
        }
        .kos-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(74,107,80,0.18);
        }

        .kos-img-wrap { position: relative; overflow: hidden; }
        .kos-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
            transition: transform .3s;
        }
        .kos-card:hover .kos-img { transform: scale(1.04); }

        .kos-img-placeholder {
            width: 100%;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .3s;
        }
        .kos-card:hover .kos-img-placeholder { transform: scale(1.04); }

        .kos-badge {
            position: absolute;
            bottom: 10px;
            left: 12px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 3px 10px;
            border-radius: 6px;
        }
        .badge-exclusive { background: var(--gold); color: #fff; }
        .badge-putri     { background: #e91e8c; color: #fff; }
        .badge-putra     { background: #1976D2; color: #fff; }
        .badge-campur    { background: var(--sage-dark); color: #fff; }

        .kos-body { padding: 14px; }
        .kos-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
            line-height: 1.3;
        }
        .kos-loc {
            display: flex;
            align-items: flex-start;
            gap: 4px;
            font-size: 11px;
            color: var(--text-light);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .kos-loc svg { flex-shrink: 0; margin-top: 1px; }
        .kos-price {
            font-size: 13px;
            font-weight: 700;
            color: var(--sage-deeper);
            margin-bottom: 10px;
        }
        .kos-price span { font-size: 11px; font-weight: 400; color: var(--text-light); }

        .kos-tags { display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 12px; }
        .kos-tag {
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 6px;
            background: var(--sage-bg);
            color: var(--sage-dark);
            font-weight: 500;
            border: 1px solid rgba(107,143,113,0.2);
        }

        .btn-detail {
            width: 100%;
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            text-align: center;
            text-decoration: none;
            display: block;
        }
        .btn-detail:hover { background: var(--sage-dark); }

        /* ─── PAGINATION ─────────────────────────────────── */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }
        .page-btn {
            width: 36px; height: 36px;
            border-radius: 8px;
            border: 1.5px solid rgba(107,143,113,0.25);
            background: var(--white);
            color: var(--text-mid);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all .2s;
            text-decoration: none;
        }
        .page-btn:hover { border-color: var(--sage-dark); color: var(--sage-dark); }
        .page-btn.active {
            background: var(--sage-deeper);
            border-color: var(--sage-deeper);
            color: #fff;
        }
        .page-btn.arrow { font-size: 16px; }
        .page-ellipsis {
            color: var(--text-light);
            font-size: 13px;
            padding: 0 4px;
        }

        /* ─── RESPONSIVE ─────────────────────────────────── */
        @media (max-width: 1000px) {
            .kos-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 720px) {
            .kos-grid { grid-template-columns: repeat(2, 1fr); }
            .navbar { padding: 0 16px; }
            .search-wrap { display: none; }
            .main { padding: 24px 16px 48px; }
        }
        @media (max-width: 480px) {
            .kos-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('partials.sidebar')

<!-- ══════════════════ NAVBAR ══════════════════ -->
<nav class="navbar">
    <div class="navbar-left">
        <div class="hamburger" onclick="openSidebar()">
            <span></span><span></span><span></span>
        </div>
        <a href="/" class="brand-wrap">
            <div class="brand-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Rumantra" width="36" height="36" style="object-fit:contain;">
            </div>
            <span class="brand-name">Rumantra</span>
        </a>
    </div>

    <form action="{{ route('kos.search') }}" method="GET" style="display:contents">
        <div class="search-wrap">
            <input type="text" name="q" placeholder="cari berdasarkan lokasi, lingkungan">
            <button type="submit" class="btn-filter">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Filter
            </button>
        </div>
    </form>

    <div class="navbar-right">
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </div>
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <a href="{{ route('favorit.index') }}" class="nav-icon" title="Favorit Saya" style="text-decoration:none;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </a>
    </div>
</nav>

<!-- ══════════════════ MAIN ══════════════════ -->
<main class="main">

    <div class="page-header">
        <div>
            @php
                $judulKategori = match($kategori ?? null) {
                    'exclusive' => 'Kos Exclusive',
                    'putri'     => 'Kos Putri',
                    'putra'     => 'Kos Putra',
                    'campur'    => 'Kos Campur',
                    default     => 'Semua Kos Tersedia',
                };
            @endphp
            <div class="page-title">
                {{ $judulKategori }}
                @if(!empty($kategori))
                    <span style="display:inline-block;margin-left:8px;padding:2px 12px;background:var(--sage);color:#fff;border-radius:999px;font-size:12px;font-weight:600;vertical-align:middle;text-transform:capitalize;">
                        {{ $kategori }}
                    </span>
                @endif
            </div>
            <div class="page-count">
                @if(isset($kosList))
                    Menampilkan {{ $kosList->total() }} kos ditemukan
                @else
                    Menampilkan semua kos tersedia
                @endif
            </div>
        </div>
        <div class="sort-wrap">
            Urutkan:
            <select>
                <option>Terbaru</option>
                <option>Harga Terendah</option>
                <option>Harga Tertinggi</option>
                <option>Rating Tertinggi</option>
            </select>
        </div>
    </div>

    <!-- KOS GRID -->
    <div class="kos-grid">

        @if(isset($kosList) && $kosList->count() > 0)
            @foreach($kosList as $kos)
            <div class="kos-card">
                <div class="kos-img-wrap">
                    @if($kos->foto_utama)
                        <img src="{{ asset('storage/' . $kos->foto_utama) }}" alt="{{ $kos->nama }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c9b0,#a89878)">
                            <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                        </div>
                    @endif
                    @if($kos->is_eksklusif)
                        <span class="kos-badge badge-exclusive">Eksklusif</span>
                    @endif
                    <button class="btn-favorit {{ auth()->check() && auth()->user()->isFavorit($kos->id) ? 'active' : '' }}"
                            data-kos-id="{{ $kos->id }}" onclick="toggleFavorit(this)" title="Tambah ke favorit">
                        <svg width="16" height="16" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </button>
                </div>
                <div class="kos-body">
                    <div class="kos-name">{{ $kos->nama }}</div>
                    <div class="kos-loc">
                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $kos->alamat }}
                    </div>
                    <div class="kos-price">{{ $kos->harga_format }} <span>/bulan</span></div>
                    <div class="kos-tags">
                        <span class="kos-tag" style="text-transform:capitalize;">{{ $kos->tipe }}</span>
                        @if($kos->fasilitas)
                            @foreach(array_slice($kos->fasilitas, 0, 2) as $fas)
                                <span class="kos-tag">{{ $fas }}</span>
                            @endforeach
                        @endif
                    </div>
                    <a href="{{ route('kos.show', $kos->id) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
            @endforeach

        @elseif(isset($kosList) && $kosList->count() === 0)
            <div style="grid-column:1/-1;text-align:center;padding:64px 0;color:var(--text-light);">
                <svg width="56" height="56" fill="none" viewBox="0 0 48 48" stroke="currentColor" stroke-width="1.2" style="opacity:.4;margin-bottom:16px;display:block;margin-inline:auto;">
                    <path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/>
                </svg>
                <p style="font-size:18px;font-weight:600;margin-bottom:8px;">Belum ada kos kategori ini</p>
                <p style="font-size:14px;">Coba kategori lain atau <a href="{{ route('kos.listing') }}" style="color:var(--sage);font-weight:600;">lihat semua kos</a>.</p>
            </div>

        @else
            {{-- Fallback: data statis jika diakses lewat route lama (kos.index) --}}
            @for($i = 1; $i <= 8; $i++)
            <div class="kos-card">
                <div class="kos-img-wrap">
                    <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c9b0,#a89878)">
                        <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                    </div>
                    <span class="kos-badge badge-exclusive">Eksklusif</span>
                    <button class="btn-favorit {{ auth()->check() && auth()->user()->isFavorit($i) ? 'active' : '' }}" data-kos-id="{{ $i }}" onclick="toggleFavorit(this)" title="Tambah ke favorit">
                        <svg width="16" height="16" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </button>
                </div>
                <div class="kos-body">
                    <div class="kos-name">Kos Putri Melati</div>
                    <div class="kos-loc">
                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Jl. Jatiwaras, Purwokerto Selatan
                    </div>
                    <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                    <div class="kos-tags">
                        <span class="kos-tag">Rp 1.6jt</span>
                        <span class="kos-tag">AC</span>
                        <span class="kos-tag">WiFi</span>
                    </div>
                    <a href="{{ route('kos.show', $i) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
            @endfor
        @endif

    </div>


    <!-- PAGINATION -->
    <div class="pagination">
        <a href="#" class="page-btn arrow">&#8249;</a>
        <a href="#" class="page-btn active">1</a>
        <a href="#" class="page-btn">2</a>
        <a href="#" class="page-btn">3</a>
        <a href="#" class="page-btn">4</a>
        <span class="page-ellipsis">...</span>
        <a href="#" class="page-btn">40</a>
        <a href="#" class="page-btn arrow">&#8250;</a>
    </div>

</main>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer>
    <div class="footer-grid">
        <div class="footer-logo-wrap">
            <div class="footer-logo-circle">
                <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
            </div>
        </div>
        <div>
            <div class="footer-col-title">Resource</div>
            <ul class="footer-links">
                <li><a href="#">Help center</a></li>
                <li><a href="#">Security</a></li>
                <li><a href="#">Privacy policy</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Company</div>
            <ul class="footer-links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Social</div>
            <div class="footer-social">
                <div class="social-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </div>
                <div class="social-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                    </svg>
                </div>
                <div class="social-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2026 Rumantra &nbsp;•&nbsp; Teman Mahasiswa Cari Kos &nbsp;•&nbsp; <a href="#">Kebijakan Privasi</a> &nbsp;•&nbsp; <a href="#">Syarat & Ketentuan</a>
    </div>
</footer>

<!-- Favorit toast element -->
<div class="fav-toast" id="favToast"></div>

<script>
    // ── NOTIFICATION PANEL ──────────────────────────────
    function toggleNotif(e) {
        e.stopPropagation();
        document.getElementById('notifPanel').classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('bellWrapper');
        const panel   = document.getElementById('notifPanel');
        if (wrapper && !wrapper.contains(e.target)) panel.classList.remove('open');
    });
    function markAllRead() {
        const badge = document.getElementById('bellBadge');
        if (badge) badge.style.display = 'none';
    }

    // ── FAVORIT TOGGLE ──────────────────────────────────
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const csrfToken  = '{{ csrf_token() }}';
    const loginUrl   = '{{ route("login") }}';

    function toggleFavorit(btn) {
        // Kalau belum login, arahkan ke login
        if (!isLoggedIn) {
            showFavToast('Silakan login untuk menyimpan favorit ❤️');
            setTimeout(() => { window.location.href = loginUrl; }, 1200);
            return;
        }

        const kosId = btn.dataset.kosId;

        fetch(`/favorit/${kosId}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.favorited) {
                btn.classList.add('active', 'pop');
                showFavToast('❤️ Ditambahkan ke favorit');
            } else {
                btn.classList.remove('active');
                btn.classList.add('pop');
                showFavToast('Dihapus dari favorit');
            }
            // Hapus class pop setelah animasi selesai
            btn.addEventListener('animationend', () => btn.classList.remove('pop'), { once: true });
        })
        .catch(() => showFavToast('Terjadi kesalahan, coba lagi.'));
    }

    function showFavToast(msg) {
        const toast = document.getElementById('favToast');
        toast.textContent = msg;
        toast.classList.add('show');
        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => toast.classList.remove('show'), 2500);
    }
</script>

</body>
</html>