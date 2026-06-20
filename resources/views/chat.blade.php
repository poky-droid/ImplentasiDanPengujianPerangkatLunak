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
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
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

        .search-form { flex: 1; max-width: 420px; margin: 0 32px; }
        .search-bar {
            display: flex; align-items: center;
            background: var(--white);
            border: 1.5px solid rgba(107,143,113,0.25);
            border-radius: 24px; overflow: hidden;
        }
        .search-bar input {
            flex: 1; border: none; outline: none;
            padding: 10px 16px;
            font-family: 'DM Sans', sans-serif; font-size: 13px;
            color: var(--text-dark); background: transparent;
        }
        .search-bar input::placeholder { color: var(--text-light); }
        .search-bar .btn-filter {
            display: flex; align-items: center; gap: 6px;
            background: var(--sage-deeper); color: #fff;
            border: none; padding: 10px 16px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            cursor: pointer; white-space: nowrap;
        }
        .navbar-right { display: flex; align-items: center; gap: 20px; }
        .nav-icon { color: var(--text-mid); cursor: pointer; transition: color .2s; display: flex; align-items: center; }
        .nav-icon:hover { color: var(--sage-deeper); }
        .nav-icon.active { color: var(--sage-deeper); }

        /* ─── CHAT LAYOUT ─── */
        .chat-wrapper {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* ─── SIDEBAR ─── */
        .chat-sidebar {
            width: 280px;
            flex-shrink: 0;
            background: var(--cream);
            padding: 20px 16px;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 12px;
            overflow-y: auto;
        }

        .btn-pesan {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            width: fit-content;
            margin-bottom: 4px;
        }

        .chat-list { display: flex; flex-direction: column; gap: 4px; }

        .chat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: background .2s;
        }
        .chat-item:hover { background: rgba(107,143,113,0.1); }
        .chat-item.active { background: var(--sage-deeper); }

        .chat-avatar {
            width: 42px; height: 42px;
            border-radius: 50%;
            border: 2px solid var(--sage-light);
            overflow: hidden; flex-shrink: 0;
            background: var(--sage-bg);
            display: flex; align-items: center; justify-content: center;
        }
        .chat-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .chat-avatar-initials { font-size: 14px; font-weight: 700; color: var(--sage-deeper); }

        .chat-item-info { flex: 1; min-width: 0; }
        .chat-item-name {
            font-size: 13px; font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .chat-item.active .chat-item-name { color: #fff; }
        .chat-item-last {
            font-size: 11px; color: var(--text-light);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            margin-top: 2px;
        }
        .chat-item.active .chat-item-last { color: rgba(255,255,255,0.7); }

        .chat-unread {
            width: 18px; height: 18px;
            border-radius: 50%;
            background: var(--sage-deeper);
            color: #fff;
            font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .chat-item.active .chat-unread { background: #fff; color: var(--sage-deeper); }

        .chat-empty-sidebar {
            font-size: 12px;
            color: var(--text-light);
            padding: 12px 8px;
            text-align: center;
        }

        /* ─── CHAT MAIN ─── */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--white);
            margin: 12px 16px 12px 0;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(74,107,80,0.08);
        }

        /* Chat header */
        .chat-header {
            background: var(--sage-deeper);
            border-radius: 16px 16px 0 0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .chat-header-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.4);
            overflow: hidden;
            background: var(--sage-bg);
            display: flex; align-items: center; justify-content: center;
        }
        .chat-header-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .chat-header-info { flex: 1; }
        .chat-header-name { font-size: 15px; font-weight: 700; color: #fff; }
        .chat-header-status {
            font-size: 12px; color: rgba(255,255,255,0.7);
            display: flex; align-items: center; gap: 4px; margin-top: 2px;
        }
        .status-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: #69f0ae;
        }

        /* Chat messages */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-track { background: transparent; }
        .chat-messages::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

        /* Date divider */
        .msg-date {
            text-align: center;
            font-size: 11px;
            color: var(--text-light);
            font-weight: 500;
            padding: 4px 0;
        }

        /* Message bubble */
        .msg-wrap {
            display: flex;
            gap: 8px;
            max-width: 70%;
        }
        .msg-wrap.sent { align-self: flex-end; flex-direction: row-reverse; }
        .msg-wrap.received { align-self: flex-start; }

        .msg-avatar {
            width: 30px; height: 30px;
            border-radius: 50%; flex-shrink: 0;
            background: var(--sage-bg);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: var(--sage-deeper);
        }
        .msg-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .msg-bubble {
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 13px;
            line-height: 1.5;
            word-break: break-word;
        }
        .msg-wrap.sent .msg-bubble {
            background: #e8f0ee;
            color: var(--text-dark);
            border-bottom-right-radius: 4px;
        }
        .msg-wrap.received .msg-bubble {
            background: var(--sage-bg);
            color: var(--text-dark);
            border-bottom-left-radius: 4px;
        }
        .msg-time {
            font-size: 10px;
            color: var(--text-light);
            margin-top: 4px;
            text-align: right;
        }
        .msg-wrap.received .msg-time { text-align: left; }

        /* Chat input */
        .chat-input-wrap {
            padding: 12px 16px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fafcfa;
            border-radius: 0 0 16px 16px;
        }
        .chat-input {
            flex: 1;
            border: none;
            outline: none;
            background: var(--cream);
            border-radius: 24px;
            padding: 11px 18px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            resize: none;
        }
        .chat-input::placeholder { color: var(--text-light); }
        .btn-send {
            width: 42px; height: 42px;
            border-radius: 50%;
            background: var(--sage-deeper);
            border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: background .2s, transform .15s;
        }
        .btn-send:hover { background: var(--sage-dark); transform: scale(1.05); }

        /* Empty state */
        .chat-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--text-light);
        }
        .chat-empty svg { opacity: 0.3; }
        .chat-empty p { font-size: 14px; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .chat-sidebar { width: 70px; padding: 16px 8px; }
            .chat-item-info { display: none; }
            .btn-pesan span { display: none; }
            .search-form { display: none; }
            .navbar { padding: 0 16px; }
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
        <div class="nav-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </div>
        <div class="nav-icon active">
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

<!-- CHAT WRAPPER -->
<div class="chat-wrapper">

    <!-- SIDEBAR CHAT LIST -->
    <div class="chat-sidebar">
        <button class="btn-pesan" type="button">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            <span>Pesan</span>
        </button>

        <div class="chat-list">
            @forelse($conversations as $conv)
                @php
                    // Tentukan siapa lawan bicara di percakapan ini
                    $lawan = $conv->sender_id === Auth::id() ? $conv->receiver : $conv->sender;
                @endphp
                <a href="{{ route('chat.index', $conv->kos_id) }}" style="text-decoration:none; color:inherit;">
                    <div class="chat-item {{ (int) $conv->kos_id === (int) $kos->id ? 'active' : '' }}">
                        <div class="chat-avatar">
                            <div class="chat-avatar-initials">
                                {{ strtoupper(substr($lawan->name ?? 'U', 0, 2)) }}
                            </div>
                        </div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">{{ $lawan->name ?? 'Pengguna' }}</div>
                            <div class="chat-item-last">{{ \Illuminate\Support\Str::limit($conv->pesan, 28) }}</div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="chat-empty-sidebar">Belum ada percakapan</div>
            @endforelse
        </div>
    </div>

    <!-- CHAT MAIN -->
    <div class="chat-main">

        <!-- Header -->
        <div class="chat-header">
            <div class="chat-header-avatar">
                <span style="font-size:16px;font-weight:700;color:var(--sage-deeper)">
                    {{ strtoupper(substr($receiver->name ?? 'U', 0, 2)) }}
                </span>
            </div>
            <div class="chat-header-info">
                <div class="chat-header-name">{{ $receiver->name ?? 'Pemilik Kos' }}</div>
                <div class="chat-header-status">
                    <div class="status-dot"></div>
                    Online
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="chat-messages" id="chat-messages">

            <div class="msg-date">Hari ini</div>

            @forelse($messages as $msg)
                @if($msg->sender_id === Auth::id())
                    <div class="msg-wrap sent">
                        <div>
                            <div class="msg-bubble">{{ $msg->pesan }}</div>
                            <div class="msg-time">{{ $msg->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                @else
                    <div class="msg-wrap received">
                        <div class="msg-avatar">
                            {{ strtoupper(substr($receiver->name ?? 'U', 0, 2)) }}
                        </div>
                        <div>
                            <div class="msg-bubble">{{ $msg->pesan }}</div>
                            <div class="msg-time">{{ $msg->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="chat-empty">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    <p>Belum ada pesan. Mulai percakapan sekarang.</p>
                </div>
            @endforelse

        </div>

        <!-- Input -->
        <form action="{{ route('chat.send') }}" method="POST" class="chat-input-wrap">
            @csrf
            <input type="hidden" name="kos_id" value="{{ $kos->id }}">
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <input
                type="text"
                name="pesan"
                class="chat-input"
                id="chat-input"
                placeholder="Ketik pesan..."
                required
                autocomplete="off"
            >
            <button type="submit" class="btn-send">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </form>

    </div>

</div>

<script>
    // Scroll otomatis ke pesan terbaru saat halaman dimuat
    const msgContainer = document.getElementById('chat-messages');
    if (msgContainer) {
        msgContainer.scrollTop = msgContainer.scrollHeight;
    }
</script>

</body>
</html>