<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Rumantra">
        </div>
        <a href="{{ route('owner.dashboard') }}" class="sidebar-brand">Rumantra</a>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">
            @if(auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="sidebar-user-info">
            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-user-role">🏠 Pemilik Kos</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>

        <a href="{{ route('owner.dashboard') }}" class="nav-item {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('owner.kos.index') }}" class="nav-item {{ request()->routeIs('owner.kos.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                <path d="M9 21V12h6v9"/>
            </svg>
            Kelola Kos
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Manajemen</div>

        <a href="{{ route('owner.booking.index') }}" class="nav-item {{ request()->routeIs('owner.booking.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            Booking
            @php
                // Count pending bookings specifically for the owner's kos
                if (auth()->check()) {
                    $pendingBookings = \App\Models\Booking::whereHas('kos', function($q) {
                        $q->where('owner_id', auth()->id());
                    })->where('status', 'pending')->count();
                } else {
                    $pendingBookings = 0;
                }
            @endphp
            @if($pendingBookings > 0)
                <span class="nav-badge" style="margin-left: auto; background: #C9A84C; color: #3A5540; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 10px;">{{ $pendingBookings }}</span>
            @endif
        </a>

        <a href="{{ route('owner.pembayaran.index') }}" class="nav-item {{ request()->routeIs('owner.pembayaran.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="2" y="5" width="20" height="14" rx="2"/>
                <line x1="2" y1="10" x2="22" y2="10"/>
            </svg>
            Pembayaran
            @php
                $pendingPaymentsCount = auth()->check() ? \App\Models\Pembayaran::where('status_pembayaran', 'pending')
                    ->whereHas('kos', function($q) {
                        $q->where('owner_id', auth()->id());
                    })
                    ->count() : 0;
            @endphp
            @if($pendingPaymentsCount > 0)
                <span class="nav-badge" style="margin-left: auto; background: #C9A84C; color: #3A5540; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 10px;">{{ $pendingPaymentsCount }}</span>
            @endif
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Komunikasi</div>

        <a href="{{ route('owner.notifications') }}" class="nav-item {{ request()->routeIs('owner.notifications') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            Notifikasi
            @php
                $navUnreadCount = auth()->check() ? \App\Models\OwnerNotification::forOwner(auth()->id())->unread()->count() : 0;
            @endphp
            @if($navUnreadCount > 0)
                <span class="nav-badge" style="margin-left: auto; background: #C9A84C; color: #3A5540; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 10px;">{{ $navUnreadCount }}</span>
            @endif
        </a>

        <a href="{{ route('owner.messages.inbox') }}" class="nav-item {{ request()->routeIs('owner.messages.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            Pesan
            @php
                $navUnreadMessagesCount = auth()->check() ? \App\Models\Chat::where('receiver_id', auth()->id())
                    ->whereHas('kos', function($q) {
                        $q->where('owner_id', auth()->id());
                    })
                    ->where('dibaca', 0)
                    ->count() : 0;
            @endphp
            @if($navUnreadMessagesCount > 0)
                <span class="nav-badge" style="margin-left: auto; background: #C9A84C; color: #3A5540; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 10px;">{{ $navUnreadMessagesCount }}</span>
            @endif
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Akun</div>

        <a href="{{ route('profile.index') }}" class="nav-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profil Saya
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
