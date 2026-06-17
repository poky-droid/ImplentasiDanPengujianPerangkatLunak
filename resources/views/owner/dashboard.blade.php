<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Dashboard Owner - Rumantra</title>
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
            --border:      #D8E4DA;
            --card-shadow: 0 4px 20px rgba(74,107,80,0.12);
            --radius:      12px;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--text-dark); }

        /* ─── NAVBAR ─────────────────────────────────────── */
        .navbar {
            background: var(--sage-bg);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; height: 64px;
            position: sticky; top: 0; z-index: 100;
            border-bottom: 1px solid rgba(107,143,113,0.15);
        }
        .navbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger { cursor: pointer; display: flex; flex-direction: column; gap: 4px; }
        .hamburger span { display: block; width: 20px; height: 2px; background: var(--text-dark); border-radius: 2px; }
        .brand-wrap { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-logo {
            width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--sage-light);
            background: var(--white); display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: 2px;
        }
        .brand-logo img { width: 38px; height: 38px; object-fit: contain; }
        .brand-name { font-size: 17px; font-weight: 700; color: var(--text-dark); letter-spacing: 1.5px; text-transform: uppercase; }

        .search-form { flex: 1; max-width: 420px; margin: 0 32px; }
        .search-bar { display: flex; align-items: center; background: var(--white); border: 1.5px solid rgba(107,143,113,0.25); border-radius: 24px; overflow: hidden; }
        .search-bar input { flex: 1; border: none; outline: none; padding: 10px 16px; font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--text-dark); background: transparent; }
        .search-bar input::placeholder { color: var(--text-light); }
        .search-bar .btn-filter { display: flex; align-items: center; gap: 6px; background: var(--sage-deeper); color: #fff; border: none; padding: 10px 16px; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500; cursor: pointer; transition: background .2s; white-space: nowrap; }
        .search-bar .btn-filter:hover { background: var(--sage-dark); }

        .navbar-right { display: flex; align-items: center; gap: 18px; }
        .nav-icon { color: var(--text-mid); cursor: pointer; transition: color .2s; display: flex; }
        .nav-icon:hover { color: var(--sage-deeper); }
        .nav-icon-add { color: var(--sage-deeper); }

        /* ─── HERO CAROUSEL ──────────────────────────────── */
        .hero-carousel-section { padding: 32px 64px 8px; }
        .hero-carousel { position: relative; display: flex; align-items: center; justify-content: center; gap: 16px; height: 340px; overflow: hidden; }
        .carousel-slide {
            position: relative; display: flex; align-items: center; justify-content: center;
            text-decoration: none; border-radius: 16px; overflow: hidden; flex-shrink: 0;
            transition: all .4s ease; box-shadow: var(--card-shadow);
            background-size: cover; background-position: center;
        }
        .carousel-slide::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, transparent 50%, rgba(30,45,34,0.65) 100%); }
        .carousel-slide-icon { position: relative; z-index: 1; }
        .carousel-slide-name { position: absolute; bottom: 16px; left: 16px; color: #fff; font-weight: 600; font-size: 15px; z-index: 2; }
        .carousel-slide.side .carousel-slide-name { display: none; }
        .carousel-slide.is-hidden { display: none; }
        .carousel-slide.active { width: 52%; height: 100%; opacity: 1; }
        .carousel-slide.side { width: 22%; height: 70%; opacity: .55; filter: grayscale(15%); }
        .carousel-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 40px; height: 40px; border-radius: 50%; background: var(--white); border: none;
            box-shadow: var(--card-shadow); display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 5; color: var(--sage-deeper); font-size: 18px;
        }
        .arrow-prev { left: 8px; }
        .arrow-next { right: 8px; }
        .carousel-dots { display: flex; justify-content: center; gap: 8px; margin-top: 16px; }
        .carousel-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--sage-light); cursor: pointer; transition: background .2s, transform .2s; }
        .carousel-dot.active { background: var(--sage-deeper); transform: scale(1.3); }

        /* ─── EXPLORE STRIP ─────────────────────────────── */
        .explore { background: var(--sage-deeper); padding: 36px 64px; }
        .explore-title { text-align: center; font-weight: 600; font-size: 18px; color: rgba(255,255,255,0.85); margin-bottom: 28px; letter-spacing: 0.5px; }
        .explore-grid { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; }
        .explore-item { display: flex; flex-direction: column; align-items: center; gap: 12px; cursor: pointer; transition: transform .2s; }
        .explore-item:hover { transform: translateY(-4px); }
        .explore-icon { width: 80px; height: 80px; border: 1.5px solid rgba(255,255,255,0.25); border-radius: 16px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.06); transition: border-color .2s, background .2s; }
        .explore-item:hover .explore-icon { border-color: var(--gold-light); background: rgba(201,168,76,0.1); }
        .explore-label { font-size: 13px; color: rgba(255,255,255,0.7); font-weight: 500; letter-spacing: 0.3px; }
        .explore-item:hover .explore-label { color: var(--gold-light); }

        /* ─── HOW IT WORKS ──────────────────────────────── */
        .how-it-works { padding: 48px 64px; background: var(--cream); }
        .how-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
        .how-title { font-size: 26px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px; line-height: 1.3; }
        .how-subtitle { font-size: 14px; color: var(--text-mid); line-height: 1.7; margin-bottom: 28px; max-width: 380px; }
        .how-steps { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .how-step { background: var(--sage-deeper); border-radius: var(--radius); padding: 18px; display: flex; flex-direction: column; gap: 10px; }
        .step-number { width: 26px; height: 26px; border-radius: 50%; background: var(--white); color: var(--sage-deeper); font-weight: 700; font-size: 13px; display: flex; align-items: center; justify-content: center; }
        .step-title { color: #fff; font-weight: 600; font-size: 14px; }
        .step-desc { color: rgba(255,255,255,0.7); font-size: 12px; line-height: 1.5; }
        .how-image img { width: 100%; height: 380px; object-fit: cover; border-radius: 20px; box-shadow: var(--card-shadow); }

        /* ─── KOS SECTION ───────────────────────────────── */
        .section { padding: 48px 64px; background: var(--cream); }
        .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
        .section-title { font-size: 22px; color: var(--text-dark); font-weight: 600; }
        .btn-lihat { background: var(--sage-deeper); color: #fff; border: none; border-radius: 20px; padding: 8px 22px; font-size: 13px; font-weight: 500; cursor: pointer; transition: background .2s; text-decoration: none; display: inline-block; }
        .btn-lihat:hover { background: var(--sage-dark); }
        .kos-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

        .kos-card { background: var(--white); border-radius: var(--radius); overflow: hidden; box-shadow: var(--card-shadow); transition: transform .2s, box-shadow .2s; }
        .kos-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(74,107,80,0.2); }
        .kos-img-wrap { position: relative; width: 100%; height: 150px; overflow: hidden; }
        .kos-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .kos-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; }
        .kos-type-badge { position: absolute; top: 10px; left: 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 12px; }
        .badge-putri     { background: #FFE8EF; color: #C0516A; }
        .badge-putra     { background: #E8F0FF; color: #4A6BC0; }
        .badge-campur    { background: #E8F5E9; color: #2E7D32; }
        .badge-exclusive { background: #FFF3D6; color: #B8860B; }

        .kos-body { padding: 14px; }
        .kos-name { font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 4px; line-height: 1.3; }
        .kos-loc { font-size: 11px; color: var(--text-light); margin-bottom: 8px; display: flex; align-items: flex-start; gap: 3px; }
        .kos-price { font-size: 14px; font-weight: 700; color: var(--sage-dark); margin-bottom: 10px; }
        .kos-price span { font-size: 11px; font-weight: 400; color: var(--text-light); }
        .kos-amenities { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; }
        .amenity-chip { display: inline-flex; align-items: center; gap: 4px; font-size: 10px; color: var(--text-mid); background: var(--sage-bg); padding: 3px 8px; border-radius: 8px; }
        .btn-lihat-detail { display: block; text-align: center; background: var(--sage-deeper); color: #fff; border-radius: 8px; padding: 9px; font-size: 13px; font-weight: 600; text-decoration: none; transition: background .2s; }
        .btn-lihat-detail:hover { background: var(--sage-dark); }
        .kos-empty { grid-column: 1 / -1; text-align: center; padding: 40px 20px; color: var(--text-mid); font-size: 14px; background: var(--white); border-radius: var(--radius); }
        .kos-empty a { color: var(--sage-deeper); font-weight: 600; }

        /* ─── TESTIMONI ─────────────────────────────────── */
        .testi-section { background: var(--sage-bg); padding: 52px 64px; }
        .testi-title { font-size: 22px; font-weight: 600; color: var(--text-dark); text-align: center; margin-bottom: 36px; }
        .testi-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 860px; margin: 0 auto; }
        .testi-card { background: var(--white); border-radius: var(--radius); padding: 24px; box-shadow: var(--card-shadow); }
        .testi-text { font-size: 13px; line-height: 1.7; color: var(--text-mid); margin-bottom: 20px; }
        .testi-author { display: flex; align-items: center; gap: 12px; }
        .testi-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--sage-light), var(--sage-dark)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 15px; color: #fff; flex-shrink: 0; }
        .testi-name { font-weight: 600; font-size: 13px; color: var(--text-dark); }
        .testi-univ { font-size: 11px; color: var(--text-light); }

        /* ─── FOOTER ─────────────────────────────────────── */
        footer { background: var(--white); padding: 56px 64px 28px; border-top: 1px solid var(--sage-bg); }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 36px; }
        .footer-brand-wrap { display: flex; align-items: center; gap: 10px; text-decoration: none; margin-bottom: 14px; }
        .footer-brand-logo { width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--sage-light); background: var(--sage-bg); display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 2px; }
        .footer-brand-logo img { width: 38px; height: 38px; object-fit: contain; }
        .footer-brand-name { font-size: 17px; font-weight: 700; color: var(--text-dark); letter-spacing: 1.5px; }
        .footer-desc { font-size: 13px; color: var(--text-mid); line-height: 1.7; max-width: 280px; }
        .footer-col-title { font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 18px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { font-size: 13px; color: var(--text-mid); text-decoration: none; transition: color .2s; }
        .footer-links a:hover { color: var(--sage-deeper); }
        .footer-social { display: flex; gap: 12px; }
        .social-btn { width: 36px; height: 36px; border: 1px solid var(--border); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-mid); transition: border-color .2s, color .2s; }
        .social-btn:hover { border-color: var(--sage-deeper); color: var(--sage-deeper); }
        .footer-bottom { border-top: 1px solid var(--sage-bg); padding-top: 20px; text-align: center; font-size: 12px; color: var(--text-light); }

        /* ─── RESPONSIVE ─────────────────────────────────── */
        @media (max-width: 1100px) { .kos-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 800px) {
            .hero-carousel-section, .section, .testi-section { padding: 32px 24px; }
            .explore { padding: 28px 24px; }
            .how-it-works { padding: 32px 24px; }
            .how-grid { grid-template-columns: 1fr; }
            .how-steps { grid-template-columns: 1fr 1fr; }
            .kos-grid { grid-template-columns: repeat(2, 1fr); }
            .testi-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            footer { padding: 40px 24px 20px; }
            .navbar { padding: 0 16px; }
            .search-form { display: none; }
            .carousel-slide.side { display: none; }
            .carousel-slide.active { width: 90%; height: 100%; }
        }
        @media (max-width: 500px) { .kos-grid { grid-template-columns: 1fr; } }
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
        <a href="{{ route('owner.dashboard') }}" class="brand-wrap">
            <div class="brand-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
            </div>
            <span class="brand-name">Rumantra</span>
        </a>
    </div>

    <form action="{{ route('kos.search') }}" method="GET" class="search-form">
        <div class="search-bar">
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
        <a href="{{ route('notifikasi.index') }}" class="nav-icon" title="Notifikasi">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </a>
                @foreach($kosList as $kos)
            <div class="card">
                <h5>{{ $kos->nama }}</h5>

                <a href="{{ route('chat.index', ['kos_id' => $kos->id]) }}">
                    Chat
                </a>
            </div>
        @endforeach
                <a href="{{ route('kos.create') }}" class="nav-icon nav-icon-add" title="Tambah Kos">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                </a>
            </div>
        </nav>

<!-- ══════════════════ HERO CAROUSEL ══════════════════ -->
<section class="hero-carousel-section">
    <div class="hero-carousel">
        <button type="button" class="carousel-arrow arrow-prev" onclick="moveSlide(-1)">‹</button>
        <div class="carousel-track" id="carouselTrack">
            @forelse ($kosList->take(3) as $kos)
                <a href="{{ route('kos.show', $kos->id) }}" class="carousel-slide"
                   style="background-image: url('{{ $kos->foto_utama ? asset('storage/'.$kos->foto_utama) : '' }}'); background-color: #9ab09c;">
                    @unless($kos->foto_utama)
                        <svg class="carousel-slide-icon" width="48" height="48" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.7)" stroke-width="1.5">
                            <path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/>
                        </svg>
                    @endunless
                    <span class="carousel-slide-name">{{ $kos->nama }}</span>
                </a>
            @empty
                <a href="{{ route('kos.create') }}" class="carousel-slide" style="background: linear-gradient(135deg, var(--sage-light), var(--sage-deeper));">
                    <span class="carousel-slide-name" style="font-size:16px;">+ Tambahkan kos pertama Anda</span>
                </a>
            @endforelse
        </div>
        <button type="button" class="carousel-arrow arrow-next" onclick="moveSlide(1)">›</button>
    </div>
    <div class="carousel-dots" id="carouselDots"></div>
</section>

<!-- ══════════════════ EXPLORE STRIP ══════════════════ -->
<div class="explore">
    <p class="explore-title">Explore Rumantra</p>
    <div class="explore-grid">
        <div class="explore-item">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <rect x="8" y="14" width="32" height="24" rx="3"/><path d="M16 14v-3a8 8 0 0 1 16 0v3"/><path d="M24 26v3"/><circle cx="24" cy="24" r="3"/>
                </svg>
            </div>
            <span class="explore-label">Exclusive</span>
        </div>
        <div class="explore-item">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <path d="M10 38V18l14-8 14 8v20"/><rect x="18" y="26" width="12" height="12"/><path d="M18 26v12M30 26v12"/>
                </svg>
            </div>
            <span class="explore-label">Campur</span>
        </div>
        <div class="explore-item">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <path d="M10 38V18l14-8 14 8v20"/><path d="M20 38v-8h8v8"/><path d="M16 22h4v6h-4zM28 22h4v6h-4z"/>
                </svg>
            </div>
            <span class="explore-label">Putri</span>
        </div>
        <div class="explore-item">
            <div class="explore-icon">
                <svg width="36" height="36" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.85)" stroke-width="1.5">
                    <path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/><path d="M22 38v-6h4v6"/>
                </svg>
            </div>
            <span class="explore-label">Putra</span>
        </div>
    </div>
