<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Rumantra - Temukan Kos Impianmu</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage:        #6B8F71;
            --sage-dark:   #4A6B50;
            --sage-deeper: #3A5540;
            --sage-light:  #A8C5AC;
            --sage-bg:     #EDF3EE;
            --cream:       #F7F4EF;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
            --text-mid:    #4A5C4D;
            --text-light:  #8A9E8D;
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --card-shadow: 0 4px 20px rgba(74,107,80,0.12);
            --radius:      12px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
        }

        /* ─── NAVBAR ─────────────────────────────────────── */
        .navbar {
            background: var(--sage-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(107,143,113,0.15);
        }
        .navbar-left { display: flex; align-items: center; gap: 16px; }
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
        .brand-logo img { width: 38px; height: 38px; object-fit: contain; }
        .brand-name {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .search-form { flex: 1; max-width: 420px; margin: 0 32px; }
        .search-bar {
            display: flex;
            align-items: center;
            background: var(--white);
            border: 1.5px solid rgba(107,143,113,0.25);
            border-radius: 24px;
            overflow: hidden;
        }
        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            padding: 10px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            background: transparent;
        }
        .search-bar input::placeholder { color: var(--text-light); }
        .search-bar .btn-filter {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            padding: 10px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
            white-space: nowrap;
        }
        .search-bar .btn-filter:hover { background: var(--sage-dark); }

        .navbar-right { display: flex; align-items: center; gap: 20px; }
        .nav-icon { color: var(--text-mid); cursor: pointer; transition: color .2s; }
        .nav-icon:hover { color: var(--sage-deeper); }
        .btn-masuk {
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 7px 20px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .1s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-masuk:hover { background: var(--sage-dark); transform: translateY(-1px); }

        /* ─── HERO ──────────────────────────────────────── */
        .hero {
            position: relative;
            min-height: 420px;
            background:
                linear-gradient(135deg, rgba(58,85,64,0.88) 0%, rgba(74,107,80,0.70) 60%, rgba(107,143,113,0.50) 100%),
                url('https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1400&q=80') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 64px;
            overflow: hidden;
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 80% 50%, rgba(201,168,76,0.08) 0%, transparent 60%);
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 11px;
            color: var(--gold-light);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
            width: fit-content;
        }
        .hero h1 {
            font-family: 'DM Sans', sans-serif;
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            max-width: 420px;
            margin-bottom: 16px;
        }
        .hero h1 em { color: var(--gold-light); font-style: normal; }
        .hero p {
            color: rgba(255,255,255,0.75);
            font-size: 14px;
            line-height: 1.7;
            max-width: 360px;
            margin-bottom: 32px;
        }
        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-hero-primary {
            background: var(--gold);
            color: var(--text-dark);
            border: none;
            border-radius: 24px;
            padding: 12px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .15s;
        }
        .btn-hero-primary:hover { background: var(--gold-light); transform: translateY(-2px); }
        .btn-hero-secondary {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.4);
            border-radius: 24px;
            padding: 12px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .btn-hero-secondary:hover { border-color: #fff; background: rgba(255,255,255,0.08); }

        /* ─── EXPLORE STRIP ─────────────────────────────── */
        .explore {
            background: var(--sage-deeper);
            padding: 36px 64px;
        }
        .explore-title {
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 18px;
            color: rgba(255,255,255,0.85);
            margin-bottom: 28px;
            letter-spacing: 0.5px;
        }
        .explore-grid {
            display: flex;
            justify-content: center;
            gap: 48px;
            flex-wrap: wrap;
        }
        .explore-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: transform .2s;
        }
        .explore-item:hover { transform: translateY(-4px); }
        .explore-icon {
            width: 80px;
            height: 80px;
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.06);
            transition: border-color .2s, background .2s;
        }
        .explore-item:hover .explore-icon {
            border-color: var(--gold-light);
            background: rgba(201,168,76,0.1);
        }
        .explore-icon svg { opacity: 0.85; }
        .explore-label {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .explore-item:hover .explore-label { color: var(--gold-light); }

        /* ─── KOS SECTION ───────────────────────────────── */
        .section {
            padding: 48px 64px;
            background: var(--cream);
        }
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .section-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 22px;
            color: var(--text-dark);
            font-weight: 600;
        }
        .btn-lihat {
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 22px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-lihat:hover { background: var(--sage-dark); }

        .kos-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        /* ─── KOS CARD ──────────────────────────────────── */
        .kos-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
        }
        .kos-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(74,107,80,0.2);
        }
        .kos-img-placeholder {
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kos-body { padding: 14px; }
        .kos-type-badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 10px;
            margin-bottom: 8px;
        }
        .badge-putri    { background: #FFE8EF; color: #C0516A; }
        .badge-putra    { background: #E8F0FF; color: #4A6BC0; }
        .badge-campur   { background: #E8F5E9; color: #2E7D32; }
        .badge-exclusive{ background: #FFF8E1; color: #B8860B; }

        .kos-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
            line-height: 1.3;
        }
        .kos-loc {
            font-size: 11px;
            color: var(--text-light);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 3px;
        }
        .kos-price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f0f0f0;
            padding-top: 10px;
        }
        .kos-price { font-size: 13px; font-weight: 700; color: var(--sage-dark); }
        .kos-price span { font-size: 10px; font-weight: 400; color: var(--text-light); }
        .kos-rating {
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            color: var(--gold);
            font-weight: 600;
        }

        /* ─── TESTIMONI ─────────────────────────────────── */
        .testi-section {
            background: var(--sage-bg);
            padding: 52px 64px;
        }
        .testi-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 36px;
        }
        .testi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            max-width: 860px;
            margin: 0 auto;
        }
        .testi-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--card-shadow);
        }
        .testi-stars { color: var(--gold); font-size: 13px; margin-bottom: 12px; letter-spacing: 2px; }
        .testi-text { font-size: 13px; line-height: 1.7; color: var(--text-mid); margin-bottom: 20px; }
        .testi-author { display: flex; align-items: center; gap: 12px; }
        .testi-avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--sage-light), var(--sage-dark));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 15px; color: #fff; flex-shrink: 0;
        }
        .testi-name { font-weight: 600; font-size: 13px; color: var(--text-dark); }
        .testi-univ { font-size: 11px; color: var(--text-light); }

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
                <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
            </div>
            <span class="brand-name">Rumantra</span>
        </a>
    </div>

    <form action="{{ route('kos.search') }}" method="GET" class="search-form">
        <div class="search-bar">
            <input type="text" name="q" placeholder="Cari kos di daerahmu...">
            <button type="submit" class="btn-filter">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Filter
            </button>
        </div>
    </form>

    <div class="navbar-right">
        <svg class="nav-icon" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <svg class="nav-icon" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
        <a href="{{ route('favorit.index') }}" class="nav-icon" title="Favorit Saya" style="text-decoration:none;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </a>
        @guest
            <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
        @endguest
    </div>
