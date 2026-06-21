<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Tambah Kos Baru - Rumantra</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sage:        #6B8F71;
            --sage-dark:   #4A6B50;
            --sage-deeper: #3A5540;
            --sage-light:  #A8C5AC;
            --sage-bg:     #EDF3EE;
            --cream:       #F8F6F1;
            --white:       #FFFFFF;
            --text-dark:   #1E2D22;
            --text-mid:    #4A5C4D;
            --text-light:  #8A9E8D;
            --gold:        #C9A84C;
            --border:      #E2EAE3;
            --danger:      #E57373;
            --danger-bg:   #FFF5F5;
            --sidebar-w:   260px;
            --card-shadow: 0 2px 16px rgba(58,85,64,0.10);
            --radius:      14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* ════════════════════════════════════════
           SIDEBAR
        ════════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sage-deeper);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 200;
            transition: transform .3s ease;
        }
        .sidebar-header {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 12px;
        }
        .sidebar-logo {
            width: 42px; height: 42px; border-radius: 12px;
            background: rgba(255,255,255,0.12);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: 3px; flex-shrink: 0;
        }
        .sidebar-logo img { width: 36px; height: 36px; object-fit: contain; }
        .sidebar-brand {
            font-size: 16px; font-weight: 800; color: #fff;
            letter-spacing: 1.8px; text-transform: uppercase; text-decoration: none;
        }
        .sidebar-user {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 12px;
        }
        .sidebar-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: linear-gradient(135deg, var(--sage-light), var(--sage-dark));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px; color: #fff;
            flex-shrink: 0; overflow: hidden;
        }
        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-name { font-size: 14px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: 11px; color: var(--sage-light); font-weight: 500; margin-top: 2px; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
            text-transform: uppercase; color: rgba(255,255,255,0.35); padding: 12px 12px 6px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 11px;
            padding: 11px 12px; border-radius: 10px; text-decoration: none;
            color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500;
            margin-bottom: 2px; transition: background .2s, color .2s;
        }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: rgba(255,255,255,0.15); color: #fff; font-weight: 600; }
        .nav-item svg { flex-shrink: 0; opacity: .8; }
        .nav-item.active svg { opacity: 1; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout {
            display: flex; align-items: center; gap: 10px; width: 100%;
            padding: 11px 12px; border-radius: 10px; border: none;
            background: rgba(229,115,115,0.15); color: #ef9a9a;
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
            cursor: pointer; transition: background .2s, color .2s; text-decoration: none;
        }
        .btn-logout:hover { background: rgba(229,115,115,0.3); color: #ef5350; }
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.4); z-index: 199;
        }
        .sidebar-overlay.show { display: block; }

        /* ════════════════════════════════════════
           MAIN CONTENT
        ════════════════════════════════════════ */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* Topbar */
        .topbar {
            background: var(--white); border-bottom: 1px solid var(--border);
            padding: 0 32px; height: 68px; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 100;
        }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger-btn { display: none; background: none; border: none; cursor: pointer; padding: 6px; color: var(--text-dark); }
        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 14px; color: var(--text-light);
        }
        .topbar-breadcrumb a { color: var(--text-light); text-decoration: none; transition: color .2s; }
        .topbar-breadcrumb a:hover { color: var(--sage-deeper); }
        .topbar-breadcrumb span:last-child { color: var(--text-dark); font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-icon-btn {
            width: 38px; height: 38px; border-radius: 10px;
            border: 1.5px solid var(--border); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-mid); text-decoration: none;
            transition: border-color .2s, color .2s;
        }
        .topbar-icon-btn:hover { border-color: var(--sage-light); color: var(--sage-deeper); }

        /* Page body */
        .page-body { padding: 32px 36px; flex: 1; max-width: 900px; }

        /* Page heading */
        .page-heading { margin-bottom: 28px; }
        .page-heading h1 { font-size: 22px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .page-heading p { font-size: 13px; color: var(--text-light); }

        /* ════════ FORM CARD ════════ */
        .form-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .form-card-header {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 12px;
        }
        .form-card-header-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: var(--sage-bg);
            display: flex; align-items: center; justify-content: center;
        }
        .form-card-title { font-size: 16px; font-weight: 700; color: var(--text-dark); }
        .form-card-sub { font-size: 12px; color: var(--text-light); margin-top: 1px; }

        .form-body { padding: 28px; }

        /* Section divider */
        .form-section { margin-bottom: 32px; }
        .form-section:last-child { margin-bottom: 0; }
        .section-label {
            font-size: 11px; font-weight: 700; letter-spacing: 1px;
            text-transform: uppercase; color: var(--text-light);
            margin-bottom: 16px; padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 8px;
        }
        .section-label::before {
            content: '';
            display: inline-block;
            width: 3px; height: 14px;
            background: var(--sage-deeper);
            border-radius: 2px;
        }

        /* Grid layouts */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; }
        .grid-2-1 { display: grid; grid-template-columns: 2fr 1fr; gap: 18px; }

        /* Form group */
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }

        .form-label {
            font-size: 13px; font-weight: 600; color: var(--text-dark);
            display: flex; align-items: center; gap: 4px;
        }
        .required { color: var(--danger); }

        .form-control {
            width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
            padding: 11px 14px; font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: var(--text-dark); outline: none;
            transition: border-color .2s, box-shadow .2s; background: var(--white);
            appearance: none;
        }
        .form-control::placeholder { color: var(--text-light); }
        .form-control:focus { border-color: var(--sage-dark); box-shadow: 0 0 0 3px rgba(74,107,80,0.1); }
        .form-control.is-invalid { border-color: var(--danger); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(229,115,115,0.15); }

        textarea.form-control {
            resize: vertical; min-height: 100px; line-height: 1.6;
        }

        select.form-control {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238A9E8D' stroke-width='2.5' stroke-linecap='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
            cursor: pointer;
        }

        .invalid-msg { font-size: 11px; color: var(--danger); }

        /* Number input — remove spinners on Firefox */
        input[type=number] { -moz-appearance: textfield; }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button { opacity: 1; }

        /* ── Checkbox group (fasilitas) ── */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px 12px;
        }
        .checkbox-item {
            display: flex; align-items: center; gap: 8px;
            cursor: pointer; font-size: 13px; color: var(--text-mid);
            padding: 8px 12px; border-radius: 8px; border: 1.5px solid var(--border);
            transition: all .2s; user-select: none;
        }
        .checkbox-item:hover { border-color: var(--sage-light); background: var(--sage-bg); color: var(--text-dark); }
        .checkbox-item.checked { border-color: var(--sage-deeper); background: var(--sage-bg); color: var(--sage-deeper); font-weight: 600; }
        .checkbox-item input[type=checkbox] { display: none; }
        .checkbox-icon {
            width: 16px; height: 16px; border-radius: 4px;
            border: 2px solid var(--border); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            transition: all .2s; background: var(--white);
        }
        .checkbox-item.checked .checkbox-icon {
            background: var(--sage-deeper); border-color: var(--sage-deeper);
        }
        .checkbox-icon svg { display: none; }
        .checkbox-item.checked .checkbox-icon svg { display: block; }

        /* ── Eksklusif toggle ── */
        .exclusive-wrap {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; border-radius: 10px;
            border: 1.5px solid var(--border); cursor: pointer;
            transition: all .2s; user-select: none;
        }
        .exclusive-wrap:hover { border-color: var(--gold); background: #FFFBF0; }
        .exclusive-wrap.active { border-color: var(--gold); background: #FFFBF0; }
        .exclusive-wrap input[type=checkbox] { display: none; }
        .toggle-switch {
            width: 38px; height: 20px; border-radius: 10px;
            background: var(--border); position: relative;
            transition: background .2s; flex-shrink: 0;
        }
        .toggle-switch::after {
            content: ''; width: 14px; height: 14px; border-radius: 50%;
            background: var(--white); position: absolute;
            top: 3px; left: 3px; transition: transform .2s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }
        .exclusive-wrap.active .toggle-switch { background: var(--gold); }
        .exclusive-wrap.active .toggle-switch::after { transform: translateX(18px); }
        .exclusive-label { font-size: 13px; font-weight: 600; color: var(--text-dark); }
        .exclusive-sub { font-size: 11px; color: var(--text-light); margin-top: 1px; }

        /* ── Photo upload ── */
        .photo-upload-zone {
            border: 2px dashed var(--border); border-radius: 12px;
            padding: 28px 20px; text-align: center;
            cursor: pointer; transition: all .25s;
            background: #FAFCFA;
            position: relative;
        }
        .photo-upload-zone:hover, .photo-upload-zone.dragover {
            border-color: var(--sage-light);
            background: var(--sage-bg);
        }
        .photo-upload-zone input[type=file] {
            position: absolute; inset: 0; opacity: 0;
            cursor: pointer; width: 100%; height: 100%;
        }
        .upload-icon-wrap {
            width: 52px; height: 52px; border-radius: 14px;
            background: var(--sage-bg); margin: 0 auto 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .upload-title { font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 4px; }
        .upload-sub { font-size: 12px; color: var(--text-light); }
        .upload-sub strong { color: var(--sage-deeper); text-decoration: underline; cursor: pointer; }

        /* Photo preview grid */
        .photo-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            margin-top: 16px;
        }
        .preview-item {
            position: relative; border-radius: 10px; overflow: hidden;
            aspect-ratio: 1; background: var(--border);
        }
        .preview-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .preview-remove {
            position: absolute; top: 4px; right: 4px;
            width: 22px; height: 22px; border-radius: 50%;
            background: rgba(0,0,0,0.55); color: #fff;
            border: none; cursor: pointer; display: flex;
            align-items: center; justify-content: center;
            font-size: 11px; transition: background .2s;
        }
        .preview-remove:hover { background: rgba(229,115,115,0.9); }
        .preview-badge {
            position: absolute; bottom: 4px; left: 4px;
            font-size: 9px; font-weight: 700; padding: 2px 6px;
            border-radius: 6px; background: var(--sage-deeper); color: #fff;
            letter-spacing: 0.5px;
        }
        .photo-hint { font-size: 11px; color: var(--text-light); margin-top: 8px; }

        /* ── Alert ── */
        .alert-error {
            background: var(--danger-bg); border: 1px solid #fcc;
            border-radius: 10px; padding: 12px 16px; margin-bottom: 24px;
        }
        .alert-error p { font-size: 13px; color: #c0516a; }
        .alert-error ul { margin-top: 6px; padding-left: 18px; }
        .alert-error li { font-size: 13px; color: #c0516a; margin-bottom: 2px; }

        /* ── Footer actions ── */
        .form-footer {
            padding: 20px 28px;
            border-top: 1px solid var(--border);
            display: flex; align-items: center; justify-content: flex-end; gap: 12px;
        }
        .btn-cancel {
            padding: 10px 24px; border-radius: 10px;
            border: 1.5px solid var(--border); background: var(--white);
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
            color: var(--text-mid); cursor: pointer; text-decoration: none;
            transition: all .2s;
        }
        .btn-cancel:hover { border-color: var(--sage-light); color: var(--sage-deeper); background: var(--sage-bg); }
        .btn-submit {
            padding: 10px 28px; border-radius: 10px;
            background: var(--sage-deeper); color: #fff; border: none;
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: background .2s, transform .15s;
            display: flex; align-items: center; gap: 8px;
        }
        .btn-submit:hover { background: var(--sage-dark); transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit.loading svg { animation: spin .8s linear infinite; }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger-btn { display: flex; }
            .page-body { padding: 24px 16px; }
            .topbar { padding: 0 16px; }
            .grid-2, .grid-3, .grid-2-1 { grid-template-columns: 1fr; }
            .checkbox-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .checkbox-grid { grid-template-columns: 1fr 1fr; }
            .form-body { padding: 20px 16px; }
            .form-footer { padding: 16px; }
        }
    </style>
</head>
<body>

@include('owner.partials.sidebar')

<!-- ════════════════ MAIN ════════════════ -->
<div class="main">
    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <div class="topbar-breadcrumb">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                </svg>
                <a href="{{ route('owner.kos.index') }}">Kelola Kos</a>
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Tambah Kos Baru</span>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('notifikasi.index') }}" class="topbar-icon-btn" title="Notifikasi">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </a>
        </div>
    </header>

    <!-- Page body -->
    <div class="page-body">
        <div class="page-heading">
            <h1>Form Tambah Kos Baru</h1>
            <p>Lengkapi informasi kos Anda dengan detail agar pencari kos mudah menemukannya</p>
        </div>

        {{-- Error messages --}}
        @if($errors->any())
        <div class="alert-error">
            <p><strong>Terdapat beberapa kesalahan, silakan perbaiki:</strong></p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form
            method="POST"
            action="{{ route('owner.kos.store') }}"
            enctype="multipart/form-data"
            id="kos-form"
            novalidate
        >
            @csrf

            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-header-icon">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="2">
                            <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                            <path d="M9 21V12h6v9"/>
                        </svg>
                    </div>
                    <div>
                        <div class="form-card-title">Informasi Kos</div>
                        <div class="form-card-sub">Isi semua field yang bertanda bintang merah (*)</div>
                    </div>
                </div>

                <div class="form-body">

                    {{-- ── Informasi Dasar ── --}}
                    <div class="form-section">
                        <div class="section-label">Informasi Dasar</div>

                        <div class="grid-2" style="margin-bottom:18px;">
                            {{-- Nama Kos --}}
                            <div class="form-group">
                                <label class="form-label" for="nama">
                                    Nama Kos <span class="required">*</span>
                                </label>
                                <input
                                    type="text" id="nama" name="nama"
                                    class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                    placeholder="Contoh: Kos Putri Melati"
                                    value="{{ old('nama') }}"
                                    maxlength="255"
                                    required
                                >
                                @error('nama') <span class="invalid-msg">{{ $message }}</span> @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="form-group">
                                <label class="form-label" for="harga">
                                    Harga Sewa / Bulan (Rp) <span class="required">*</span>
                                </label>
                                <input
                                    type="number" id="harga" name="harga"
                                    class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}"
                                    placeholder="Contoh: 1500000"
                                    value="{{ old('harga') }}"
                                    min="0"
                                    required
                                >
                                @error('harga') <span class="invalid-msg">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group" style="margin-bottom:18px;">
                            <label class="form-label" for="alamat">
                                Alamat Lengkap <span class="required">*</span>
                            </label>
                            <input
                                type="text" id="alamat" name="alamat"
                                class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                                placeholder="Jl. Jatiwangun No. 12, Purwokerto"
                                value="{{ old('alamat') }}"
                                maxlength="255"
                                required
                            >
                            @error('alamat') <span class="invalid-msg">{{ $message }}</span> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group">
                            <label class="form-label" for="deskripsi">Deskripsi Kos</label>
                            <textarea
                                id="deskripsi" name="deskripsi"
                                class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                                placeholder="Jelaskan kenyamanan, peraturan, dan kelebihan kos Anda..."
                                rows="4"
                            >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <span class="invalid-msg">{{ $message }}</span> @enderror
                            <span id="deskripsi-count" style="font-size:11px;color:var(--text-light);text-align:right;">0 karakter</span>
                        </div>
                    </div>

                    {{-- ── Spesifikasi Kamar ── --}}
                    <div class="form-section">
                        <div class="section-label">Spesifikasi Kamar</div>

                        <div class="grid-3" style="margin-bottom:18px;">
                            {{-- Tipe Kos --}}
                            <div class="form-group">
                                <label class="form-label" for="tipe">
                                    Tipe Kos <span class="required">*</span>
                                </label>
                                <select id="tipe" name="tipe"
                                    class="form-control {{ $errors->has('tipe') ? 'is-invalid' : '' }}"
                                    required>
                                    <option value="" disabled {{ old('tipe') ? '' : 'selected' }}>Pilih tipe</option>
                                    <option value="putri"  {{ old('tipe') == 'putri'  ? 'selected' : '' }}>Putri</option>
                                    <option value="putra"  {{ old('tipe') == 'putra'  ? 'selected' : '' }}>Putra</option>
                                    <option value="campur" {{ old('tipe') == 'campur' ? 'selected' : '' }}>Campur</option>
                                </select>
                                @error('tipe') <span class="invalid-msg">{{ $message }}</span> @enderror
                            </div>

                            {{-- Luas Kamar --}}
                            <div class="form-group">
                                <label class="form-label" for="luas_kamar">Luas Kamar</label>
                                <input
                                    type="text" id="luas_kamar" name="luas_kamar"
                                    class="form-control {{ $errors->has('luas_kamar') ? 'is-invalid' : '' }}"
                                    placeholder="Contoh: 3 x 4 m"
                                    value="{{ old('luas_kamar') }}"
                                    maxlength="50"
                                >
                                @error('luas_kamar') <span class="invalid-msg">{{ $message }}</span> @enderror
                            </div>

                            {{-- Kamar Mandi --}}
                            <div class="form-group">
                                <label class="form-label" for="kamar_mandi">
                                    Kamar Mandi <span class="required">*</span>
                                </label>
                                <select id="kamar_mandi" name="kamar_mandi"
                                    class="form-control {{ $errors->has('kamar_mandi') ? 'is-invalid' : '' }}"
                                    required>
                                    <option value="" disabled {{ old('kamar_mandi') ? '' : 'selected' }}>Pilih tipe</option>
                                    <option value="dalam" {{ old('kamar_mandi') == 'dalam' ? 'selected' : '' }}>Dalam</option>
                                    <option value="luar"  {{ old('kamar_mandi') == 'luar'  ? 'selected' : '' }}>Luar</option>
                                </select>
                                @error('kamar_mandi') <span class="invalid-msg">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid-2" style="align-items:start;">
                            <div class="grid-2" style="gap:18px;">
                                {{-- Jumlah Kamar --}}
                                <div class="form-group">
                                    <label class="form-label" for="kamar_tersedia">
                                        Jumlah Kamar Tersedia <span class="required">*</span>
                                    </label>
                                    <input
                                        type="number" id="kamar_tersedia" name="kamar_tersedia"
                                        class="form-control {{ $errors->has('kamar_tersedia') ? 'is-invalid' : '' }}"
                                        value="{{ old('kamar_tersedia', 0) }}"
                                        min="0" max="999"
                                        required
                                    >
                                    @error('kamar_tersedia') <span class="invalid-msg">{{ $message }}</span> @enderror
                                </div>

                                {{-- Status --}}
                                <div class="form-group">
                                    <label class="form-label" for="status">
                                        Status <span class="required">*</span>
                                    </label>
                                    <select id="status" name="status"
                                        class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        required>
                                        <option value="pending"    {{ old('status', 'pending') == 'pending'    ? 'selected' : '' }}>Ajukan</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status') <span class="invalid-msg">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Eksklusif Toggle --}}
                            <div class="form-group" style="justify-content:flex-end;">
                                <label class="form-label">&nbsp;</label>
                                <label
                                    class="exclusive-wrap {{ old('is_eksklusif') ? 'active' : '' }}"
                                    id="exclusive-label"
                                    onclick="toggleExclusive()"
                                >
                                    <input
                                        type="checkbox" name="is_eksklusif" id="is_eksklusif"
                                        value="1"
                                        {{ old('is_eksklusif') ? 'checked' : '' }}
                                    >
                                    <div class="toggle-switch" id="toggle-switch"></div>
                                    <div>
                                        <div class="exclusive-label">Kos Exclusive / Premium</div>
                                        <div class="exclusive-sub">Tandai jika kos ini termasuk kategori premium</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- ── Fasilitas ── --}}
                    <div class="form-section">
                        <div class="section-label">Fasilitas Kamar & Umum</div>

                        @php
                            $fasilitasList = [
                                'Wi-Fi', 'AC', 'Laundry', 'K.M Dalam', 'Kasur',
                                'Lemari', 'Meja Belajar', 'Dapur Bersama', 'Parkir Motor', 'Parkir Mobil',
                            ];
                            $oldFasilitas = old('fasilitas', []);
                        @endphp

                        <div class="checkbox-grid">
                            @foreach($fasilitasList as $fasilitas)
                            <label
                                class="checkbox-item {{ in_array($fasilitas, $oldFasilitas) ? 'checked' : '' }}"
                                onclick="toggleCheckbox(this)"
                            >
                                <input
                                    type="checkbox"
                                    name="fasilitas[]"
                                    value="{{ $fasilitas }}"
                                    {{ in_array($fasilitas, $oldFasilitas) ? 'checked' : '' }}
                                >
                                <div class="checkbox-icon">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </div>
                                {{ $fasilitas }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- ── Upload Foto ── --}}
                    <div class="form-section">
                        <div class="section-label">Foto Kos</div>

                        <div
                            class="photo-upload-zone"
                            id="upload-zone"
                            ondragover="handleDragOver(event)"
                            ondragleave="handleDragLeave(event)"
                            ondrop="handleDrop(event)"
                        >
                            <input
                                type="file"
                                name="foto[]"
                                id="foto-input"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                multiple
                                onchange="handleFileSelect(event)"
                            >
                            <div class="upload-icon-wrap">
                                <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#3A5540" stroke-width="1.8">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                            <div class="upload-title">Pilih atau seret foto ke sini</div>
                            <div class="upload-sub">
                                Format: JPG, JPEG, PNG, WEBP · Maks 2MB per file ·
                                <strong onclick="document.getElementById('foto-input').click()">Browse file</strong>
                            </div>
                        </div>

                        <div class="photo-preview-grid" id="preview-grid"></div>
                        <div class="photo-hint" id="photo-hint" style="display:none;">
                            Foto pertama akan dijadikan foto utama. Klik ✕ untuk menghapus.
                        </div>

                        @error('foto') <span class="invalid-msg">{{ $message }}</span> @enderror
                        @error('foto.*') <span class="invalid-msg">{{ $message }}</span> @enderror
                    </div>

                </div>{{-- end form-body --}}

                <div class="form-footer">
                    <a href="{{ route('owner.kos.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit" id="submit-btn">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Simpan Kos
                    </button>
                </div>

            </div>{{-- end form-card --}}
        </form>
    </div>