</div>

<!-- ══════════════════ HOW IT WORKS ══════════════════ -->
<section class="how-it-works">
    <div class="how-grid">
        <div class="how-text">
            <h2 class="how-title">Temukan Kos Impianmu dengan Mudah dan Cepat</h2>
            <p class="how-subtitle">Mulai pencarian kosmu sekarang dan temukan hunian yang nyaman dalam hitungan menit.</p>
            <div class="how-steps">
                <div class="how-step">
                    <span class="step-number">1</span>
                    <div class="step-title">Cari Lokasi</div>
                    <div class="step-desc">Masukkan kota, kampus, atau area yang diinginkan.</div>
                </div>
                <div class="how-step">
                    <span class="step-number">2</span>
                    <div class="step-title">Gunakan Filter</div>
                    <div class="step-desc">Pilih rentang harga, fasilitas, dan tipe kos.</div>
                </div>
                <div class="how-step">
                    <span class="step-number">3</span>
                    <div class="step-title">Bandingkan Kos</div>
                    <div class="step-desc">Lihat foto, fasilitas, lokasi, dan ulasan.</div>
                </div>
                <div class="how-step">
                    <span class="step-number">4</span>
                    <div class="step-title">Booking Kos</div>
                    <div class="step-desc">Hubungi pemilik kos atau lakukan pemesanan langsung.</div>
                </div>
            </div>
        </div>
        <div class="how-image">
            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=700&q=80" alt="Apartment complex">
        </div>
    </div>
