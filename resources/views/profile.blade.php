<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Profile - Rumantra</title>
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
            --radius:      10px;
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
        .navbar-right { display: flex; align-items: center; gap: 20px; }
        .nav-icon { color: var(--text-mid); cursor: pointer; transition: color .2s; display: flex; align-items: center; }
        .nav-icon:hover { color: var(--sage-deeper); }

        /* ─── BACK BUTTON ─── */
        .back-wrap {
            max-width: 860px;
            margin: 0 auto;
            padding: 20px 24px 0;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
            color: var(--sage-deeper);
            text-decoration: none;
            transition: gap .2s;
        }
        .back-btn:hover { gap: 10px; }

        /* ─── MAIN ─── */
        .main {
            max-width: 860px;
            margin: 0 auto;
            padding: 20px 24px 60px;
        }

        .profile-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 48px 48px;
            box-shadow: 0 2px 20px rgba(74,107,80,0.08);
        }

        /* ─── AVATAR ─── */
        .avatar-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 36px;
        }
        .avatar-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid var(--sage-light);
            background: var(--sage-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .avatar-initials {
            font-size: 32px;
            font-weight: 700;
            color: var(--sage-deeper);
        }

        /* ─── FORM FIELDS ─── */
        .field-group {
            margin-bottom: 20px;
        }
        .field-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--sage-deeper);
            margin-bottom: 8px;
            display: block;
        }
        .field-value {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            padding: 13px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            background: var(--white);
            outline: none;
            transition: border-color .2s;
        }
        .field-value:focus { border-color: var(--sage-dark); }
        .field-value[readonly] {
            background: #f8faf8;
            color: var(--text-mid);
            cursor: default;
        }
        select.field-value {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238A9E8D' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
        }

        /* ─── ACTIONS ─── */
        .action-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 32px;
            gap: 12px;
        }
        .btn-edit {
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .15s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit:hover { background: var(--sage-dark); transform: translateY(-1px); }
        .btn-save {
            background: var(--sage-deeper);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            display: none;
        }
        .btn-save:hover { background: var(--sage-dark); }
        .btn-cancel {
            background: transparent;
            color: var(--text-mid);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 10px 24px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: border-color .2s;
            display: none;
        }
        .btn-cancel:hover { border-color: var(--sage-dark); color: var(--sage-dark); }

        /* Edit mode */
        body.edit-mode .field-value[readonly] {
            background: var(--white);
            color: var(--text-dark);
            cursor: text;
        }
        body.edit-mode .btn-edit { display: none; }
        body.edit-mode .btn-save { display: inline-block; }
        body.edit-mode .btn-cancel { display: inline-block; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 720px) {
            .profile-card { padding: 28px 20px 36px; }
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

<!-- BACK -->
<div class="back-wrap">
    <a href="javascript:history.back()" class="back-btn">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
</div>

<!-- MAIN -->
<main class="main">
    <div class="profile-card">

        <!-- AVATAR -->
        <div class="avatar-wrap">
            <div class="avatar-circle">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                @else
                    <span class="avatar-initials">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                @endif
            </div>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="field-group">
                <label class="field-label">Nama Lengkap</label>
                <input type="text" name="name" class="field-value" readonly
                    value="{{ old('name', Auth::user()->name) }}">
            </div>

            <div class="field-group">
                <label class="field-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="field-value" disabled>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ Auth::user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ Auth::user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="field-group">
                <label class="field-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="field-value" readonly
                    value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir) }}">
            </div>

            <div class="field-group">
                <label class="field-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="field-value" readonly
                    value="{{ old('pekerjaan', Auth::user()->pekerjaan) }}">
            </div>

            <div class="field-group">
                <label class="field-label">Kota Asal</label>
                <input type="text" name="kota_asal" class="field-value" readonly
                    value="{{ old('kota_asal', Auth::user()->kota_asal) }}">
            </div>

            <div class="field-group">
                <label class="field-label">Status</label>
                <select name="status" class="field-value" disabled>
                    <option value="">-- Pilih --</option>
                    <option value="Lajang" {{ Auth::user()->status == 'Lajang' ? 'selected' : '' }}>Lajang</option>
                    <option value="Menikah" {{ Auth::user()->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Duda" {{ Auth::user()->status == 'Duda' ? 'selected' : '' }}>Duda</option>
                    <option value="Janda" {{ Auth::user()->status == 'Janda' ? 'selected' : '' }}>Janda</option>
                </select>
            </div>

            <div class="field-group">
                <label class="field-label">Nomor Kontak</label>
                <input type="tel" name="phone" class="field-value" readonly
                    value="{{ old('phone', Auth::user()->phone) }}">
            </div>

            <div class="action-row">
                <button type="button" class="btn-cancel" onclick="cancelEdit()">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
                <button type="button" class="btn-edit" onclick="enableEdit()">Edit profile</button>
            </div>

        </form>
    </div>
</main>

<script>
    function enableEdit() {
        document.body.classList.add('edit-mode');
        // unlock semua input & select
        document.querySelectorAll('.field-value[readonly]').forEach(el => el.removeAttribute('readonly'));
        document.querySelectorAll('select.field-value[disabled]').forEach(el => el.removeAttribute('disabled'));
    }

    function cancelEdit() {
        document.body.classList.remove('edit-mode');
        document.querySelectorAll('.field-value').forEach(el => {
            if (el.tagName === 'SELECT') el.setAttribute('disabled', true);
            else el.setAttribute('readonly', true);
        });
    }
</script>

</body>
</html>