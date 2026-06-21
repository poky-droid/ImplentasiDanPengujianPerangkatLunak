<!-- SIDEBAR OVERLAY -->
<div id="sidebar-overlay" onclick="closeSidebar()" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:998;"></div>

<!-- SIDEBAR DRAWER -->
<div id="sidebar" style="
    position: fixed;
    top: 0; left: 0;
    width: 260px;
    height: 100vh;
    background: #2e4a38;
    z-index: 999;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 60px 32px 40px;
    transform: translateX(-100%);
    transition: transform .3s ease;
    font-family: 'DM Sans', sans-serif;
">
    <!-- Menu Links -->
    <div style="display:flex; flex-direction:column; gap:28px;">
        <a href="/profile" style="color:#fff; text-decoration:none; font-size:16px; font-weight:500; transition:opacity .2s;" onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">Profile</a>
        <a href="{{ route('booking.history') }}" style="color:#fff; text-decoration:none; font-size:16px; font-weight:500; transition:opacity .2s;" onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">Transaksi History</a>
        <a href="/syarat-ketentuan" style="color:#fff; text-decoration:none; font-size:16px; font-weight:500; transition:opacity .2s;" onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">Syarat & Ketentuan</a>
        <a href="/bantuan" style="color:#fff; text-decoration:none; font-size:16px; font-weight:500; transition:opacity .2s;" onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">Bantuan</a>
    </div>

    <!-- Bottom: Login / Logout -->
    <div>
        @guest
            <a href="{{ route('login') }}" style="
                display: block;
                text-align: center;
                background: #f5f5f5;
                color: #1E2D22;
                text-decoration: none;
                border-radius: 20px;
                padding: 12px;
                font-size: 14px;
                font-weight: 600;
                transition: background .2s;
            " onmouseover="this.style.background='#e0e0e0'" onmouseout="this.style.background='#f5f5f5'">Login</a>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="
                    width: 100%;
                    text-align: center;
                    background: #f5f5f5;
                    color: #1E2D22;
                    border: none;
                    border-radius: 20px;
                    padding: 12px;
                    font-family: 'DM Sans', sans-serif;
                    font-size: 14px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background .2s;
                " onmouseover="this.style.background='#e0e0e0'" onmouseout="this.style.background='#f5f5f5'">Logout</button>
            </form>
        @endguest
    </div>
</div>

<script>
    function openSidebar() {
        document.getElementById('sidebar').style.transform = 'translateX(0)';
        document.getElementById('sidebar-overlay').style.display = 'block';
    }
    function closeSidebar() {
        document.getElementById('sidebar').style.transform = 'translateX(-100%)';
        document.getElementById('sidebar-overlay').style.display = 'none';
    }
</script>