</nav>

<!-- ══════════════════ HERO ══════════════════ -->
<section class="hero">
    <div class="hero-badge">
        <svg width="8" height="8" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4" fill="#C9A84C"/></svg>
        #1 Platform Kos Mahasiswa
    </div>
    <h1>TEMUKAN KOS <em>IMPIANMU</em> UNTUK MAHASISWA</h1>
    <p>Kami membantu kamu menemukan kos yang nyaman, aman, dan sesuai budget di sekitar kampusmu. Lebih dari 500 pilihan tersedia!</p>
    <div class="hero-actions">
        <a href="{{ route('kos.search') }}" class="btn-hero-primary">Cari Kos Sekarang</a>
        <a href="{{ route('kos.index') }}" class="btn-hero-secondary">Lihat Semua</a>
    </div>
</section>

<!-- ══════════════════ EXPLORE STRIP ══════════════════ -->
<div class="explore">
    <p class="explore-title">Explore Rumantra</p>
    <div class="explore-grid">
        <a href="{{ route('kos.listing', ['kategori' => 'exclusive']) }}" class="explore-item" style="text-decoration:none;">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <rect x="8" y="14" width="32" height="24" rx="3"/>
                    <path d="M16 14v-3a8 8 0 0 1 16 0v3"/>
                    <path d="M24 26v3"/>
                    <circle cx="24" cy="24" r="3"/>
                </svg>
            </div>
            <span class="explore-label">Exclusive</span>
        </a>
        <a href="{{ route('kos.listing', ['kategori' => 'campur']) }}" class="explore-item" style="text-decoration:none;">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <path d="M10 38V18l14-8 14 8v20"/>
                    <rect x="18" y="26" width="12" height="12"/>
                    <path d="M18 26v12M30 26v12"/>
                </svg>
            </div>
            <span class="explore-label">Campur</span>
        </a>
        <a href="{{ route('kos.listing', ['kategori' => 'putri']) }}" class="explore-item" style="text-decoration:none;">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <path d="M10 38V18l14-8 14 8v20"/>
                    <path d="M20 38v-8h8v8"/>
                    <path d="M16 22h4v6h-4zM28 22h4v6h-4z"/>
                </svg>
            </div>
            <span class="explore-label">Putri</span>
        </a>
        <a href="{{ route('kos.listing', ['kategori' => 'putra']) }}" class="explore-item" style="text-decoration:none;">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <path d="M8 38V20l16-10 16 10v18"/>
                    <rect x="16" y="24" width="16" height="14" rx="1"/>
                    <path d="M22 38v-6h4v6"/>
                </svg>
            </div>
            <span class="explore-label">Putra</span>
        </a>

    </div>
