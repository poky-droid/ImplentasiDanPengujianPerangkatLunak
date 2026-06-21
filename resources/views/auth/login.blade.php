<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Masuk - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage-deeper: #3A5540;
            --sage-dark:   #4A6B50;
            --sage-light:  #A8C5AC;
            --sage-bg:     #EDF3EE;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
            --text-mid:    #4A5C4D;
            --text-light:  #9AA89D;
            --border:      #D8E4DA;
            --radius:      50px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.10);
            display: flex;
            width: 100%;
            max-width: 780px;
            min-height: 460px;
            overflow: hidden;
        }

        /* ─── LEFT FORM ─── */
        .form-side {
            flex: 1;
            padding: 52px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .greeting {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--sage-bg);
            border: 1.5px solid var(--sage-light);
            color: var(--sage-deeper);
            font-size: 12px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 24px;
            cursor: pointer;
            transition: background .2s;
            width: fit-content;
        }
        .role-badge:hover { background: #d9ead9; }
        .role-badge svg { flex-shrink: 0; }

        .form-group { margin-bottom: 14px; }

        .form-input {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            padding: 13px 20px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: border-color .2s;
            background: var(--white);
        }
        .form-input::placeholder { color: var(--text-light); }
        .form-input:focus { border-color: var(--sage-dark); }

        .forgot-wrap {
            text-align: right;
            margin-bottom: 20px;
            margin-top: 4px;
        }
        .forgot-wrap a {
            font-size: 12px;
            color: var(--text-light);
            text-decoration: none;
            transition: color .2s;
        }
        .forgot-wrap a:hover { color: var(--sage-dark); }

        .btn-submit {
            width: 100%;
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            padding: 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .15s;
            margin-bottom: 16px;
        }
        .btn-submit:hover { background: var(--sage-dark); transform: translateY(-1px); }

        .register-link {
            font-size: 13px;
            color: var(--text-light);
            text-decoration: none;
            transition: color .2s;
        }
        .register-link:hover { color: var(--sage-dark); }

        /* Error */
        .alert-error {
            background: #fff0f0;
            border: 1px solid #f5c0c0;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 13px;
            color: #c0516a;
            margin-bottom: 18px;
        }

        /* ─── RIGHT ILLUSTRATION ─── */
        .illustration-side {
            width: 360px;
            flex-shrink: 0;
            background: linear-gradient(160deg, #e8f5e9 0%, #c8e6c9 50%, #a5d6a7 100%);
            border-radius: 20px;
            margin: 16px 16px 16px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .illustration-side svg {
            width: 100%;
            height: 100%;
            position: absolute;
            inset: 0;
        }

        .house-wrap {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ─── ROLE POPUP ─── */
        #role-popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn .25s ease;
            backdrop-filter: blur(2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .role-popup {
            background: var(--white);
            border-radius: 24px;
            padding: 48px 44px 44px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
            min-width: 340px;
            max-width: 440px;
            width: 90%;
            animation: slideUp .3s ease;
            position: relative;
        }

        .popup-back {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--text-light);
            cursor: pointer;
            text-decoration: none;
            transition: color .2s;
            background: none;
            border: none;
            font-family: 'DM Sans', sans-serif;
        }
        .popup-back:hover { color: var(--sage-deeper); }

        .popup-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 32px;
            letter-spacing: 0.2px;
        }

        .popup-roles {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .popup-role-btn {
            flex: 1;
            min-width: 120px;
            border: 2px solid var(--border);
            border-radius: 16px;
            padding: 20px 16px;
            background: var(--white);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            transition: border-color .25s, background .25s, transform .2s, box-shadow .2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }
        .popup-role-btn:hover {
            border-color: var(--sage-deeper);
            background: var(--sage-bg);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(58,85,64,0.15);
        }
        .popup-role-btn.selected {
            border-color: var(--sage-deeper);
            background: var(--sage-bg);
        }
        .popup-role-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon-owner { background: linear-gradient(135deg, #c8e6c9, #81c784); }
        .icon-pencari { background: linear-gradient(135deg, #b3e5fc, #4fc3f7); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .illustration-side { display: none; }
            .form-side { padding: 40px 28px; }
        }
    </style>
</head>
<body>

<!-- ══════════════════ ROLE SELECTION POPUP ══════════════════ -->
<div id="role-popup-overlay">
    <div class="role-popup" role="dialog" aria-modal="true" aria-labelledby="popup-title">
        <a href="{{ url()->previous() }}" class="popup-back">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>

        <div class="popup-title" id="popup-title">Pilihan login</div>

        <div class="popup-roles">
            <button
                id="btn-pemilik"
                class="popup-role-btn"
                onclick="selectRole('owner')"
                aria-label="Login sebagai Pemilik Kos"
            >
                <div class="popup-role-icon icon-owner">
                    <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#2E7D32" stroke-width="1.8">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                </div>
                Pemilik kos
            </button>

            <button
                id="btn-pencari"
                class="popup-role-btn"
                onclick="selectRole('pencari')"
                aria-label="Login sebagai Pencari Kos"
            >
                <div class="popup-role-icon icon-pencari">
                    <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#0277bd" stroke-width="1.8">
                        <circle cx="11" cy="11" r="7"/>
                        <line x1="16.5" y1="16.5" x2="22" y2="22"/>
                    </svg>
                </div>
                Pencari kos
            </button>
        </div>
    </div>
</div>

<!-- ══════════════════ LOGIN CARD ══════════════════ -->
<div class="card">

    <!-- FORM SIDE -->
    <div class="form-side">
        <div class="greeting">Selamat datang 👋</div>

        <!-- Role badge — klik untuk ganti role -->
        <div class="role-badge" id="role-badge-display" onclick="showRolePopup()" title="Klik untuk ganti role">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            <span id="role-badge-text">Pilih Role</span>
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </div>

        {{-- Error message --}}
        @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf
            <input type="hidden" name="role" id="role-input" value="">

            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    class="form-input"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    class="form-input"
                    placeholder="Password"
                    required
                >
            </div>

            <div class="forgot-wrap">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>

            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <a href="{{ route('register') }}" class="register-link" id="register-link">Belum punya akun?</a>
    </div>

    <!-- ILLUSTRATION SIDE -->
    <div class="illustration-side">
        <img src="{{ asset('images/illustration.png') }}" alt="Rumantra" style="width:100%; height:100%; object-fit:cover; display:block;">
    </div>

</div>

@if(session('registered'))
    <div id="popup-overlay" style="position:fixed; inset:0; background:rgba(0,0,0,0.4); display:flex; align-items:center; justify-content:center; z-index:9999;">
        <div style="background:#fff; border-radius:20px; padding:48px 40px; text-align:center;box-shadow:0 8px 40px rgba(0,0,0,0.15); min-width:300px;">
            <div style="width:72px; height:72px; background:#4CAF50; border-radius:50%; display:flex;align-items:center; justify-content:center; margin:0 auto 20px;">
             <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3">
            <polyline points="20 6 9 17 4 12"/>
        </svg>
    </div>
        <p style="font-family:'DM Sans',sans-serif; font-size:16px; font-weight:600; color:#1E2D22;">Berhasil Melakukan Registrasi</p>
    </div>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('popup-overlay').style.display = 'none';
        }, 2500);
    </script>
@endif

<script>
    // ── Role management ──────────────────────────────────────────
    let selectedRole = '';

    const roleLabels = {
        owner:   { text: 'Pemilik Kos', icon: '🏠' },
        pencari: { text: 'Pencari Kos', icon: '🔍' },
    };

    function selectRole(role) {
        selectedRole = role;
        document.getElementById('role-input').value = role;

        // Update badge
        const badge = roleLabels[role];
        document.getElementById('role-badge-text').textContent = badge.icon + ' ' + badge.text;

        // Update register link with role param
        const registerBase = "{{ route('register') }}";
        document.getElementById('register-link').href = registerBase + '?role=' + role;

        // Close popup
        closePopup();
    }

    function showRolePopup() {
        const overlay = document.getElementById('role-popup-overlay');
        overlay.style.display = 'flex';
        overlay.querySelector('.role-popup').style.animation = 'slideUp .3s ease';
    }

    function closePopup() {
        const overlay = document.getElementById('role-popup-overlay');
        overlay.style.opacity = '0';
        overlay.style.transition = 'opacity .2s ease';
        setTimeout(() => {
            overlay.style.display = 'none';
            overlay.style.opacity = '';
            overlay.style.transition = '';
        }, 200);
    }

    // Close popup when clicking backdrop
    document.getElementById('role-popup-overlay').addEventListener('click', function(e) {
        if (e.target === this && selectedRole !== '') {
            closePopup();
        }
    });

    // Close on Escape only if a role is already selected
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && selectedRole !== '') closePopup();
    });
</script>
</body>
</html>