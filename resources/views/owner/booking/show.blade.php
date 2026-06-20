<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Detail Booking #{{ $booking->id }} - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sage-deeper: #3A5540; --sage-dark: #4A6B50; --sage-light: #A8C5AC;
            --sage-bg: #EDF3EE; --cream: #F8F6F1; --white: #FFFFFF;
            --text-dark: #1E2D22; --text-mid: #4A5C4D; --text-light: #8A9E8D;
            --border: #E2EAE3; --danger: #E57373; --sidebar-w: 260px;
            --card-shadow: 0 2px 16px rgba(58,85,64,0.10); --radius: 14px;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--text-dark); min-height: 100vh; display: flex; }

        .sidebar { width: var(--sidebar-w); background: var(--sage-deeper); min-height: 100vh; display: flex; flex-direction: column; position: fixed; left: 0; top: 0; z-index: 200; }
        .sidebar-header { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 12px; }
        .sidebar-logo { width: 42px; height: 42px; border-radius: 12px; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 3px; flex-shrink: 0; }
        .sidebar-logo img { width: 36px; height: 36px; object-fit: contain; }
        .sidebar-brand { font-size: 16px; font-weight: 800; color: #fff; letter-spacing: 1.8px; text-transform: uppercase; text-decoration: none; }
        .sidebar-user { padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 12px; }
        .sidebar-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--sage-light), var(--sage-dark)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: #fff; flex-shrink: 0; overflow: hidden; }
        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-name { font-size: 14px; font-weight: 600; color: #fff; }
        .sidebar-user-role { font-size: 11px; color: var(--sage-light); font-weight: 500; margin-top: 2px; }
        .sidebar-nav { flex: 1; padding: 16px 12px; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: rgba(255,255,255,0.35); padding: 12px 12px 6px; }
        .nav-item { display: flex; align-items: center; gap: 11px; padding: 11px 12px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500; margin-bottom: 2px; transition: background .2s, color .2s; }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: rgba(255,255,255,0.15); color: #fff; font-weight: 600; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout { display: flex; align-items: center; gap: 10px; width: 100%; padding: 11px 12px; border-radius: 10px; border: none; background: rgba(229,115,115,0.15); color: #ef9a9a; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500; cursor: pointer; }
        .btn-logout:hover { background: rgba(229,115,115,0.3); color: #ef5350; }

        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 32px; height: 68px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .topbar-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-light); }
        .topbar-breadcrumb a { color: var(--text-light); text-decoration: none; }
        .topbar-breadcrumb a:hover { color: var(--sage-deeper); }
        .topbar-breadcrumb span:last-child { color: var(--text-dark); font-weight: 600; }

        .page-body { padding: 32px 36px; max-width: 860px; }

        .detail-grid { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }

        .card { background: var(--white); border-radius: var(--radius); box-shadow: var(--card-shadow); overflow: hidden; margin-bottom: 20px; }
        .card-header { padding: 16px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
        .card-header-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; }
        .card-title { font-size: 14px; font-weight: 700; }
        .card-body { padding: 20px 24px; }

        .info-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--border); }
        .info-row:last-child { border-bottom: none; }
        .info-key { font-size: 12px; color: var(--text-light); font-weight: 500; }
        .info-val { font-size: 13px; font-weight: 600; color: var(--text-dark); text-align: right; }

        .badge { display: inline-flex; align-items: center; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
        .badge-pending   { background: #FFF8E1; color: #F57F17; }
        .badge-confirmed { background: #E3F2FD; color: #1565C0; }
        .badge-active    { background: #E8F5E9; color: #2E7D32; }
        .badge-completed { background: #EDE7F6; color: #4527A0; }
        .badge-cancelled { background: #FFEBEE; color: #C62828; }

        .kos-cover { width: 100%; height: 140px; object-fit: cover; display: block; background: var(--sage-bg); }
        .kos-info-box { padding: 16px; }
        .kos-name-big { font-size: 15px; font-weight: 700; margin-bottom: 4px; }
        .kos-loc { font-size: 12px; color: var(--text-light); display: flex; align-items: center; gap: 4px; }

        .user-block { display: flex; align-items: center; gap: 12px; }
        .user-ava { width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, var(--sage-light), var(--sage-dark)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px; color: #fff; flex-shrink: 0; overflow: hidden; }
        .user-ava img { width: 100%; height: 100%; object-fit: cover; }

        /* Action buttons */
        .action-bar { display: flex; flex-direction: column; gap: 8px; margin-top: 4px; }
        .btn-full { width: 100%; padding: 10px 16px; border-radius: 10px; border: 1.5px solid; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; }
        .btn-confirm  { border-color: #BBDEFB; color: #1565C0; background: #E3F2FD; }
        .btn-confirm:hover  { background: #BBDEFB; }
        .btn-complete { border-color: #C8E6C9; color: #2E7D32; background: #E8F5E9; }
        .btn-complete:hover { background: #C8E6C9; }
        .btn-cancel-bk { border-color: #FFCDD2; color: #C62828; background: #FFEBEE; }
        .btn-cancel-bk:hover { background: #FFCDD2; }
        .btn-back { border-color: var(--border); color: var(--text-mid); background: var(--white); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; border-radius: 10px; border: 1.5px solid; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; transition: all .2s; }
        .btn-back:hover { border-color: var(--sage-light); color: var(--sage-deeper); }

        .status-done-note { padding: 12px 16px; border-radius: 10px; font-size: 12px; text-align: center; margin-top: 4px; }
        .status-done-note.completed { background: #EDE7F6; color: #4527A0; }
        .status-done-note.cancelled  { background: #FFEBEE; color: #C62828; }
    </style>
</head>
<body>
@include('owner.partials.sidebar')

<div class="main">
    <header class="topbar">
        <div class="topbar-breadcrumb">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            <a href="{{ route('owner.booking.index') }}">Booking</a>
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Detail #{{ $booking->id }}</span>
        </div>
    </header>

    <div class="page-body">
        @php $sl = $booking->status_label; @endphp

        <div class="detail-grid">
            {{-- LEFT: detail info --}}
            <div>
                {{-- Booking info --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon" style="background:#F3E5F5;">
                            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#7B1FA2" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        </div>
                        <div class="card-title">Informasi Booking</div>
                        <span class="badge {{ $sl['class'] }}" style="margin-left:auto;">{{ $sl['label'] }}</span>
                    </div>
                    <div class="card-body">
                        <div class="info-row">
                            <span class="info-key">ID Booking</span>
                            <span class="info-val">#{{ $booking->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-key">Tanggal Sewa Mulai</span>
                            <span class="info-val">{{ $booking->tanggal_sewa ? $booking->tanggal_sewa->format('d F Y') : '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-key">Durasi</span>
                            <span class="info-val">{{ $booking->durasi ? $booking->durasi . ' bulan' : '-' }}</span>
                        </div>
                        @if($booking->tanggal_sewa && $booking->durasi)
                        <div class="info-row">
                            <span class="info-key">Perkiraan Selesai</span>
                            <span class="info-val">{{ $booking->tanggal_sewa->addMonths($booking->durasi)->format('d F Y') }}</span>
                        </div>
                        @endif
                        <div class="info-row">
                            <span class="info-key">Total Biaya</span>
                            <span class="info-val" style="font-size:15px;color:var(--sage-deeper);">
                                {{ $booking->total ? 'Rp ' . number_format($booking->total, 0, ',', '.') : '-' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-key">Dibuat</span>
                            <span class="info-val">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Penyewa info --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon" style="background:var(--sage-bg);">
                            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="var(--sage-deeper)" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="card-title">Data Penyewa</div>
                    </div>
                    <div class="card-body">
                        <div class="user-block" style="margin-bottom:16px;">
                            <div class="user-ava">
                                @if($booking->user->avatar ?? null)
                                    <img src="{{ asset('storage/' . $booking->user->avatar) }}" alt="">
                                @else
                                    {{ strtoupper(substr($booking->user->name ?? 'U', 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <div style="font-size:15px;font-weight:700;">{{ $booking->user->name ?? '-' }}</div>
                                <div style="font-size:12px;color:var(--text-light);margin-top:2px;">{{ $booking->user->email ?? '-' }}</div>
                            </div>
                        </div>
                        @if($booking->user->phone ?? null)
                        <div class="info-row">
                            <span class="info-key">No. HP</span>
                            <span class="info-val">{{ $booking->user->phone }}</span>
                        </div>
                        @endif
                        <div class="info-row">
                            <span class="info-key">Member sejak</span>
                            <span class="info-val">{{ $booking->user->created_at ? $booking->user->created_at->format('M Y') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: kos info + actions --}}
            <div>
                {{-- Kos --}}
                <div class="card" style="margin-bottom:16px;">
                    @if($booking->kos && $booking->kos->foto_utama)
                        <img src="{{ asset('storage/' . $booking->kos->foto_utama) }}" class="kos-cover" alt="">
                    @else
                        <div class="kos-cover" style="display:flex;align-items:center;justify-content:center;">
                            <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="rgba(74,107,80,0.3)" stroke-width="1.5"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/></svg>
                        </div>
                    @endif
                    <div class="kos-info-box">
                        <div class="kos-name-big">{{ $booking->kos->nama ?? '-' }}</div>
                        <div class="kos-loc">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $booking->kos->alamat ?? '-' }}
                        </div>
                        @if($booking->kos)
                        <div style="margin-top:10px;display:flex;gap:6px;flex-wrap:wrap;">
                            <span style="font-size:11px;padding:3px 10px;border-radius:20px;background:var(--sage-bg);color:var(--sage-deeper);font-weight:600;">{{ ucfirst($booking->kos->tipe) }}</span>
                            <span style="font-size:11px;padding:3px 10px;border-radius:20px;background:#FFF3D6;color:#B8860B;font-weight:600;">{{ $booking->kos->harga_format }}/bln</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Action panel --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Kelola Booking</div>
                    </div>
                    <div class="card-body">
                        <div class="action-bar">
                            @if($booking->status === 'pending')
                            <form method="POST" action="{{ route('owner.booking.updateStatus', $booking->id) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn-full btn-confirm" onclick="return confirm('Konfirmasi booking ini?')">
                                    ✅ Konfirmasi Booking
                                </button>
                            </form>
                            @endif

                            @if(in_array($booking->status, ['confirmed', 'active']))
                            <form method="POST" action="{{ route('owner.booking.updateStatus', $booking->id) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn-full btn-complete" onclick="return confirm('Tandai sebagai selesai?')">
                                    🏁 Tandai Selesai
                                </button>
                            </form>
                            @endif

                            @if(in_array($booking->status, ['pending', 'confirmed']))
                            <form method="POST" action="{{ route('owner.booking.updateStatus', $booking->id) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn-full btn-cancel-bk" onclick="return confirm('Batalkan booking ini?')">
                                    ✕ Tolak / Batalkan
                                </button>
                            </form>
                            @endif

                            @if(in_array($booking->status, ['completed', 'cancelled']))
                            <div class="status-done-note {{ $booking->status }}">
                                Booking ini sudah <strong>{{ $sl['label'] }}</strong> dan tidak dapat diubah lagi.
                            </div>
                            @endif

                            <a href="{{ route('owner.booking.index') }}" class="btn-back">
                                ← Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
