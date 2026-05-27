<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kos - Kos Putri Melati</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f0ede8;
            --surface: #faf9f7;
            --surface-2: #f4f2ee;
            --border: #e5e0d8;
            --text-primary: #1e1c19;
            --text-secondary: #6b6560;
            --text-muted: #a09a92;
            --accent: #2d3a2e;
            --accent-hover: #3d4f3e;
            --accent-light: #e8ede8;
            --price-color: #1e1c19;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.10), 0 4px 12px rgba(0,0,0,0.06);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 0 0 60px;
        }

        /* ── TOP NAV ── */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(8px);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.01em;
            transition: color 0.2s, gap 0.2s;
        }
        .back-btn:hover { color: var(--accent); gap: 12px; }
        .back-btn svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ── MAIN LAYOUT ── */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px 0;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            align-items: start;
        }

        /* ── GALLERY ── */
        .gallery {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 300px 300px;
            gap: 10px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .gallery-main {
            grid-row: 1 / 3;
            position: relative;
            overflow: hidden;
        }

        .gallery-thumb {
            position: relative;
            overflow: hidden;
        }

        .gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-main:hover img,
        .gallery-thumb:hover img {
            transform: scale(1.04);
        }

        /* Placeholder gradient kalau tidak ada gambar */
        .img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .img-placeholder-main {
            background: linear-gradient(135deg, #d4cfc8 0%, #c8c2b8 40%, #bfb9af 100%);
        }
        .img-placeholder-bath {
            background: linear-gradient(135deg, #cdc8c0 0%, #c0bab2 100%);
        }
        .img-placeholder-room {
            background: linear-gradient(135deg, #d0cbc3 0%, #c4bfb8 100%);
        }
        .img-placeholder svg {
            opacity: 0.25;
            width: 48px;
            height: 48px;
        }

        /* ── INFO CARD ── */
        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-sm);
        }

        .kos-name {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            line-height: 1.15;
            color: var(--text-primary);
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        .kos-address {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }
        .kos-address svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 1px;
            color: var(--text-muted);
        }

        .section-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .description {
            font-size: 14.5px;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 28px;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 24px 0;
        }

        /* ── FACILITIES ── */
        .facilities-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .facility-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 14px 18px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            min-width: 80px;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
            cursor: default;
        }
        .facility-item:hover {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
            transform: translateY(-2px);
        }
        .facility-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
        }
        .facility-icon svg { width: 22px; height: 22px; }
        .facility-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-secondary);
            white-space: nowrap;
        }

        /* ── PRICE CARD (sidebar) ── */
        .price-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 80px;
        }

        .price-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
        }

        .price-amount {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem;
            color: var(--price-color);
            letter-spacing: -0.02em;
        }
        .price-period {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Detail rows */
        .detail-rows { display: flex; flex-direction: column; gap: 0; }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-key {
            font-size: 13.5px;
            color: var(--text-secondary);
        }
        .detail-value {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Badge available */
        .badge-available {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 12px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .badge-available::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4caf50;
        }

        /* CTA Buttons */
        .cta-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 24px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px 20px;
            border-radius: var(--radius-md);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.02em;
            cursor: pointer;
            transition: all 0.22s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: none;
            text-decoration: none;
        }
        .btn:active { transform: scale(0.98); }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 14px rgba(45,58,46,0.25);
        }
        .btn-primary:hover {
            background: var(--accent-hover);
            box-shadow: 0 6px 20px rgba(45,58,46,0.35);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1.5px solid var(--border);
        }
        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-light);
        }

        /* ── FADE IN ANIMATION ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .gallery     { animation: fadeUp 0.5s ease both; }
        .info-card   { animation: fadeUp 0.5s 0.1s ease both; }
        .price-card  { animation: fadeUp 0.5s 0.15s ease both; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .layout {
                grid-template-columns: 1fr;
            }
            .price-card {
                position: static;
            }
        }
        @media (max-width: 600px) {
            .container { padding: 20px 16px 0; }
            .gallery {
                grid-template-columns: 1fr;
                grid-template-rows: 240px 160px 160px;
            }
            .gallery-main { grid-row: 1; }
            .kos-name { font-size: 1.6rem; }
            .price-amount { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

    <!-- TOP BAR -->
    <div class="topbar">
        <a href="{{ url()->previous() }}" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="container">
        <div class="layout">

            <!-- LEFT COLUMN -->
            <div class="left-col">

                <!-- GALLERY -->
                <div class="gallery">
                    <!-- Gambar utama (besar, kiri) -->
                    <div class="gallery-main">
                        @if(isset($kos->images[0]))
                            <img src="{{ asset($kos->images[0]) }}" alt="Kamar utama {{ $kos->nama }}">
                        @else
                            <div class="img-placeholder img-placeholder-main">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 9.75h.008v.008H3V9.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM21 12.75h-18v-1.5h18v1.5z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Thumb 1 (kamar mandi) -->
                    <div class="gallery-thumb">
                        @if(isset($kos->images[1]))
                            <img src="{{ asset($kos->images[1]) }}" alt="Kamar mandi {{ $kos->nama }}">
                        @else
                            <div class="img-placeholder img-placeholder-bath">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 9.75h.008v.008H3V9.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Thumb 2 (kamar sudut) -->
                    <div class="gallery-thumb">
                        @if(isset($kos->images[2]))
                            <img src="{{ asset($kos->images[2]) }}" alt="Sudut kamar {{ $kos->nama }}">
                        @else
                            <div class="img-placeholder img-placeholder-room">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 9.75h.008v.008H3V9.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- INFO CARD -->
                <div class="info-card">
                    <h1 class="kos-name">{{ $kos->nama ?? 'Kos Putri Melati' }}</h1>

                    <div class="kos-address">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                        {{ $kos->alamat ?? 'Jl. Jatiwangun Purwokerto Selatan' }}
                    </div>

                    <p class="section-label">Deskripsi</p>
                    <p class="description">
                        {{ $kos->deskripsi ?? 'Kos putri nyaman dan bersih berada di pusat kota.' }}
                    </p>

                    <div class="divider"></div>

                    <p class="section-label">Fasilitas</p>
                    <div class="facilities-grid">

                        @if(isset($kos->fasilitas) && is_array($kos->fasilitas))
                            @foreach($kos->fasilitas as $f)
                                <div class="facility-item">
                                    <div class="facility-icon">
                                        {{-- Tambahkan kondisi ikon sesuai nama fasilitas --}}
                                        @if(str_contains(strtolower($f), 'wifi') || str_contains(strtolower($f), 'wi-fi'))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z"/></svg>
                                        @elseif(str_contains(strtolower($f), 'laundry'))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        @elseif(str_contains(strtolower($f), 'parkir'))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                                        @elseif(str_contains(strtolower($f), 'ac'))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @endif
                                    </div>
                                    <span class="facility-label">{{ $f }}</span>
                                </div>
                            @endforeach
                        @else
                            {{-- Default fasilitas sesuai mockup --}}
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z"/></svg>
                                </div>
                                <span class="facility-label">Wi-fi</span>
                            </div>
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <span class="facility-label">K.M Dalam</span>
                            </div>
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span class="facility-label">Laundry</span>
                            </div>
                        @endif

                    </div>
                </div>
            </div><!-- /left-col -->

            <!-- RIGHT COLUMN — PRICE CARD -->
            <div class="right-col">
                <div class="price-card">
                    <div class="price-header">
                        <div class="price-amount">
                            Rp. {{ isset($kos->harga) ? number_format($kos->harga, 0, ',', '.') : '1.600.000' }}
                            <span class="price-period">/Bulan</span>
                        </div>
                    </div>

                    <div class="detail-rows">
                        <div class="detail-row">
                            <span class="detail-key">Tipe kos</span>
                            <span class="detail-value">{{ $kos->tipe ?? 'Putri' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Luas kamar</span>
                            <span class="detail-value">{{ $kos->luas ?? '3 x 4 m' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Kamar mandi</span>
                            <span class="detail-value">{{ $kos->kamar_mandi ?? 'Dalam' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Tersedia</span>
                            <span class="detail-value">
                                @if(isset($kos->tersedia) && $kos->tersedia > 0)
                                    <span class="badge-available">{{ $kos->tersedia }} Kamar</span>
                                @else
                                    <span class="badge-available">3 Kamar</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="cta-group">
                        {{-- Tombol Ajukan Sewa --}}
                        <a href="{{ route('sewa.ajukan', $kos->id ?? '#') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:17px;height:17px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Ajukan sewa
                        </a>

                        {{-- Tombol Hubungi Pemilik --}}
                        <a href="{{ route('pemilik.hubungi', $kos->id ?? '#') }}" class="btn btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:17px;height:17px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                            Hubungi Pemilik
                        </a>
                    </div>
                </div>
            </div><!-- /right-col -->

        </div><!-- /layout -->
    </div><!-- /container -->

</body>
</html>