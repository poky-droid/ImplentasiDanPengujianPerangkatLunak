<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminKost — Masuk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --accent: #1E3A35;
            --accent-hover: #162e29;
            --font: 'Plus Jakarta Sans', sans-serif;
        }
        html, body {
            height: 100%;
            font-family: var(--font);
            background: #fff;
        }
        .login-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* LEFT PANEL */
        .login-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 64px 72px;
        }

        .login-greeting {
            font-size: 36px;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 40px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group { margin-bottom: 16px; }

        .form-input {
            width: 100%;
            padding: 14px 20px;
            border: 1.5px solid #e5e7eb;
            border-radius: 50px;
            font-size: 14.5px;
            font-family: var(--font);
            color: #1a1a1a;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(30,58,53,0.1);
        }
        .form-input.error { border-color: #ef4444; }

        .forgot-link {
            text-align: right;
            margin-bottom: 20px;
        }
        .forgot-link a {
            font-size: 13px;
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link a:hover { color: var(--accent); }

        .btn-masuk {
            width: 100%;
            padding: 15px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            font-family: var(--font);
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.2px;
        }
        .btn-masuk:hover {
            background: var(--accent-hover);
            box-shadow: 0 6px 20px rgba(30,58,53,0.3);
            transform: translateY(-1px);
        }
        .btn-masuk:active { transform: none; }

        .register-link {
            margin-top: 20px;
        }
        .register-link a {
            font-size: 13.5px;
            color: #6b7280;
            text-decoration: underline;
            text-underline-offset: 2px;
            transition: color 0.2s;
        }
        .register-link a:hover { color: var(--accent); }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* RIGHT PANEL */
        .login-right {
            position: relative;
            overflow: hidden;
            background: #f0f7f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .right-illustration {
            width: 100%;
            max-width: 560px;
            height: 100%;
            max-height: 680px;
            border-radius: 28px;
            object-fit: cover;
            box-shadow: 0 24px 80px rgba(0,0,0,0.12);
        }

        /* House SVG illustration fallback */
        .house-illustration {
            width: 100%;
            max-width: 500px;
        }

        @media (max-width: 768px) {
            .login-layout { grid-template-columns: 1fr; }
            .login-right { display: none; }
            .login-left { padding: 48px 32px; }
        }
    </style>
</head>
<body>
<div class="login-layout">

    <!-- LEFT: FORM -->
    <div class="login-left">
        <h1 class="login-greeting">Selamat datang 👋</h1>

        @if($errors->any())
            <div class="alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                    placeholder="jawirsexa@gmail.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>
            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                    placeholder="••••••••••"
                    required
                >
            </div>
            <div class="forgot-link">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>
            <button type="submit" class="btn-masuk">Masuk</button>
        </form>

        <div class="register-link">
            <a href="{{ route('register') }}">Belum punya akun?</a>
        </div>
    </div>

    <!-- RIGHT: ILLUSTRATION -->
    <div class="login-right">
        <svg class="house-illustration" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Sky background -->
            <rect width="500" height="500" rx="28" fill="#e8f5f0"/>
            <!-- Clouds -->
            <ellipse cx="80" cy="80" rx="40" ry="22" fill="white" opacity="0.7"/>
            <ellipse cx="110" cy="70" rx="35" ry="20" fill="white" opacity="0.6"/>
            <ellipse cx="380" cy="60" rx="50" ry="25" fill="white" opacity="0.6"/>
            <ellipse cx="420" cy="52" rx="35" ry="18" fill="white" opacity="0.5"/>
            <!-- Birds -->
            <path d="M160 100 Q165 94 170 100" stroke="#5a8a7a" stroke-width="1.5" fill="none"/>
            <path d="M175 95 Q180 89 185 95" stroke="#5a8a7a" stroke-width="1.5" fill="none"/>
            <path d="M300 80 Q305 74 310 80" stroke="#5a8a7a" stroke-width="1.5" fill="none"/>
            <!-- Ground -->
            <rect x="0" y="380" width="500" height="120" rx="0" fill="#c8e6c0"/>
            <!-- Path -->
            <path d="M200 500 L230 380 L270 380 L300 500 Z" fill="#b5c9a1"/>
            <!-- House body -->
            <rect x="120" y="220" width="260" height="180" rx="6" fill="white"/>
            <!-- Roof -->
            <polygon points="100,225 250,100 400,225" fill="#1E3A35"/>
            <!-- Roof detail -->
            <polygon points="115,220 250,108 385,220" fill="#254d45"/>
            <!-- Balcony floor 1 -->
            <rect x="290" y="285" width="90" height="5" rx="2" fill="#1E3A35"/>
            <!-- Balcony railing -->
            <rect x="290" y="250" width="2" height="40" fill="#1E3A35"/>
            <rect x="305" y="255" width="2" height="35" fill="#1E3A35"/>
            <rect x="320" y="255" width="2" height="35" fill="#1E3A35"/>
            <rect x="335" y="255" width="2" height="35" fill="#1E3A35"/>
            <rect x="350" y="255" width="2" height="35" fill="#1E3A35"/>
            <rect x="365" y="255" width="2" height="35" fill="#1E3A35"/>
            <rect x="378" y="250" width="2" height="40" fill="#1E3A35"/>
            <!-- Windows floor 1 -->
            <rect x="135" y="255" width="80" height="70" rx="5" fill="#b2d8d0"/>
            <rect x="140" y="260" width="35" height="60" rx="3" fill="#8ac4bc"/>
            <rect x="178" y="260" width="35" height="60" rx="3" fill="#8ac4bc"/>
            <!-- Windows floor 2 (above) -->
            <rect x="135" y="155" width="70" height="55" rx="5" fill="#b2d8d0"/>
            <rect x="295" y="155" width="70" height="55" rx="5" fill="#b2d8d0"/>
            <!-- Main door -->
            <rect x="200" y="315" width="60" height="85" rx="5" fill="#8B5E3C"/>
            <circle cx="252" cy="358" r="4" fill="#d4a96a"/>
            <!-- Light fixtures -->
            <circle cx="155" cy="238" r="6" fill="#f5d060" opacity="0.9"/>
            <circle cx="345" cy="238" r="6" fill="#f5d060" opacity="0.9"/>
            <!-- Trees left -->
            <rect x="55" y="330" width="12" height="60" fill="#5a3e28"/>
            <ellipse cx="61" cy="300" rx="34" ry="44" fill="#2d7a4e"/>
            <ellipse cx="61" cy="290" rx="26" ry="36" fill="#349158"/>
            <!-- Trees right -->
            <rect x="420" y="340" width="12" height="50" fill="#5a3e28"/>
            <ellipse cx="426" cy="310" rx="30" ry="40" fill="#2d7a4e"/>
            <ellipse cx="426" cy="300" rx="22" ry="32" fill="#349158"/>
            <!-- Small plant pots on balcony -->
            <rect x="362" y="275" width="14" height="10" rx="2" fill="#c8834b"/>
            <ellipse cx="369" cy="270" rx="8" ry="10" fill="#2d7a4e"/>
            <!-- City silhouette in background -->
            <rect x="350" y="200" width="20" height="120" fill="#c8e0d8" opacity="0.5"/>
            <rect x="375" y="220" width="16" height="100" fill="#c8e0d8" opacity="0.5"/>
            <rect x="395" y="210" width="22" height="110" fill="#c8e0d8" opacity="0.4"/>
            <!-- Bushes at base -->
            <ellipse cx="100" cy="383" rx="50" ry="20" fill="#3a9e5f"/>
            <ellipse cx="400" cy="383" rx="50" ry="20" fill="#3a9e5f"/>
            <ellipse cx="250" cy="385" rx="30" ry="12" fill="#2d7a4e"/>
        </svg>
    </div>

</div>
</body>
</html>
