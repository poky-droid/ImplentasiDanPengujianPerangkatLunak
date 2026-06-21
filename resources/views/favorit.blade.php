<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Saya — Rumantra</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage-deeper: #4a6b50;
            --sage-dark:   #3d5c43;
            --sage-bg:     #f0f4f1;
            --white:       #ffffff;
            --text-dark:   #1a1a1a;
            --text-mid:    #4b5563;
            --text-light:  #9ca3af;
            --gold:        #c9a84c;
            --radius:      14px;
            --card-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }

        html, body { height: 100%; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f6f7f4;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            color: var(--sage-deeper);
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
            border-color: var(--sage-deeper);
            color: var(--sage-deeper);
            background-color: var(--sage-bg);
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

        /* ─── PAGE HEADER ────────────────────────────────── */
        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px 80px;
        }

        .page-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
            gap: 16px;
            flex-wrap: wrap;
        }
        .page-hero-left h1 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-hero-left h1 svg { flex-shrink: 0; }
        .page-hero-left p {
            font-size: 14px;
            color: var(--text-mid);
            margin-top: 6px;
        }
        .page-hero-right a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--sage-deeper);
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            transition: background .2s;
        }
        .page-hero-right a:hover { background: var(--sage-dark); }

        /* ─── GRID ───────────────────────────────────────── */
        .kos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        /* ─── CARD ───────────────────────────────────────── */
        .kos-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform .2s, box-shadow .2s;
            border: 1px solid rgba(107,143,113,0.08);
            position: relative;
        }
        .kos-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(74,107,80,0.18);
        }
        .kos-img-wrap { position: relative; overflow: hidden; }
        .kos-img {
            width: 100%; height: 170px;
            object-fit: cover; display: block;
            transition: transform .3s;
        }
        .kos-card:hover .kos-img { transform: scale(1.04); }
        .kos-img-placeholder {
            width: 100%; height: 170px;
            display: flex; align-items: center; justify-content: center;
            transition: transform .3s;
        }
        .kos-card:hover .kos-img-placeholder { transform: scale(1.04); }

        .kos-badge {
            position: absolute; bottom: 10px; left: 12px;
            font-size: 10px; font-weight: 700; letter-spacing: 0.5px;
            padding: 3px 10px; border-radius: 6px;
        }
        .badge-exclusive { background: var(--gold); color: #fff; }

        /* Tombol hapus favorit di card */
        .btn-unfav {
            position: absolute;
            top: 10px; right: 10px;
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.92);
            border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: transform .2s, background .2s;
        }
        .btn-unfav:hover { transform: scale(1.12); background: #fff; }
        .btn-unfav svg { fill: #ef4444; stroke: #ef4444; stroke-width: 1.8; }
        .btn-unfav.removing {
            animation: heartOut 0.3s ease forwards;
        }
        @keyframes heartOut {
            0%   { transform: scale(1); opacity: 1; }
            50%  { transform: scale(1.3); opacity: 0.6; }
            100% { transform: scale(0); opacity: 0; }
        }

        .kos-body { padding: 14px; }
        .kos-name {
            font-size: 14px; font-weight: 700; color: var(--text-dark);
            margin-bottom: 5px; line-height: 1.3;
        }
        .kos-loc {
            display: flex; align-items: flex-start; gap: 4px;
            font-size: 11px; color: var(--text-light);
            margin-bottom: 10px; line-height: 1.4;
        }
        .kos-loc svg { flex-shrink: 0; margin-top: 1px; }
        .kos-price {
            font-size: 13px; font-weight: 700; color: var(--sage-deeper);
            margin-bottom: 10px;
        }
        .kos-price span { font-size: 11px; font-weight: 400; color: var(--text-light); }
        .kos-tags { display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 12px; }
        .kos-tag {
            font-size: 10px; padding: 3px 8px; border-radius: 6px;
            background: var(--sage-bg); color: var(--sage-dark);
            font-weight: 500; border: 1px solid rgba(107,143,113,0.2);
        }
        .btn-detail {
            width: 100%; background: var(--sage-deeper); color: #fff;
            border: none; border-radius: 8px; padding: 9px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: background .2s;
            text-align: center; text-decoration: none; display: block;
        }
        .btn-detail:hover { background: var(--sage-dark); }

        /* ─── EMPTY STATE ────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 80px 24px;
            grid-column: 1 / -1;
        }
        .empty-icon {
            width: 80px; height: 80px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
        }
        .empty-icon svg { opacity: 0.5; }
        .empty-state h2 {
            font-size: 20px; font-weight: 700;
            color: var(--text-dark); margin-bottom: 8px;
        }
        .empty-state p {
            font-size: 14px; color: var(--text-mid);
            margin-bottom: 24px;
        }
        .empty-state a {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--sage-deeper); color: #fff;
            text-decoration: none; padding: 11px 24px;
            border-radius: 10px; font-size: 13.5px; font-weight: 600;
            transition: background .2s;
        }
        .empty-state a:hover { background: var(--sage-dark); }

        /* ─── CARD REMOVE ANIMATION ──────────────────────── */
        .kos-card.card-removing {
            animation: cardFadeOut 0.4s ease forwards;
        }
        @keyframes cardFadeOut {
            0%   { opacity: 1; transform: scale(1); }
            100% { opacity: 0; transform: scale(0.9); }
        }

        /* Toast */
        .fav-toast {
            position: fixed; bottom: 28px; left: 50%;
            transform: translateX(-50%) translateY(12px);
            background: #1a1a1a; color: #fff;
            padding: 10px 22px; border-radius: 30px;
            font-size: 13px; font-weight: 500;
            opacity: 0; pointer-events: none;
            transition: opacity .25s, transform .25s;
            z-index: 9999; white-space: nowrap;
        }
        .fav-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        /* ─── RESPONSIVE ─────────────────────────────────── */
        @media (max-width: 600px) {
            .page-wrap { padding: 24px 16px 60px; }
            .navbar { padding: 0 16px; }
            .kos-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('partials.sidebar')

<!-- NAVBAR -->
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
        {{-- Bell icon (notifikasi dipindah ke halaman Owner) --}}

        <a href="{{ route('chat.index', ['kos_id' => 1]) }}" class="nav-icon" title="Chat" style="text-decoration:none;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </a>
        <a href="{{ route('favorit.index') }}" class="nav-icon active" title="Favorit saya" style="text-decoration:none; position:relative;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </a>
    </div>
</nav>

<!-- PAGE CONTENT -->
<div class="page-wrap">

    <div class="page-hero">
        <div class="page-hero-left">
            <h1>
                <svg width="28" height="28" fill="#ef4444" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="1.5">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                Kos Favorit Saya
            </h1>
            <p>
                @if($favorit->count() > 0)
                    {{ $favorit->count() }} kos tersimpan — klik ❤️ untuk menghapus dari daftar
                @else
                    Belum ada kos yang kamu favoritkan
                @endif
            </p>
        </div>
        <div class="page-hero-right">
            <a href="{{ route('kos.index') }}">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                Cari Lebih Banyak Kos
            </a>
        </div>
    </div>

    <!-- KOS GRID -->
    <div class="kos-grid" id="favGrid">

        @forelse($favorit as $kos)
            @if(!isset($kos->status) || $kos->status !== 'aktif')
                @continue
            @endif
            <div class="kos-card" id="card-{{ $kos->id }}">
            <div class="kos-img-wrap">
                @if($kos->foto_utama)
                    <img src="{{ asset('storage/' . $kos->foto_utama) }}" alt="{{ $kos->nama }}" class="kos-img">
                @else
                    <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#d4c9b0,#a89878)">
                        <svg width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.5)" stroke-width="1.5">
                            <path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/>
                        </svg>
                    </div>
                @endif
                @if($kos->is_eksklusif)
                    <span class="kos-badge badge-exclusive">Eksklusif</span>
                @endif
                <!-- Tombol hapus favorit -->
                <button class="btn-unfav"
                        data-kos-id="{{ $kos->id }}"
                        onclick="hapusFavorit(this)"
                        title="Hapus dari favorit">
                    <svg width="16" height="16" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </button>
            </div>
            <div class="kos-body">
                <div class="kos-name">{{ $kos->nama }}</div>
                <div class="kos-loc">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $kos->alamat }}
                </div>
                <div class="kos-price">{{ $kos->harga_format }} <span>/bulan</span></div>
                @if($kos->fasilitas)
                <div class="kos-tags">
                    @foreach(array_slice($kos->fasilitas, 0, 3) as $fas)
                        <span class="kos-tag">{{ $fas }}</span>
                    @endforeach
                </div>
                @endif
                <a href="{{ route('kos.show', $kos->id) }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="1.5">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </div>
            <h2>Belum ada kos favorit</h2>
            <p>Temukan kos impianmu dan klik ikon ❤️ untuk menyimpannya di sini.</p>
            <a href="{{ route('kos.index') }}">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                Cari Kos Sekarang
            </a>
        </div>
        @endforelse

    </div>