</div>

<script>
    /* ══════════════════════════════════════════
       Sidebar toggle
    ══════════════════════════════════════════ */
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }

    /* ══════════════════════════════════════════
       Exclusive toggle
    ══════════════════════════════════════════ */
    function toggleExclusive() {
        const label   = document.getElementById('exclusive-label');
        const cb      = document.getElementById('is_eksklusif');
        // The click on label auto-toggles checkbox, we just sync UI
        setTimeout(() => {
            if (cb.checked) {
                label.classList.add('active');
            } else {
                label.classList.remove('active');
            }
        }, 0);
    }

    /* ══════════════════════════════════════════
       Checkbox fasilitas
    ══════════════════════════════════════════ */
    function toggleCheckbox(label) {
        // Checkbox auto-toggles via browser; we sync the UI class
        setTimeout(() => {
            const cb = label.querySelector('input[type=checkbox]');
            if (cb.checked) label.classList.add('checked');
            else             label.classList.remove('checked');
        }, 0);
    }

    /* ══════════════════════════════════════════
       Deskripsi character count
    ══════════════════════════════════════════ */
    const deskEl    = document.getElementById('deskripsi');
    const countEl   = document.getElementById('deskripsi-count');
    deskEl.addEventListener('input', () => {
        countEl.textContent = deskEl.value.length + ' karakter';
    });

    /* ══════════════════════════════════════════
       Photo upload & preview
    ══════════════════════════════════════════ */
    let selectedFiles = []; // Array of File objects

    function renderPreviews() {
        const grid    = document.getElementById('preview-grid');
        const hint    = document.getElementById('photo-hint');
        grid.innerHTML = '';

        if (selectedFiles.length === 0) {
            hint.style.display = 'none';
            syncFileInput();
            return;
        }

        hint.style.display = 'block';

        selectedFiles.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const item = document.createElement('div');
                item.className = 'preview-item';
                item.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    ${idx === 0 ? '<span class="preview-badge">UTAMA</span>' : ''}
                    <button type="button" class="preview-remove" onclick="removeFile(${idx})" title="Hapus">✕</button>
                `;
                grid.appendChild(item);
            };
            reader.readAsDataURL(file);
        });

        syncFileInput();
    }

    function removeFile(idx) {
        selectedFiles.splice(idx, 1);
        renderPreviews();
    }

    function addFiles(files) {
        const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        let rejected  = 0;

        Array.from(files).forEach(file => {
            if (!allowed.includes(file.type)) { rejected++; return; }
            if (file.size > 2 * 1024 * 1024) {
                alert(`File "${file.name}" melebihi 2MB dan tidak disertakan.`);
                return;
            }
            // Avoid duplicates by name+size
            const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
            if (!exists) selectedFiles.push(file);
        });

        if (rejected > 0) {
            alert(`${rejected} file diabaikan karena format tidak didukung (harus JPG, PNG, atau WEBP).`);
        }

        renderPreviews();
    }

    function syncFileInput() {
        // Create a new DataTransfer to replace the file input's FileList
        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        document.getElementById('foto-input').files = dt.files;
    }

    function handleFileSelect(e) {
        addFiles(e.target.files);
        // Do not clear the input here; keeping the FileList allows the files to be
        // submitted with the form. The upload component maintains `selectedFiles`
        // and syncs it into the input via syncFileInput().
    }

    function handleDragOver(e) {
        e.preventDefault();
        document.getElementById('upload-zone').classList.add('dragover');
    }

    function handleDragLeave(e) {
        document.getElementById('upload-zone').classList.remove('dragover');
    }

    function handleDrop(e) {
        e.preventDefault();
        document.getElementById('upload-zone').classList.remove('dragover');
        addFiles(e.dataTransfer.files);
    }

    /* ══════════════════════════════════════════
       Form submit — loading state
    ══════════════════════════════════════════ */
    document.getElementById('kos-form').addEventListener('submit', function () {
        const btn = document.getElementById('submit-btn');
        btn.classList.add('loading');
        btn.innerHTML = `
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
            </svg>
            Menyimpan...
        `;
        btn.disabled = true;
    });

    /* ══════════════════════════════════════════
       Harga formatter (preview)
    ══════════════════════════════════════════ */
    document.getElementById('harga').addEventListener('input', function () {
        const val = parseInt(this.value, 10);
        if (!isNaN(val) && val > 0) {
            const fmt = new Intl.NumberFormat('id-ID').format(val);
            this.title = 'Rp ' + fmt;
        } else {
            this.title = '';
        }
    });
</script>
</body>
</html>
