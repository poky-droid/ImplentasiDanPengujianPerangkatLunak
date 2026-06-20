<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage-deeper: #3A5540;
            --sage-dark:   #4A6B50;
            --sage-light:  #A8C5AC;
            --sage-bg:     #EDF3EE;
            --cream:       #F0F4F1;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
            --text-mid:    #4A5C4D;
            --text-light:  #8A9E8D;
            --border:      #D8E4DA;
            --danger:      #E57373;
            --success:     #66BB6A;
            --warning:     #FFB74D;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: var(--sage-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            height: 64px;
            border-bottom: 1px solid rgba(107,143,113,0.15);
            flex-shrink: 0;
            z-index: 100;
        }
        .navbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger { cursor: pointer; display: flex; flex-direction: column; gap: 4px; }
        .hamburger span { display: block; width: 20px; height: 2px; background: var(--text-dark); border-radius: 2px; }
        .brand-wrap { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-logo {
            width: 44px; height: 44px; border-radius: 50%;
            border: 2px solid var(--sage-light); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: 2px;
        }
        .brand-logo img { width: 38px; height: 38px; object-fit: contain; }
        .brand-name { font-size: 17px; font-weight: 700; color: var(--text-dark); letter-spacing: 1.5px; text-transform: uppercase; }

        .container {
            max-width: 900px;
            margin: 32px auto;
            padding: 0 24px;
            width: 100%;
            flex: 1;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .booking-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 16px rgba(74,107,80,0.06);
            border: 1px solid var(--border);
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 24px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(74,107,80,0.12);
        }

        .kos-img {
            width: 140px;
            height: 140px;
            border-radius: 12px;
            overflow: hidden;
            background: var(--sage-bg);
            border: 1px solid var(--border);
        }
        .kos-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .booking-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kos-meta {
            margin-bottom: 12px;
        }
        .kos-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            text-decoration: none;
            margin-bottom: 4px;
            display: block;
        }
        .kos-name:hover {
            color: var(--sage-dark);
        }
        .kos-address {
            font-size: 13px;
            color: var(--text-light);
        }

        .booking-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            font-size: 13px;
            margin-bottom: 16px;
        }
        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .detail-label {
            color: var(--text-light);
            font-weight: 500;
        }
        .detail-value {
            color: var(--text-dark);
            font-weight: 600;
        }

        .booking-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            padding-top: 16px;
            margin-top: auto;
        }

        .status-badges {
            display: flex;
            gap: 8px;
        }
        .badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: capitalize;
        }
        .badge-pending { background: #FFF9E8; color: #C9A84C; border: 1px solid #FFE082; }
        .badge-confirmed { background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }
        .badge-cancelled { background: #FFEBEE; color: #C62828; border: 1px solid #FFCDD2; }

        .btn-group {
            display: flex;
            gap: 10px;
        }
        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
        }
        .btn-primary {
            background: var(--sage-deeper);
            color: #fff;
        }
        .btn-primary:hover {
            background: var(--sage-dark);
        }
        .btn-secondary {
            background: #fff;
            color: var(--text-mid);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover {
            background: var(--sage-bg);
            color: var(--sage-deeper);
            border-color: var(--sage-light);
        }

        .empty-state {
            background: var(--white);
            border-radius: 16px;
            padding: 48px 24px;
            text-align: center;
            border: 1px solid var(--border);
            box-shadow: 0 2px 16px rgba(74,107,80,0.04);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .booking-card {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .kos-img {
                width: 100%;
                height: 160px;
            }
            .booking-details {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            .booking-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .btn-group {
                width: 100%;
                justify-content: flex-end;
            }
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
                <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
            </div>
            <span class="brand-name">Rumantra</span>
        </a>
    </div>
</nav>

<div class="container">
    <h1 class="page-title">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
        </svg>
        Riwayat Transaksi Saya
    </h1>

    @if(session('success'))
        <div style="background: #E8F5E9; border: 1.5px solid #C8E6C9; color: #2E7D32; border-radius: 12px; padding: 12px 18px; font-size: 13.5px; font-weight: 600; margin-bottom: 20px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @forelse($bookings as $booking)
        <div class="booking-card">
            <div class="kos-img">
                @if($booking->kos && $booking->kos->foto_utama)
                    <img src="{{ asset('storage/' . $booking->kos->foto_utama) }}" alt="">
                @else
                    <div style="width:100%;height:100%;background:var(--sage-bg);display:flex;align-items:center;justify-content:center;">
                        <svg width="28" height="28" fill="none" viewBox="0 0 48 48" stroke="var(--sage-light)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                    </div>
                @endif
            </div>

            <div class="booking-info">
                <div class="kos-meta">
                    <a href="{{ route('kos.show', $booking->kos_id) }}" class="kos-name">{{ $booking->kos->nama ?? 'Nama Kos' }}</a>
                    <div class="kos-address">📍 {{ $booking->kos->alamat ?? 'Alamat tidak tersedia' }}</div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Mulai</span>
                        <span class="detail-value">
                            {{ $booking->tanggal_sewa ? $booking->tanggal_sewa->format('d M Y') : '-' }}
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Durasi</span>
                        <span class="detail-value">{{ $booking->durasi ?? 0 }} Bulan</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Harga</span>
                        <span class="detail-value" style="color: var(--sage-deeper);">Rp {{ number_format($booking->total ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="booking-actions">
                    <div class="status-badges">
                        @if($booking->status === 'cancelled')
                            <span class="badge badge-cancelled">Pesanan Dibatalkan</span>
                        @elseif($booking->pembayaran)
                            @if($booking->pembayaran->status_pembayaran === 'pending')
                                <span class="badge badge-pending">⏳ Pembayaran Pending</span>
                            @elseif($booking->pembayaran->status_pembayaran === 'lunas')
                                <span class="badge badge-confirmed">✅ Sudah Lunas</span>
                            @elseif($booking->pembayaran->status_pembayaran === 'ditolak')
                                <span class="badge badge-cancelled">❌ Pembayaran Ditolak</span>
                            @endif
                        @else
                            <span class="badge badge-pending">⏳ Belum Bayar</span>
                        @endif
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('kos.show', $booking->kos_id) }}" class="btn-action btn-secondary">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Detail Kos
                        </a>
                        <a href="{{ route('chat.index', $booking->kos_id) }}" class="btn-action btn-secondary">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Hubungi Pemilik
                        </a>

                        @if($booking->status !== 'cancelled' && (!$booking->pembayaran || $booking->pembayaran->status_pembayaran === 'pending'))
                            <a href="{{ route('pembayaran.create', $booking->id) }}" class="btn-action btn-primary">
                                Cek Status / Bayar
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--sage-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="var(--sage-light)" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="empty-title">Belum Ada Riwayat Transaksi</h3>
            <p class="empty-sub">Kos yang Anda pesan atau bayar akan tampil di halaman ini.</p>
        </div>
    @endforelse
</div>

</body>
</html>
