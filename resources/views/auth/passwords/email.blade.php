<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset Password</title>
    <style>
        /* Basic modal styles so this fragment can be used standalone */
        .modal-backdrop { position:fixed; inset:0;background:rgba(0,0,0,0.45);display:flex;align-items:center;justify-content:center;z-index:9999 }
        .modal { background:#fff;border-radius:10px;max-width:480px;width:92%;padding:20px;box-shadow:0 10px 30px rgba(0,0,0,0.2);position:relative }
        .modal h2 { margin:0 0 8px 0 }
        .modal p { margin:0 0 16px 0;color:#666 }
        .modal .close { position:absolute;right:12px;top:12px;border:none;background:transparent;font-size:18px;cursor:pointer }
        .form-row { margin-bottom:12px }
        .form-row label { display:block;margin-bottom:6px }
        .form-row input { width:100%;padding:10px;border:1px solid #ddd;border-radius:6px }
        .actions { display:flex;gap:12px;align-items:center }
        .actions .btn { background:#2b6cb0;color:#fff;padding:10px 14px;border-radius:6px;border:none;cursor:pointer }
        .actions .link { color:#666;text-decoration:none }
        .alert { padding:10px;border-radius:6px;margin-bottom:12px }
        .alert.success { background:#e6ffed;border:1px solid #b7f5c9;color:#064e1a }
        .alert.error { background:#fff0f0;border:1px solid #f5c2c2;color:#85000a }
    </style>
</head>
<body>
    <div class="modal-backdrop" role="dialog" aria-modal="true" id="reset-modal">
        <div class="modal">
            <button class="close" aria-label="Close" id="modal-close">✕</button>
            <h2>Reset Password</h2>
            <p>Masukkan email Anda. Kami akan mengirimkan link untuk mereset password.</p>

            @if(session('status'))
                <div class="alert success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    <ul style="margin:0;padding-left:18px">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" id="password-email-form">
                @csrf
                <div class="form-row">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required />
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Kirim link reset</button>
                    <a href="{{ route('login') }}" class="link">Kembali ke login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Close modal behavior: go back when closed if opened standalone
        const backdrop = document.getElementById('reset-modal');
        const closeBtn = document.getElementById('modal-close');
        closeBtn.addEventListener('click', () => {
            if (history.length > 1) history.back();
            else backdrop.style.display = 'none';
        });
        // Close when clicking backdrop outside modal
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                if (history.length > 1) history.back();
                else backdrop.style.display = 'none';
            }
        });
    </script>
</body>
</html>
