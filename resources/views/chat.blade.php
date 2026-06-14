<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Rumantra</title>
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
            --pink-bg:     #f5e8e8;
            --pink-stripe: #ecd6d6;
            --bubble-out:  #d4c8c8;   /* bubble pesan keluar (user) */
            --bubble-in:   #ffffff;   /* bubble pesan masuk (pemilik) */
            --header-bg:   #3d4a44;   /* header chat gelap */
            --sidebar-active: #3A5540;
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
            width: 44px; height: 44px; border-radius: 50%;
            border: 2px solid var(--sage-light); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: 2px;
        }
        .brand-name {
            font-size: 17px; font-weight: 700; color: var(--text-dark);
            letter-spacing: 1.5px; text-transform: uppercase;
        }
        .search-wrap {
            flex: 1; max-width: 480px; margin: 0 32px;
            display: flex; align-items: center; background: var(--white);
            border: 1.5px solid rgba(107,143,113,0.25); border-radius: 24px; overflow: hidden;
        }
        .search-wrap input {
            flex: 1; border: none; outline: none; padding: 10px 18px;
            font-family: 'DM Sans', sans-serif; font-size: 13px;
            color: var(--text-dark); background: transparent;
        }
        .search-wrap input::placeholder { color: var(--text-light); }
        .btn-filter {
            display: flex; align-items: center; gap: 6px;
            background: var(--sage-deeper); color: #fff; border: none;
            padding: 10px 18px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; cursor: pointer; white-space: nowrap;
        }
        .btn-filter:hover { background: var(--sage-dark); }
        .navbar-right { display: flex; align-items: center; gap: 20px; }
        .nav-icon { color: var(--text-mid); cursor: pointer; display: flex; align-items: center; transition: color .2s; }
        .nav-icon:hover { color: var(--sage-deeper); }

        /* ─── CHAT LAYOUT ─────────────────────────────────── */
        .chat-wrapper {
            display: grid;
            grid-template-columns: 280px 1fr;
            height: calc(100vh - 64px);
            overflow: hidden;
        }

        /* ─── SIDEBAR ─────────────────────────────────────── */
        .chat-sidebar {
            background: var(--pink-bg);
            border-right: 1px solid rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            overflow: hidden;

            /* Stripe dekoratif vertikal */
            background-image: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 28px,
                rgba(180,150,150,0.12) 28px,
                rgba(180,150,150,0.12) 32px
            );
            background-color: #f5e8e8;
        }

        .sidebar-header {
            padding: 20px 20px 12px;
        }

        .btn-pesan {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--sidebar-active);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .conversation-list {
            flex: 1;
            overflow-y: auto;
            padding: 8px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .conv-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: background .2s;
            text-decoration: none;
            color: var(--text-dark);
        }
        .conv-item:hover { background: rgba(255,255,255,0.5); }
        .conv-item.active {
            background: var(--sidebar-active);
            color: #fff;
        }

        .conv-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: #c9b8b8;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }
        .conv-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .conv-avatar svg { opacity: 0.6; }

        .conv-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .conv-item.active .conv-name { color: #fff; }

        /* ─── CHAT MAIN ────────────────────────────────────── */
        .chat-main {
            display: flex;
            flex-direction: column;
            background-image: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 28px,
                rgba(180,150,150,0.10) 28px,
                rgba(180,150,150,0.10) 32px
            );
            background-color: #f5e8e8;
            overflow: hidden;
        }

        /* Header chat */
        .chat-header {
            background: var(--header-bg);
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 24px;
            border-radius: 0 0 0 0;
            flex-shrink: 0;
        }

        .chat-header-avatar {
            width: 42px; height: 42px;
            border-radius: 50%;
            background: #8a9e8d;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .chat-header-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .chat-header-info { flex: 1; }
        .chat-header-name {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
        }
        .chat-header-status {
            font-size: 12px;
            color: rgba(255,255,255,0.65);
            margin-top: 2px;
        }
        .status-dot {
            display: inline-block;
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #4caf50;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* Bubbles area */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            scroll-behavior: smooth;
        }

        .msg-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
        }
        .msg-row.out {
            flex-direction: row-reverse;
        }

        .msg-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: #c9b8b8;
            flex-shrink: 0;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .msg-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .msg-bubble {
            max-width: 56%;
            padding: 11px 16px;
            border-radius: 18px;
            font-size: 13.5px;
            line-height: 1.55;
            word-break: break-word;
        }
        .msg-row.in .msg-bubble {
            background: var(--bubble-in);
            color: var(--text-dark);
            border-bottom-left-radius: 4px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        .msg-row.out .msg-bubble {
            background: var(--bubble-out);
            color: var(--text-dark);
            border-bottom-right-radius: 4px;
        }

        .msg-time {
            font-size: 10px;
            color: var(--text-light);
            margin-top: 4px;
            text-align: right;
        }
        .msg-row.in .msg-time { text-align: left; padding-left: 36px; }
        .msg-row.out .msg-time { text-align: right; padding-right: 36px; }

        /* Input area */
        .chat-input-wrap {
            flex-shrink: 0;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-input {
            flex: 1;
            background: rgba(255,255,255,0.65);
            border: none;
            border-radius: 24px;
            padding: 13px 20px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            color: var(--text-dark);
            outline: none;
            backdrop-filter: blur(4px);
        }
        .chat-input::placeholder { color: #b0a0a0; }

        .btn-send {
            width: 46px; height: 46px;
            border-radius: 50%;
            background: var(--header-bg);
            border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: background .2s, transform .15s;
        }
        .btn-send:hover { background: #2e3830; transform: scale(1.05); }
        .btn-send svg { color: #fff; }

        /* ─── RESPONSIVE ──────────────────────────────────── */
        @media (max-width: 720px) {
            .chat-wrapper { grid-template-columns: 1fr; }
            .chat-sidebar { display: none; }
            .navbar .search-wrap { display: none; }
        }
    </style>
</head>
<body>

<!-- ══════════════════ NAVBAR ══════════════════ -->
<nav class="navbar">
    <div class="navbar-left">
        <div class="hamburger">
            <span></span><span></span><span></span>
        </div>
        <a href="/" class="brand-wrap">
            <div class="brand-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Rumantra" width="36" height="36" style="object-fit:contain;">
            </div>
            <span class="brand-name">Rumantra</span>
        </a>
    </div>

    <div class="search-wrap">
        <input type="text" placeholder="cari berdasarkan lokasi, lingkungan">
        <button class="btn-filter">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
            </svg>
            Filter
        </button>
    </div>

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
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </div>
    </div>
</nav>

<!-- ══════════════════ CHAT WRAPPER ══════════════════ -->
<div class="chat-wrapper">

    <!-- ── SIDEBAR KIRI ── -->
    <aside class="chat-sidebar">
        <div class="sidebar-header">
            <button class="btn-pesan">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                Pesan
            </button>
        </div>

        <div class="conversation-list">
            {{-- Loop semua percakapan yang pernah ada --}}
            @forelse($conversations as $conv)
                @php
                    // Tentukan siapa "lawan bicara" — owner kos atau user biasa
                    $other = $conv->sender_id === Auth::id() ? $conv->receiver : $conv->sender;
                    $isActive = $conv->kos_id === $kos->id;
                @endphp
                <a href="{{ route('chat.index', $conv->kos_id) }}"
                   class="conv-item {{ $isActive ? 'active' : '' }}">
                    <div class="conv-avatar">
                        @if($other->foto ?? null)
                            <img src="{{ asset($other->foto) }}" alt="{{ $other->name }}">
                        @else
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        @endif
                    </div>
                    <span class="conv-name">{{ $conv->kos->nama ?? $other->name }}</span>
                </a>
            @empty
                {{-- Tidak ada percakapan lain, cukup tampilkan yang aktif --}}
                <div class="conv-item active">
                    <div class="conv-avatar">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <span class="conv-name">{{ $kos->nama }}</span>
                </div>
            @endforelse
        </div>
    </aside>

    <!-- ── CHAT MAIN ── -->
    <div class="chat-main">

        <!-- Header -->
        <div class="chat-header">
            <div class="chat-header-avatar">
                @if($receiver->foto ?? null)
                    <img src="{{ asset($receiver->foto) }}" alt="{{ $receiver->name }}">
                @else
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                @endif
            </div>
            <div class="chat-header-info">
                <div class="chat-header-name">{{ $kos->nama }}</div>
                <div class="chat-header-status">
                    <span class="status-dot"></span>Online
                </div>
            </div>
        </div>

        <!-- Bubbles -->
        <div class="chat-messages" id="chatMessages">
            @forelse($messages as $msg)
                @php $isOut = $msg->sender_id === Auth::id(); @endphp
                <div>
                    <div class="msg-row {{ $isOut ? 'out' : 'in' }}">
                        @if(!$isOut)
                            <div class="msg-avatar">
                                @if($receiver->foto ?? null)
                                    <img src="{{ asset($receiver->foto) }}" alt="">
                                @else
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                @endif
                            </div>
                        @endif
                        <div class="msg-bubble">{{ $msg->pesan }}</div>
                    </div>
                    <div class="msg-time">
                        {{ $msg->created_at->format('H:i') }}
                    </div>
                </div>
            @empty
                {{-- Kosong — tidak perlu pesan apapun, biarkan blank --}}
            @endforelse
        </div>

        <!-- Input kirim pesan -->
        <div class="chat-input-wrap">
            <form action="{{ route('chat.send') }}" method="POST" style="display:contents">
                @csrf
                <input type="hidden" name="kos_id"      value="{{ $kos->id }}">
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <input
                    type="text"
                    name="pesan"
                    class="chat-input"
                    placeholder="Ketik pesan..."
                    autocomplete="off"
                    required
                >
                <button type="submit" class="btn-send">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </form>
        </div>

    </div><!-- /chat-main -->
</div><!-- /chat-wrapper -->

<script>
    // Auto scroll ke bawah saat halaman load
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
</script>

</body>
</html>