<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Daftar - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage-deeper: #3A5540;
            --sage-dark:   #4A6B50;
            --sage-light:  #A8C5AC;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
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
            min-height: 520px;
            overflow: hidden;
        }

        /* ─── LEFT FORM ─── */
        .form-side {
            flex: 1;
            padding: 44px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 28px;
        }

        .form-group { margin-bottom: 12px; }

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
        .form-input.is-invalid { border-color: #e57373; }

        .invalid-msg {
            font-size: 11px;
            color: #e57373;
            margin-top: 4px;
            padding-left: 8px;
        }

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
            margin-top: 4px;
            margin-bottom: 14px;
        }
        .btn-submit:hover { background: var(--sage-dark); transform: translateY(-1px); }

        .login-link {
            font-size: 13px;
            color: var(--text-light);
            text-decoration: none;
            transition: color .2s;
        }
        .login-link:hover { color: var(--sage-dark); }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #f5c0c0;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 13px;
            color: #c0516a;
            margin-bottom: 16px;
        }

        /* ─── RIGHT ILLUSTRATION ─── */
        .illustration-side {
            width: 360px;
            flex-shrink: 0;
            border-radius: 20px;
            margin: 16px 16px 16px 0;
            overflow: hidden;
        }
        .illustration-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

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
        <div class="page-title">Daftar</div>

        @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="name"
                    class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    placeholder="Nama lengkap"
                    value="{{ old('name') }}" required>
                @error('name') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="email" name="email"
                    class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    placeholder="Email"
                    value="{{ old('email') }}" required>
                @error('email') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="tel" name="phone"
                    class="form-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                    placeholder="No telepon"
                    value="{{ old('phone') }}">
                @error('phone') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password"
                    class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Password" required>
                @error('password') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation"
                    class="form-input"
                    placeholder="Konfirmasi password" required>
            </div>

            <button type="submit" class="btn-submit">Daftar</button>
        </form>

        <a href="{{ route('login') }}" class="login-link">Sudah punya akun</a>
    </div>

    <!-- ILLUSTRATION SIDE -->
    <div class="illustration-side">
        <img src="{{ asset('images/illustration.png') }}" alt="Rumantra">
    </div>

</div>

</body>
</html>