</section>

<!-- ══════════════════ KOS SECTION ══════════════════ -->
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Kos yang Anda Kelola</h2>
        <a href="{{ route('owner.kos.index') }}" class="btn-lihat">Lihat Lainnya</a>
    </div>

    <div class="kos-grid">
        @forelse ($kosList as $kos)
            @php
                $badgeClass = $kos->is_eksklusif ? 'badge-exclusive' : 'badge-' . $kos->tipe;
                $badgeLabel = $kos->is_eksklusif ? 'Eksklusif' : ucfirst($kos->tipe);
            @endphp
            <div class="kos-card">
                <div class="kos-img-wrap">
                    @if($kos->foto_utama)
                        <img src="{{ asset('storage/' . $kos->foto_utama) }}" alt="{{ $kos->nama }}">
                    @else
                        <div class="kos-img-placeholder" style="background: linear-gradient(135deg,#c9d9ca,#9ab09c)">
                            <svg width="40" height="40" fill="none" viewBox="0 0 48 48" stroke="rgba(255,255,255,0.6)" stroke-width="1.5">
                                <path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/>
                            </svg>
                        </div>
                    @endif
                    <span class="kos-type-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                </div>
                <div class="kos-body">
                    <div class="kos-name">{{ $kos->nama }}</div>
                    <div class="kos-loc">
                        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                        </svg>
                        {{ $kos->alamat }}
                    </div>
                    <div class="kos-price">{{ $kos->harga_format }}<span>/bulan</span></div>

                    @if(!empty($kos->fasilitas))
                        <div class="kos-amenities">
                            @foreach (array_slice($kos->fasilitas, 0, 3) as $item)
                                <span class="amenity-chip">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    {{ $item }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ route('kos.show', $kos->id) }}" class="btn-lihat-detail">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div class="kos-empty">
                Anda belum menambahkan kos. Klik tombol <strong>+</strong> di navbar untuk menambahkan kos pertama Anda.
            </div>
        @endforelse
    </div>
