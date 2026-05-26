<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <!-- Notifikasi -->
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </div>
        <!-- Chat -->
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <!-- Favorit -->
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </div>
    </div>
</nav>

<!-- ══════════════════ MAIN ══════════════════ -->
<main class="main">

    <div class="page-header">
        <div>
            <div class="page-title">Semua Kos Tersedia</div>
            <div class="page-count">Menampilkan 320 kos ditemukan</div>
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

        <!-- Card 1 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c9b0,#a89878)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c9d4c0,#8a9878)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c0c9d4,#7888a0)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c0c9,#a07888)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c9d0c4,#889078)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d0c4c9,#908088)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 7 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c4c9d0,#788090)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <!-- Card 8 -->
        <div class="kos-card">
            <div class="kos-img-wrap">
                <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d0c9c4,#908878)">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
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
                <a href="#" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

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

</body>
</html>