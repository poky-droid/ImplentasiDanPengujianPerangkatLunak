<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Hasil Pencarian - Rumantra</title>
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
            background: var(--sage-deeper);
            padding: 48px 64px 28px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer-brand-wrap { display: flex; align-items: center; gap: 10px; text-decoration: none; margin-bottom: 12px; }
        .footer-brand-logo {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.3);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: 2px;
        }
        .footer-brand-logo img { width: 38px; height: 38px; object-fit: contain; }
        .footer-brand-name { font-size: 17px; font-weight: 700; color: #fff; letter-spacing: 1.5px; }
        .footer-desc { font-size: 12px; color: rgba(255,255,255,0.5); line-height: 1.7; }
        .footer-col-title { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { font-size: 13px; color: rgba(255,255,255,0.5); text-decoration: none; transition: color .2s; }
        .footer-links a:hover { color: var(--gold-light); }
        .footer-social { display: flex; gap: 12px; }
        .social-btn {
            width: 36px; height: 36px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .social-btn:hover { border-color: var(--gold-light); background: rgba(201,168,76,0.1); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            text-align: center;
            font-size: 11px;
            color: rgba(255,255,255,0.3);
        }
        .footer-bottom a { color: rgba(255,255,255,0.4); text-decoration: none; }
        .footer-bottom a:hover { color: rgba(255,255,255,0.6); }

        /* ─── RESPONSIVE ─────────────────────────────────── */
        @media (max-width: 1100px) { .kos-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 800px) {
            .hero { padding: 48px 24px; }
            .section, .testi-section { padding: 36px 24px; }
            .explore { padding: 28px 24px; }
            .kos-grid { grid-template-columns: repeat(2, 1fr); }
            .testi-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            footer { padding: 36px 24px 20px; }
            .navbar { padding: 0 16px; }
            .search-form { display: none; }
        }
        @media (max-width: 500px) {
            .kos-grid { grid-template-columns: 1fr; }
            .explore-grid { gap: 24px; }
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
        .brand-name {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .search-form { flex: 1; max-width: 480px; margin: 0 32px; display: flex; }
        .search-wrap {
            flex: 1;
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
        .nav-icon { color: var(--text-mid); cursor: pointer; transition: color .2s; display: flex; align-items: center; }
        .nav-icon:hover { color: var(--sage-deeper); }

        /* ─── MAIN ───────────────────────────────────────── */
        .main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 60px;
        }

        /* ─── FILTER TABS ────────────────────────────────── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }
        .filter-tab {
            padding: 8px 22px;
            border-radius: 20px;
            border: 1.5px solid rgba(107,143,113,0.25);
            background: var(--white);
            color: var(--text-mid);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
        }
        .filter-tab:hover { border-color: var(--sage-dark); color: var(--sage-dark); }
        .filter-tab.active { background: var(--sage-deeper); border-color: var(--sage-deeper); color: #fff; }

        .btn-filter-adv {
            margin-left: auto;
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1.5px solid rgba(107,143,113,0.25);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all .2s;
            flex-shrink: 0;
        }
        .btn-filter-adv:hover { border-color: var(--sage-dark); background: var(--sage-bg); }

        /* ─── SEARCH INFO ────────────────────────────────── */
        .search-info {
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--text-light);
        }
        .search-info strong { color: var(--text-dark); font-weight: 600; }

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
            height: 170px;
            object-fit: cover;
            display: block;
            transition: transform .3s;
        }
        .kos-card:hover .kos-img { transform: scale(1.04); }

        .kos-img-placeholder {
            width: 100%;
            height: 170px;
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

        /* ─── EMPTY STATE ────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            display: none;
        }
        .empty-state svg { margin-bottom: 20px; opacity: 0.3; }
        .empty-state h3 { font-size: 18px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px; }
        .empty-state p { font-size: 13px; color: var(--text-light); }

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
        .page-btn.active { background: var(--sage-deeper); border-color: var(--sage-deeper); color: #fff; }
        .page-btn.arrow { font-size: 16px; }
        .page-ellipsis { color: var(--text-light); font-size: 13px; padding: 0 4px; }

        /* ─── RESPONSIVE ─────────────────────────────────── */
        @media (max-width: 1000px) { .kos-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 720px) {
            .kos-grid { grid-template-columns: repeat(2, 1fr); }
            .navbar { padding: 0 16px; }
            .search-form { max-width: 260px; margin: 0 16px; }
            .main { padding: 24px 16px 48px; }
        }
        @media (max-width: 480px) { .kos-grid { grid-template-columns: 1fr; } }
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

    <form action="{{ route('kos.search') }}" method="GET" class="search-form">
        <div class="search-wrap">
            <input
                type="text"
                name="q"
                placeholder="cari berdasarkan lokasi, lingkungan"
                value="{{ request('q') }}"
                autofocus
            >
            <button type="submit" class="btn-filter">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Filter
            </button>
        </div>
    </form>

    <div class="navbar-right">
        <div class="nav-icon" onclick="openNotificationModal()" title="Notifikasi" style="cursor: pointer;">
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

    <!-- FILTER TABS -->
    <div class="filter-bar">
        <button class="filter-tab active" onclick="setTab(this)">All</button>
        <button class="filter-tab" onclick="setTab(this)">Populer</button>
        <button class="filter-tab" onclick="setTab(this)">Sekitar saya</button>
        <button class="filter-tab" onclick="setTab(this)">Tersedia</button>
        <button class="filter-tab" onclick="setTab(this)">Termurah</button>
        <button class="filter-tab" onclick="setTab(this)">Eksklusif</button>
        <div class="btn-filter-adv">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="4" y1="6" x2="20" y2="6"/>
                <line x1="4" y1="12" x2="14" y2="12"/>
                <line x1="4" y1="18" x2="10" y2="18"/>
            </svg>
        </div>
    </div>

    <!-- SEARCH INFO -->
    @if(request('q'))
    <div class="search-info">
        Menampilkan hasil untuk <strong>"{{ request('q') }}"</strong>
        {{-- Uncomment setelah ada data: · <strong>{{ $kos->total() }}</strong> kos ditemukan --}}
    </div>
    @endif

    <!-- KOS GRID -->
    {{-- Jika sudah ada data dari DB, ganti dengan @foreach($kos as $item) --}}
    <div class="kos-grid">

        <!-- Card 1 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c9b0,#a89878)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 1) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c9d4c0,#8a9878)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 2) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c0c9d4,#7888a0)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 3) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c0c9,#a07888)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 4) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c9d0c4,#889078)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 5) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d0c4c9,#908088)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 6) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 7 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c4c9d0,#788090)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 7) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 8 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d0c9c4,#908878)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                </div>
                <span class="kos-badge badge-exclusive">Eksklusif</span>
            </div>
            <div class="kos-body">
                <div class="kos-name">Kos Putri Melati</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Jl. Jatiwaras, Purwokerto Selatan, Purwokerto Selatan
                </div>
                <div class="kos-price">Rp 1.600.000 <span>/bulan</span></div>
                <div class="kos-tags">
                    <span class="kos-tag">Rp 1.6jt</span>
                    <span class="kos-tag">AC</span>
                    <span class="kos-tag">WiFi</span>
                </div>
                <a href="{{ route('kos.show', 8) }}" class="btn btn-detail">Lihat Detail</a>
            </div>
        </div>

    </div>
    {{-- Akhir @foreach --}}

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
        <div>
            <a href="/" class="footer-brand-wrap">
                <div class="footer-brand-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
                </div>
                <span class="footer-brand-name">RUMANTRA</span>
            </a>
            <p class="footer-desc">Platform terpercaya untuk menemukan kos impian mahasiswa di seluruh Indonesia. Aman, nyaman, dan terjangkau.</p>
        </div>
        <div>
            <div class="footer-col-title">Resource</div>
            <ul class="footer-links">
                <li><a href="#">Blog</a></li>
                <li><a href="#">Panduan</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Promo</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Company</div>
            <ul class="footer-links">
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Karier</a></li>
                <li><a href="#">Mitra</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Social</div>
            <div class="footer-social">
                <div class="social-btn">
                    <svg width="16" height="16" fill="rgba(255,255,255,0.6)" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </div>
                <div class="social-btn">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.6)" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </div>
                <div class="social-btn">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.6)" stroke-width="1.8"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2025 Rumantra &nbsp;·&nbsp;
        <a href="#">Syarat & Ketentuan</a> &nbsp;·&nbsp;
        <a href="#">Kebijakan Privasi</a> &nbsp;·&nbsp;
        <a href="#">Syarat & Kebijakan</a>
    </div>
</footer>

<!-- Modal Notifikasi Bell -->
<div id="notification-modal" style="
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 16px;
    font-family: 'DM Sans', sans-serif;
">
    <div style="
        background: #fff;
        border-radius: 16px;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 10px 30px rgba(74, 107, 80, 0.2);
        animation: scaleUp 0.3s ease;
        overflow: hidden;
        border: 1px solid #D8E4DA;
    ">
        <!-- Header -->
        <div style="
            background: #3A5540;
            color: #fff;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        ">
            <h3 style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px;">
                🔔 Informasi & Notifikasi
            </h3>
            <button onclick="closeNotificationModal()" style="
                background: none;
                border: none;
                color: rgba(255, 255, 255, 0.8);
                font-size: 20px;
                cursor: pointer;
                line-height: 1;
                transition: color 0.2s;
            " onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'">&times;</button>
        </div>
        
        <!-- Body -->
        <div style="padding: 24px; display: flex; flex-direction: column; gap: 16px; max-height: 400px; overflow-y: auto; text-align: left;">
            <!-- Notif 1: Maintenance -->
            <div style="
                background: #FFF9E8;
                border-left: 4px solid #C9A84C;
                border-radius: 8px;
                padding: 14px 16px;
                display: flex;
                flex-direction: column;
                gap: 4px;
            ">
                <div style="font-weight: 700; font-size: 13.5px; color: #856404; display: flex; align-items: center; gap: 6px;">
                    🛠️ Pemeliharaan Sistem (Maintenance)
                </div>
                <div style="font-size: 12.5px; color: #664d03; line-height: 1.5;">
                    Kami akan melakukan pemeliharaan sistem pada hari Minggu pukul 01:00 - 04:00 WIB. Layanan booking mungkin tidak dapat diakses sementara waktu.
                </div>
            </div>

            <!-- Notif 2: Edit Profile -->
            <div style="
                background: #EDF3EE;
                border-left: 4px solid #3A5540;
                border-radius: 8px;
                padding: 14px 16px;
                display: flex;
                flex-direction: column;
                gap: 4px;
            ">
                <div style="font-weight: 700; font-size: 13.5px; color: #1E2D22; display: flex; align-items: center; gap: 6px;">
                    👤 Lengkapi Profil Akun Anda
                </div>
                <div style="font-size: 12.5px; color: #4A5C4D; line-height: 1.5;">
                    Jangan lupa untuk melengkapi foto profil, nomor telepon, dan data diri Anda di menu <a href="/profile" style="color: #3A5540; font-weight: 700; text-decoration: underline;">Edit Profil</a> untuk kemudahan verifikasi sewa kos.
                </div>
            </div>

            <!-- Notif 3: Sponsor -->
            <div style="
                background: #f0f4ff;
                border-left: 4px solid #4a90e2;
                border-radius: 8px;
                padding: 14px 16px;
                display: flex;
                flex-direction: column;
                gap: 4px;
            ">
                <div style="font-weight: 700; font-size: 13.5px; color: #003087; display: flex; align-items: center; gap: 6px;">
                    🎁 Sponsor Mitra Rumantra
                </div>
                <div style="font-size: 12.5px; color: #004085; line-height: 1.5;">
                    Dapatkan potongan harga sewa kos khusus mahasiswa dengan menggunakan kode promo <strong>MHSBARU</strong> saat checkout transaksi pertama Anda!
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="
            background: #FAFBFA;
            padding: 16px 24px;
            border-top: 1px solid #EDF3EE;
            text-align: right;
        ">
            <button onclick="closeNotificationModal()" style="
                background: #3A5540;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 10px 20px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s;
            " onmouseover="this.style.background='#4A6B50'" onmouseout="this.style.background='#3A5540'">Tutup</button>
        </div>
    </div>
</div>

<script>
    function openNotificationModal() {
        const modal = document.getElementById('notification-modal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }
    function closeNotificationModal() {
        const modal = document.getElementById('notification-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    // Close modal when clicking outside content area
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('notification-modal');
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

<script>
    function setTab(el) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }
</script>

</body>
</html>