</div>

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

<!-- Toast -->
<div class="fav-toast" id="favToast"></div>

<script>
    const csrfToken = '{{ csrf_token() }}';

    function hapusFavorit(btn) {
        const kosId = btn.dataset.kosId;
        const card  = document.getElementById('card-' + kosId);

        // Animasi tombol lalu card menghilang
        btn.classList.add('removing');

        setTimeout(() => {
            card.classList.add('card-removing');
        }, 200);

        // AJAX hapus favorit
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
            setTimeout(() => {
                card.remove();
                showToast('Dihapus dari favorit');

                // Kalau sudah kosong, tampilkan empty state
                const grid = document.getElementById('favGrid');
                if (grid.querySelectorAll('.kos-card').length === 0) {
                    grid.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="1.5">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            </div>
                            <h2>Belum ada kos favorit</h2>
                            <p>Temukan kos impianmu dan klik ikon ❤️ untuk menyimpannya di sini.</p>
                            <a href="/kos">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                                Cari Kos Sekarang
                            </a>
                        </div>`;
                }
            }, 400);
        })
        .catch(() => showToast('Terjadi kesalahan, coba lagi.'));
    }

    function showToast(msg) {
        const toast = document.getElementById('favToast');
        toast.textContent = msg;
        toast.classList.add('show');
        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => toast.classList.remove('show'), 2500);
    }


</script>

</body>
</html>
