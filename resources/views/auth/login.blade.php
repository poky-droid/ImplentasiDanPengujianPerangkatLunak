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
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

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

        /* House illustration drawn with SVG */
        .house-wrap {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .illustration-side { display: none; }
            .form-side { padding: 40px 28px; }
        }
    </style>
</head>
<body>

<div class="card">

    <!-- FORM SIDE -->
    <div class="form-side">
        <div class="greeting">Selamat datang 👋</div>

        {{-- Error message --}}
        @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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

        <a href="{{ route('register') }}" class="register-link">Belum punya akun?</a>
    </div>

     <!-- ILLUSTRATION SIDE -->
    <div class="illustration-side">
        <img src="{{ asset('images/illustration.png') }}" alt="Rumantra" style="width:100%; height:100%; object-fit:cover; display:block;">
    </div>

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
</body>
</html>