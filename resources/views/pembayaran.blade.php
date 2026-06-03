<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Rumantra</title>
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
                --gold:        #C9A84C;
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background: var(--cream);
                color: var(--text-dark);
                min-height: 100vh;
                padding: 24px;
            }

            /* ─── BACK ─── */
            .back-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                font-weight: 500;
                color: var(--text-mid);
                text-decoration: none;
                margin-bottom: 24px;
                transition: color .2s;
            }
            .back-btn:hover { color: var(--sage-deeper); }

            /* ─── STEPPER ─── */
            .stepper {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 32px;
            }
            .step { display: flex; flex-direction: column; align-items: center; gap: 6px; }
            .step-circle {
                width: 36px; height: 36px;
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 14px; font-weight: 700;
            }
            .step.done .step-circle   { background: var(--sage-deeper); color: #fff; }
            .step.active .step-circle { background: var(--sage-deeper); color: #fff; }
            .step.inactive .step-circle { background: #e0e8e1; color: var(--text-light); }
            .step-label { font-size: 11px; font-weight: 500; white-space: nowrap; }
            .step.done .step-label   { color: var(--sage-deeper); }
            .step.active .step-label { color: var(--sage-deeper); font-weight: 600; }
            .step.inactive .step-label { color: var(--text-light); }
            .step-line { width: 80px; height: 2px; background: #e0e8e1; margin-bottom: 22px; }
            .step-line.done { background: var(--sage-deeper); }

            /* ─── MAIN ─── */
            .main {
                max-width: 820px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 1fr 340px;
                gap: 24px;
            }

            .card {
                background: var(--white);
                border-radius: 16px;
                padding: 28px;
                box-shadow: 0 2px 16px rgba(74,107,80,0.08);
            }

            .card-title {
                font-size: 17px;
                font-weight: 700;
                color: var(--text-dark);
                margin-bottom: 24px;
            }

            /* ─── METODE PEMBAYARAN ─── */
            .metode-group { margin-bottom: 24px; }
            .metode-group-title {
                font-size: 11px;
                font-weight: 600;
                color: var(--text-light);
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 12px;
            }

            .metode-item {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 14px 16px;
                border: 1.5px solid var(--border);
                border-radius: 12px;
                margin-bottom: 10px;
                cursor: pointer;
                transition: all .2s;
                position: relative;
            }
            .metode-item:hover { border-color: var(--sage-light); background: #f8faf8; }
            .metode-item.selected { border-color: var(--sage-deeper); background: var(--sage-bg); }

            .metode-icon {
                width: 44px; height: 44px;
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                font-size: 20px;
            }
            .metode-info { flex: 1; }
            .metode-name { font-size: 14px; font-weight: 600; color: var(--text-dark); }
            .metode-desc { font-size: 11px; color: var(--text-light); margin-top: 2px; }

            .metode-radio {
                width: 18px; height: 18px;
                border-radius: 50%;
                border: 2px solid var(--border);
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                transition: border-color .2s;
            }
            .metode-item.selected .metode-radio { border-color: var(--sage-deeper); }
            .metode-radio-dot {
                width: 8px; height: 8px;
                border-radius: 50%;
                background: var(--sage-deeper);
                display: none;
            }
            .metode-item.selected .metode-radio-dot { display: block; }

            /* QRIS icon */
            .icon-qris { background: #f0f9f1; }
            .icon-transfer { background: #f0f4ff; }
            .icon-cash { background: #fff8e8; }

            /* ─── DETAIL PEMBAYARAN (muncul saat dipilih) ─── */
            .detail-bayar {
                display: none;
                margin-top: 10px;
                padding: 16px;
                background: #f8faf8;
                border-radius: 10px;
                border: 1px dashed var(--sage-light);
            }
            .detail-bayar.show { display: block; }

            .qris-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            .qris-img {
                width: 140px; height: 140px;
                border-radius: 10px;
                background: #fff;
                border: 2px solid var(--border);
                display: flex; align-items: center; justify-content: center;
                padding: 8px;
            }
            .qris-img svg { width: 100%; height: 100%; }
            .qris-note { font-size: 11px; color: var(--text-light); text-align: center; }

            .transfer-info { font-size: 13px; color: var(--text-mid); }
            .transfer-info strong { color: var(--text-dark); font-size: 15px; display: block; margin-top: 4px; }
            .copy-btn {
                margin-top: 8px;
                background: var(--sage-bg);
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 6px 14px;
                font-family: 'DM Sans', sans-serif;
                font-size: 12px;
                color: var(--sage-deeper);
                cursor: pointer;
                font-weight: 600;
                transition: background .2s;
            }
            .copy-btn:hover { background: var(--sage-light); }

            .cash-note { font-size: 13px; color: var(--text-mid); line-height: 1.6; }

            /* ─── BUKTI TRANSFER ─── */
            .upload-wrap {
                margin-top: 20px;
                border: 2px dashed var(--border);
                border-radius: 12px;
                padding: 24px;
                text-align: center;
                cursor: pointer;
                transition: border-color .2s, background .2s;
            }
            .upload-wrap:hover { border-color: var(--sage-light); background: #f8faf8; }
            .upload-wrap.has-file { border-color: var(--sage-deeper); background: var(--sage-bg); }
            .upload-icon { font-size: 28px; margin-bottom: 8px; }
            .upload-label { font-size: 13px; font-weight: 600; color: var(--text-mid); }
            .upload-sub { font-size: 11px; color: var(--text-light); margin-top: 4px; }
            .upload-input { display: none; }
            .upload-preview {
                width: 80px; height: 80px;
                object-fit: cover;
                border-radius: 8px;
                margin: 0 auto 8px;
                display: none;
            }

            /* ─── RINGKASAN KANAN ─── */
            .summary-title { font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 16px; }
            .summary-kos {
                display: flex;
                gap: 12px;
                margin-bottom: 16px;
                padding-bottom: 16px;
                border-bottom: 1px solid var(--border);
            }
            .summary-kos-img {
                width: 56px; height: 56px;
                border-radius: 8px;
                background: var(--sage-bg);
                flex-shrink: 0;
                overflow: hidden;
            }
            .summary-kos-img img { width: 100%; height: 100%; object-fit: cover; }
            .summary-kos-name { font-size: 13px; font-weight: 600; color: var(--text-dark); }
            .summary-kos-loc { font-size: 11px; color: var(--text-light); margin-top: 2px; }

            .summary-row {
                display: flex;
                justify-content: space-between;
                font-size: 13px;
                padding: 8px 0;
                color: var(--text-mid);
                border-bottom: 1px solid #f0f4f1;
            }
            .summary-row:last-of-type { border-bottom: none; }
            .summary-row.total {
                font-weight: 700;
                font-size: 15px;
                color: var(--text-dark);
                border-top: 1.5px solid var(--border);
                padding-top: 14px;
                margin-top: 4px;
            }
            .summary-row.total span:last-child { color: var(--sage-deeper); }

            .btn-bayar {
                display: block;
                width: 100%;
                background: var(--sage-deeper);
                color: #fff;
                border: none;
                border-radius: 12px;
                padding: 14px;
                font-family: 'DM Sans', sans-serif;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                text-align: center;
                margin-top: 20px;
                transition: background .2s, transform .15s;
            }
            .btn-bayar:hover { background: var(--sage-dark); transform: translateY(-1px); }
            .btn-bayar:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

            /* ─── RESPONSIVE ─── */
            @media (max-width: 640px) {
                .main { grid-template-columns: 1fr; }
                body { padding: 16px; }
                .step-line { width: 40px; }
            }
        </style>
    </head>
    <body>

    <!-- BACK -->
    <a href="javascript:history.back()" class="back-btn">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>

    <!-- STEPPER -->
    <div class="stepper">
        <div class="step done">
            <div class="step-circle">1</div>
            <div class="step-label">Booking</div>
        </div>
        <div class="step-line done"></div>
        <div class="step done">
            <div class="step-circle">2</div>
            <div class="step-label">Tanggal sewa</div>
        </div>
        <div class="step-line done"></div>
        <div class="step active">
            <div class="step-circle">3</div>
            <div class="step-label">Pembayaran</div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- KIRI: Metode Pembayaran -->
        <div class="card">
            <div class="card-title">Pilih Metode Pembayaran</div>

            <form method="POST" action="{{ route('pembayaran.store') }}" enctype="multipart/form-data" id="form-bayar">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">
                <input type="hidden" name="metode" id="input-metode">

                <!-- QRIS -->
                <div class="metode-group">
                    <div class="metode-group-title">Dompet Digital</div>

                    <div class="metode-item" onclick="pilihMetode(this, 'qris')">
                        <div class="metode-icon icon-qris">
                            <svg width="28" height="28" viewBox="0 0 40 40" fill="none">
                                <rect x="4" y="4" width="14" height="14" rx="2" stroke="#3A5540" stroke-width="2"/>
                                <rect x="7" y="7" width="8" height="8" rx="1" fill="#3A5540"/>
                                <rect x="22" y="4" width="14" height="14" rx="2" stroke="#3A5540" stroke-width="2"/>
                                <rect x="25" y="7" width="8" height="8" rx="1" fill="#3A5540"/>
                                <rect x="4" y="22" width="14" height="14" rx="2" stroke="#3A5540" stroke-width="2"/>
                                <rect x="7" y="25" width="8" height="8" rx="1" fill="#3A5540"/>
                                <rect x="22" y="22" width="4" height="4" fill="#3A5540"/>
                                <rect x="28" y="22" width="4" height="4" fill="#3A5540"/>
                                <rect x="34" y="22" width="2" height="4" fill="#3A5540"/>
                                <rect x="22" y="28" width="4" height="4" fill="#3A5540"/>
                                <rect x="28" y="28" width="8" height="8" fill="#3A5540"/>
                            </svg>
                        </div>
                        <div class="metode-info">
                            <div class="metode-name">QRIS</div>
                            <div class="metode-desc">Bayar dengan semua e-wallet & mobile banking</div>
                        </div>
                        <div class="metode-radio"><div class="metode-radio-dot"></div></div>
                    </div>

                    <!-- Detail QRIS -->
                    <div class="detail-bayar" id="detail-qris">
                        <div class="qris-box">
                            <div class="qris-img">
                                {{-- Ganti src dengan QR code asli --}}
                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="100" height="100" fill="white"/>
                                    <rect x="10" y="10" width="30" height="30" rx="3" fill="#3A5540"/>
                                    <rect x="15" y="15" width="20" height="20" rx="2" fill="white"/>
                                    <rect x="18" y="18" width="14" height="14" rx="1" fill="#3A5540"/>
                                    <rect x="60" y="10" width="30" height="30" rx="3" fill="#3A5540"/>
                                    <rect x="65" y="15" width="20" height="20" rx="2" fill="white"/>
                                    <rect x="68" y="18" width="14" height="14" rx="1" fill="#3A5540"/>
                                    <rect x="10" y="60" width="30" height="30" rx="3" fill="#3A5540"/>
                                    <rect x="15" y="65" width="20" height="20" rx="2" fill="white"/>
                                    <rect x="18" y="68" width="14" height="14" rx="1" fill="#3A5540"/>
                                    <rect x="50" y="50" width="6" height="6" fill="#3A5540"/>
                                    <rect x="58" y="50" width="6" height="6" fill="#3A5540"/>
                                    <rect x="66" y="50" width="6" height="6" fill="#3A5540"/>
                                    <rect x="74" y="50" width="6" height="6" fill="#3A5540"/>
                                    <rect x="82" y="50" width="8" height="6" fill="#3A5540"/>
                                    <rect x="50" y="58" width="6" height="6" fill="#3A5540"/>
                                    <rect x="66" y="58" width="6" height="6" fill="#3A5540"/>
                                    <rect x="50" y="66" width="6" height="6" fill="#3A5540"/>
                                    <rect x="58" y="66" width="6" height="6" fill="#3A5540"/>
                                    <rect x="74" y="66" width="6" height="6" fill="#3A5540"/>
                                    <rect x="50" y="74" width="6" height="6" fill="#3A5540"/>
                                    <rect x="66" y="74" width="6" height="6" fill="#3A5540"/>
                                    <rect x="82" y="74" width="8" height="16" fill="#3A5540"/>
                                    <rect x="58" y="82" width="6" height="8" fill="#3A5540"/>
                                    <rect x="74" y="82" width="6" height="8" fill="#3A5540"/>
                                </svg>
                            </div>
                            <div class="qris-note">Scan QR Code menggunakan aplikasi e-wallet atau mobile banking kamu</div>
                            <div style="font-size:12px; color:var(--text-light);">Berlaku 24 jam</div>
                        </div>
                        <div style="margin-top:14px;">
                            <div class="upload-wrap" id="upload-wrap-qris" onclick="document.getElementById('bukti-qris').click()">
                                <img class="upload-preview" id="preview-qris">
                                <div class="upload-icon">📎</div>
                                <div class="upload-label">Upload Bukti Pembayaran</div>
                                <div class="upload-sub">JPG, PNG maksimal 2MB</div>
                            </div>
                            <input type="file" name="bukti_qris" id="bukti-qris" class="upload-input" accept="image/*" onchange="previewFile(this, 'preview-qris', 'upload-wrap-qris')">
                        </div>
                    </div>
                </div>

                <!-- Transfer Bank -->
                <div class="metode-group">
                    <div class="metode-group-title">Transfer Bank</div>

                    <div class="metode-item" onclick="pilihMetode(this, 'bca')">
                        <div class="metode-icon icon-transfer">
                            <svg width="28" height="20" viewBox="0 0 60 20" fill="none">
                                <text x="0" y="16" font-family="DM Sans" font-size="16" font-weight="700" fill="#1A4B9B">BCA</text>
                            </svg>
                        </div>
                        <div class="metode-info">
                            <div class="metode-name">Bank BCA</div>
                            <div class="metode-desc">Transfer via ATM, m-Banking, atau teller</div>
                        </div>
                        <div class="metode-radio"><div class="metode-radio-dot"></div></div>
                    </div>

                    <div class="detail-bayar" id="detail-bca">
                        <div class="transfer-info">
                            Nomor Rekening
                            <strong>1234 5678 9012</strong>
                            a.n. <strong>PT Rumantra Indonesia</strong>
                        </div>
                        <button type="button" class="copy-btn" onclick="copyNorek('1234567890l2')">📋 Salin Nomor Rekening</button>
                        <div style="margin-top:14px;">
                            <div class="upload-wrap" id="upload-wrap-bca" onclick="document.getElementById('bukti-bca').click()">
                                <img class="upload-preview" id="preview-bca">
                                <div class="upload-icon">📎</div>
                                <div class="upload-label">Upload Bukti Transfer</div>
                                <div class="upload-sub">JPG, PNG maksimal 2MB</div>
                            </div>
                            <input type="file" name="bukti_bca" id="bukti-bca" class="upload-input" accept="image/*" onchange="previewFile(this, 'preview-bca', 'upload-wrap-bca')">
                        </div>
                    </div>

                    <div class="metode-item" onclick="pilihMetode(this, 'mandiri')">
                        <div class="metode-icon icon-transfer">
                            <svg width="28" height="20" viewBox="0 0 80 20" fill="none">
                                <text x="0" y="16" font-family="DM Sans" font-size="13" font-weight="700" fill="#003087">Mandiri</text>
                            </svg>
                        </div>
                        <div class="metode-info">
                            <div class="metode-name">Bank Mandiri</div>
                            <div class="metode-desc">Transfer via ATM, m-Banking, atau teller</div>
                        </div>
                        <div class="metode-radio"><div class="metode-radio-dot"></div></div>
                    </div>

                    <div class="detail-bayar" id="detail-mandiri">
                        <div class="transfer-info">
                            Nomor Rekening
                            <strong>1400 0098 7654</strong>
                            a.n. <strong>PT Rumantra Indonesia</strong>
                        </div>
                        <button type="button" class="copy-btn" onclick="copyNorek('1400009876554')">📋 Salin Nomor Rekening</button>
                        <div style="margin-top:14px;">
                            <div class="upload-wrap" id="upload-wrap-mandiri" onclick="document.getElementById('bukti-mandiri').click()">
                                <img class="upload-preview" id="preview-mandiri">
                                <div class="upload-icon">📎</div>
                                <div class="upload-label">Upload Bukti Transfer</div>
                                <div class="upload-sub">JPG, PNG maksimal 2MB</div>
                            </div>
                            <input type="file" name="bukti_mandiri" id="bukti-mandiri" class="upload-input" accept="image/*" onchange="previewFile(this, 'preview-mandiri', 'upload-wrap-mandiri')">
                        </div>
                    </div>
                </div>

                <!-- Tunai -->
                <div class="metode-group">
                    <div class="metode-group-title">Tunai</div>
                    <div class="metode-item" onclick="pilihMetode(this, 'cash')">
                        <div class="metode-icon icon-cash">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#C9A84C" stroke-width="1.8">
                                <rect x="2" y="6" width="20" height="12" rx="2"/>
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M6 12h.01M18 12h.01"/>
                            </svg>
                        </div>
                        <div class="metode-info">
                            <div class="metode-name">Bayar Tunai</div>
                            <div class="metode-desc">Bayar langsung ke pemilik kos</div>
                        </div>
                        <div class="metode-radio"><div class="metode-radio-dot"></div></div>
                    </div>

                    <div class="detail-bayar" id="detail-cash">
                        <div class="cash-note">
                            💡 Kamu bisa membayar langsung kepada pemilik kos saat check-in. Pastikan membawa uang tunai sesuai jumlah tagihan.
                            <br><br>
                            <strong>Catatan:</strong> Pembayaran tunai harus dikonfirmasi oleh pemilik kos.
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-bayar" id="btn-bayar" disabled>
                    Konfirmasi Pembayaran
                </button>
            </form>
        </div>

        <!-- KANAN: Ringkasan -->
        <div>
            <div class="card">
                <div class="summary-title">Ringkasan Pesanan</div>

                <div class="summary-kos">
                    <div class="summary-kos-img">
                        @if(isset($booking->kos) && $booking->kos->foto_utama)
                            <img src="{{ asset('storage/' . $booking->kos->foto_utama) }}" alt="">
                        @else
                            <div style="width:100%;height:100%;background:var(--sage-bg);display:flex;align-items:center;justify-content:center;">
                                <svg width="24" height="24" fill="none" viewBox="0 0 48 48" stroke="var(--sage-light)" stroke-width="1.5"><path d="M8 38V20l16-10 16 10v18"/><rect x="16" y="24" width="16" height="14" rx="1"/></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="summary-kos-name">{{ $booking->kos->nama ?? 'Nama Kos' }}</div>
                        <div class="summary-kos-loc">{{ $booking->kos->alamat ?? 'Alamat Kos' }}</div>
                    </div>
                </div>

                <div class="summary-row">
                    <span>Tanggal Mulai</span>
                    <span style="font-weight:600">{{ isset($booking->tanggal_mulai) ? \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') : '-' }}</span>
                </div>
                <div class="summary-row">
                    <span>Durasi</span>
                    <span style="font-weight:600">{{ $booking->durasi ?? '-' }} Bulan</span>
                </div>
                <div class="summary-row">
                    <span>Harga / Bulan</span>
                    <span style="font-weight:600">{{ isset($booking->kos) ? 'Rp ' . number_format($booking->kos->harga, 0, ',', '.') : '-' }}</span>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span style="font-weight:600">{{ isset($booking) ? 'Rp ' . number_format(($booking->kos->harga ?? 0) * ($booking->durasi ?? 0), 0, ',', '.') : '-' }}</span>
                </div>
                <div class="summary-row">
                    <span>Biaya Layanan</span>
                    <span style="font-weight:600">Rp 50.000</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>{{ isset($booking) ? 'Rp ' . number_format((($booking->kos->harga ?? 0) * ($booking->durasi ?? 0)) + 50000, 0, ',', '.') : '-' }}</span>
                </div>
            </div>
        </div>

    </div>

    <script>
        let selectedMetode = null;

        function pilihMetode(el, metode) {
            // Reset semua
            document.querySelectorAll('.metode-item').forEach(i => i.classList.remove('selected'));
            document.querySelectorAll('.detail-bayar').forEach(d => d.classList.remove('show'));

            // Aktifkan yang dipilih
            el.classList.add('selected');
            const detail = document.getElementById('detail-' + metode);
            if (detail) detail.classList.add('show');

            selectedMetode = metode;
            document.getElementById('input-metode').value = metode;

            // Aktifkan tombol
            const btn = document.getElementById('btn-bayar');
            btn.disabled = false;
        }

        function copyNorek(norek) {
            navigator.clipboard.writeText(norek).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }

        function previewFile(input, previewId, wrapId) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById(previewId);
                const wrap    = document.getElementById(wrapId);
                preview.src   = e.target.result;
                preview.style.display = 'block';
                wrap.querySelector('.upload-icon').style.display  = 'none';
                wrap.querySelector('.upload-label').textContent   = file.name;
                wrap.querySelector('.upload-sub').textContent     = (file.size / 1024).toFixed(0) + ' KB';
                wrap.classList.add('has-file');
            };
            reader.readAsDataURL(file);
        }
    </script>

    </body>
    </html>