</div>

<!-- ══════════════════ KOS SECTION ══════════════════ -->
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Temukan Kos di Sekitarmu</h2>
        <a href="{{ route('kos.index') }}" class="btn-lihat">Lihat Lainnya</a>
    </div>

    <div class="kos-grid">
    @forelse ($kosList as $kos)
        <a href="{{ route('kos.show', $kos->id) }}" class="kos-card" style="display:block; text-decoration:none; color:inherit;">
            <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c9d9ca,#9ab09c)">
                @if($kos->foto_utama)
                    <img src="{{ asset('storage/' . $kos->foto_utama) }}" alt="{{ $kos->nama }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <svg width="40" height="40" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                @endif
            </div>
            <div class="kos-body">
                @php
                    $badgeClass = $kos->is_eksklusif ? 'badge-exclusive' : 'badge-' . $kos->tipe;
                    $badgeLabel = $kos->is_eksklusif ? 'Exclusive' : ucfirst($kos->tipe);
                @endphp
                <span class="kos-type-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                <div class="kos-name">{{ $kos->nama }}</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $kos->alamat }}
                </div>
                <div class="kos-price-row">
                    <div class="kos-price">{{ $kos->harga_format }} <span>/bulan</span></div>
                    <div class="kos-rating">★ {{ number_format($kos->rating ?? 0, 1) }}</div>
                </div>
            </div>
        </a>
    @empty
        <p style="color: var(--text-light); font-size: 13px;">Belum ada kos yang tersedia saat ini.</p>
    @endforelse
</div>
</section>

<!-- ══════════════════ TESTIMONI ══════════════════ -->
<section class="testi-section">
    <h2 class="testi-title">Cerita dari Teman-teman Mahasiswa</h2>
    <div class="testi-grid">
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">Rumantra sangat membantu saya menemukan kos yang nyaman dan dekat kampus. Prosesnya mudah, cepat, dan pemilik kos sangat ramah. Highly recommended buat mahasiswa baru!</p>
            <div class="testi-author">
                <div class="testi-avatar">LA</div>
                <div>
                    <div class="testi-name">Lestari Anindita</div>
                    <div class="testi-univ">Universitas Brawijaya, Malang</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">Awalnya bingung cari kos dari luar kota, tapi Rumantra bantu banget! Foto-foto kos detail dan akurat, jadi pas datang langsung cocok. Terima kasih Rumantra!</p>
            <div class="testi-author">
                <div class="testi-avatar" style="background: linear-gradient(135deg,#9ab0d0,#4a6ba0)">IB</div>
                <div>
                    <div class="testi-name">Irwan Baki</div>
                    <div class="testi-univ">Universitas Negeri Malang</div>
                </div>
            </div>
        </div>
    </div>
</section>

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
</body>
</html>