</section>

<!-- ══════════════════ TESTIMONI ══════════════════ -->
<section class="testi-section">
    <h2 class="testi-title">Cerita dari Teman-teman Mahasiswa</h2>
    <div class="testi-grid">
        <div class="testi-card">
            <p class="testi-text">Pertama kali merantau sendirian, bingung banget cari kos yang aman dan deket kampus. Lewat Rumantra, aku dapet kos putri cuma 5 menit jalan kaki. Makasih Rumantra, aku jadi tenang!</p>
            <div class="testi-author">
                <div class="testi-avatar">LA</div>
                <div>
                    <div class="testi-name">Leclerc Antonio</div>
                    <div class="testi-univ">Pengguna</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <p class="testi-text">Awalnya ragu pake aplikasi cari kos online. Tapi ternyata gampang banget. Bisa filter sesuai keinginan, chat pemilik kos langsung. Dapet kos eksklusif dengan kamar mandi dalam. Rekomended!</p>
            <div class="testi-author">
                <div class="testi-avatar" style="background: linear-gradient(135deg,#9ab0d0,#4a6ba0)">UK</div>
                <div>
                    <div class="testi-name">Usman Kloliq</div>
                    <div class="testi-univ">Pengguna</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer>
    <div class="footer-grid">
        <div>
            <a href="{{ route('owner.dashboard') }}" class="footer-brand-wrap">
                <div class="footer-brand-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
                </div>
                <span class="footer-brand-name">RUMANTRA</span>
            </a>
            <p class="footer-desc">Temukan kos yang nyaman, aman, dan sesuai kebutuhan Anda dengan proses pencarian yang mudah dan cepat.</p>
        </div>
        <div>
            <div class="footer-col-title">Pencarian Berdasarkan</div>
            <ul class="footer-links">
                <li><a href="#">Kos Putra</a></li>
                <li><a href="#">Kos Putri</a></li>
                <li><a href="#">Kos Campur</a></li>
                <li><a href="#">Kos Dekat Kampus</a></li>
                <li><a href="#">Kos Dekat Perkantoran</a></li>
                <li><a href="#">Kos Bulanan</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Wilayah Populer</div>
            <ul class="footer-links">
                <li><a href="#">Bandung</a></li>
                <li><a href="#">Yogyakarta</a></li>
                <li><a href="#">Jakarta</a></li>
                <li><a href="#">Malang</a></li>
                <li><a href="#">Semarang</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Social</div>
            <div class="footer-social">
                <div class="social-btn">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </div>
                <div class="social-btn">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                </div>
                <div class="social-btn">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.58 2 12.25c0 4.49 2.94 8.3 7 9.5v-3.1c-2.5-.9-4.2-3.2-4.2-6.4 0-3.7 3-6.7 6.7-6.7 1.8 0 3.4.7 4.6 1.9l-1.6 1.6c-.7-.7-1.7-1.1-2.8-1.1-2.3 0-4.2 1.9-4.2 4.3 0 1.5.8 2.8 2 3.5.1-.6.4-1.1.9-1.5.6-.5 1.4-.7 2.2-.5.5-1.2 1.7-2 3.1-2 1.9 0 3.4 1.5 3.4 3.4s-1.5 3.4-3.4 3.4c-.5 0-.9-.1-1.4-.3.1.5.1 1 .1 1.5 0 .9-.2 1.8-.5 2.6 4-1.3 6.9-5 6.9-9.4C22 6.58 17.52 2 12 2z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} Rumantra &nbsp;·&nbsp; Teman Mahasiswa Cari Kos &nbsp;·&nbsp;
        <a href="#">Kebijakan Privasi</a> &nbsp;·&nbsp;
        <a href="#">Syarat & Ketentuan</a>
    </div>
</footer>

<script>
    (function () {
        const slides = Array.from(document.querySelectorAll('#carouselTrack .carousel-slide'));
        const dotsWrap = document.getElementById('carouselDots');
        let current = 0;

        function render() {
            slides.forEach((slide, i) => {
                slide.classList.remove('active', 'side', 'is-hidden');
                const offset = (i - current + slides.length) % slides.length;
                if (offset === 0) slide.classList.add('active');
                else if (offset === 1 || offset === slides.length - 1) slide.classList.add('side');
                else slide.classList.add('is-hidden');
            });

            dotsWrap.innerHTML = '';
            if (slides.length > 1) {
                slides.forEach((_, i) => {
                    const dot = document.createElement('span');
                    dot.className = 'carousel-dot' + (i === current ? ' active' : '');
                    dot.addEventListener('click', () => { current = i; render(); });
                    dotsWrap.appendChild(dot);
                });
            }
        }

        window.moveSlide = function (dir) {
            if (slides.length === 0) return;
            current = (current + dir + slides.length) % slides.length;
            render();
        };

        if (slides.length > 0) render();
    })();
</script>

</body>
</html>