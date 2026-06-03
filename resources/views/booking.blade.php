<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Kos - Rumantra</title>
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
                gap: 0;
                margin-bottom: 32px;
            }
            .step {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 6px;
                position: relative;
            }
            .step-circle {
                width: 36px; height: 36px;
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 14px; font-weight: 700;
                transition: all .3s;
            }
            .step.active .step-circle {
                background: var(--sage-deeper);
                color: #fff;
            }
            .step.done .step-circle {
                background: var(--sage-deeper);
                color: #fff;
            }
            .step.inactive .step-circle {
                background: #e0e8e1;
                color: var(--text-light);
            }
            .step-label {
                font-size: 11px;
                font-weight: 500;
                white-space: nowrap;
            }
            .step.active .step-label { color: var(--sage-deeper); font-weight: 600; }
            .step.done .step-label { color: var(--sage-deeper); }
            .step.inactive .step-label { color: var(--text-light); }

            .step-line {
                width: 80px;
                height: 2px;
                background: #e0e8e1;
                margin-bottom: 22px;
            }
            .step-line.done { background: var(--sage-deeper); }

            /* ─── CONTENT ─── */
            .content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 24px;
                max-width: 820px;
                margin: 0 auto;
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
                text-align: center;
                margin-bottom: 20px;
            }

            /* ─── CALENDAR ─── */
            .calendar { user-select: none; }

            .cal-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 14px;
            }
            .cal-month {
                font-size: 13px;
                font-weight: 600;
                color: var(--text-dark);
            }
            .cal-nav {
                background: none;
                border: none;
                cursor: pointer;
                color: var(--text-light);
                font-size: 16px;
                padding: 4px 8px;
                border-radius: 6px;
                transition: background .2s, color .2s;
            }
            .cal-nav:hover { background: var(--sage-bg); color: var(--sage-deeper); }

            .cal-grid {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                gap: 2px;
            }
            .cal-day-name {
                text-align: center;
                font-size: 10px;
                font-weight: 600;
                color: var(--text-light);
                padding: 4px 0 8px;
                text-transform: uppercase;
            }
            .cal-day {
                text-align: center;
                padding: 7px 4px;
                font-size: 12px;
                border-radius: 8px;
                cursor: pointer;
                color: var(--text-dark);
                transition: all .15s;
            }
            .cal-day:hover:not(.empty):not(.past) { background: var(--sage-bg); }
            .cal-day.empty { cursor: default; }
            .cal-day.past { color: #ccc; cursor: default; }
            .cal-day.selected {
                background: var(--sage-deeper);
                color: #fff;
                font-weight: 700;
            }
            .cal-day.today {
                border: 1.5px solid var(--sage-deeper);
                color: var(--sage-deeper);
                font-weight: 600;
            }
            .cal-day.today.selected { border-color: transparent; color: #fff; }

            /* ─── DURASI ─── */
            .durasi-wrap { margin-top: 20px; }
            .durasi-label {
                font-size: 12px;
                font-weight: 600;
                color: var(--text-mid);
                margin-bottom: 8px;
            }
            .durasi-select {
                width: 100%;
                border: 1.5px solid var(--border);
                border-radius: 10px;
                padding: 10px 14px;
                font-family: 'DM Sans', sans-serif;
                font-size: 13px;
                color: var(--text-dark);
                background: var(--white);
                outline: none;
                cursor: pointer;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238A9E8D' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 12px center;
                background-size: 16px;
                transition: border-color .2s;
            }
            .durasi-select:focus { border-color: var(--sage-dark); }

            /* ─── CHECKOUT INFO ─── */
            .checkout-info {
                margin-top: 14px;
                background: #e8f5e9;
                border-radius: 8px;
                padding: 10px 14px;
                font-size: 12px;
                color: var(--sage-dark);
                font-weight: 500;
            }
            .checkout-info span { display: block; font-size: 10px; color: var(--sage-deeper); font-weight: 600; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.5px; }

            /* ─── RINGKASAN ─── */
            .summary-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 0;
                font-size: 14px;
                color: var(--text-mid);
            }
            .summary-row:not(:last-child) { border-bottom: 1px solid #f0f4f1; }
            .summary-row.total {
                font-weight: 700;
                font-size: 15px;
                color: var(--text-dark);
                border-top: 1.5px solid var(--border);
                margin-top: 4px;
                padding-top: 16px;
                border-bottom: none;
            }
            .summary-label { color: var(--text-mid); }
            .summary-value { font-weight: 600; color: var(--text-dark); }
            .summary-row.total .summary-value { color: var(--sage-deeper); }

            /* ─── BTN ─── */
            .btn-lanjut {
                display: block;
                width: 100%;
                background: var(--sage-deeper);
                color: #fff;
                border: none;
                border-radius: 12px;
                padding: 15px;
                font-family: 'DM Sans', sans-serif;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                text-align: center;
                margin-top: 28px;
                transition: background .2s, transform .15s;
                text-decoration: none;
            }
            .btn-lanjut:hover { background: var(--sage-dark); transform: translateY(-1px); }

            /* ─── RESPONSIVE ─── */
            @media (max-width: 640px) {
                .content { grid-template-columns: 1fr; }
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
        <div class="step active">
            <div class="step-circle">1</div>
            <div class="step-label">Booking</div>
        </div>
        <div class="step-line"></div>
        <div class="step inactive">
            <div class="step-circle">2</div>
            <div class="step-label">Tanggal sewa</div>
        </div>
        <div class="step-line"></div>
        <div class="step inactive">
            <div class="step-circle">3</div>
            <div class="step-label">Pembayaran</div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- LEFT: Pilih Tanggal -->
        <div class="card">
            <div class="card-title">Pilih Tanggal</div>

            <div class="calendar">
                <div class="cal-header">
                    <button class="cal-nav" onclick="prevMonth()">&#8249;</button>
                    <span class="cal-month" id="cal-month-label"></span>
                    <button class="cal-nav" onclick="nextMonth()">&#8250;</button>
                </div>
                <div class="cal-grid" id="cal-grid"></div>
            </div>

            <div class="durasi-wrap">
                <div class="durasi-label">Durasi Sewa</div>
                <select class="durasi-select" id="durasi-select" onchange="updateSummary()">
                    <option value="1">1 Bulan</option>
                    <option value="2">2 Bulan</option>
                    <option value="3">3 Bulan</option>
                    <option value="6" selected>6 Bulan</option>
                    <option value="12">12 Bulan</option>
                </select>
            </div>

            <div class="checkout-info" id="checkout-info" style="display:none">
                <span>Tanggal Check - out (Estimasi)</span>
                <span id="checkout-date-text"></span>
            </div>
        </div>

        <!-- RIGHT: Ringkasan -->
        <div class="card">
            <div class="card-title">Ringkasan Biaya</div>

            <div class="summary-row">
                <span class="summary-label">Harga / Bulan</span>
                <span class="summary-value" id="summary-harga">Rp 0</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Durasi</span>
                <span class="summary-value" id="summary-durasi">-</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value" id="summary-subtotal">Rp 0</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Biaya Layanan</span>
                <span class="summary-value">Rp 50.000</span>
            </div>
            <div class="summary-row total">
                <span class="summary-label">Total</span>
                <span class="summary-value" id="summary-total">Rp 0</span>
            </div>

            <form method="POST" action="{{ route('booking.store') }}">
                @csrf
                <input type="hidden" name="kos_id" value="{{ $kos->id }}">
                <input type="hidden" name="tanggal_mulai" id="input-tanggal">
                <input type="hidden" name="durasi" id="input-durasi">
                <input type="hidden" name="total" id="input-total">

                <button type="submit" class="btn-lanjut" id="btn-lanjut" disabled
                    style="opacity:0.5; cursor:not-allowed;">
                    Lanjutkan Pembayaran
                </button>
            </form>
        </div>

    </div>

    <script>
        // Data dari Laravel
        const hargaPerBulan = {{ $kos->harga ?? 900000 }};
        const biayaLayanan  = 50000;

        // Calendar state
        let currentYear, currentMonth, selectedDate = null;

        const today = new Date();
        currentYear  = today.getFullYear();
        currentMonth = today.getMonth();

        const MONTHS = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const DAYS   = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];

        function renderCalendar() {
            const label = document.getElementById('cal-month-label');
            label.textContent = MONTHS[currentMonth] + ' ' + currentYear;

            const grid = document.getElementById('cal-grid');
            grid.innerHTML = '';

            // Day names
            DAYS.forEach(d => {
                const el = document.createElement('div');
                el.className = 'cal-day-name';
                el.textContent = d;
                grid.appendChild(el);
            });

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();

            // Empty cells
            for (let i = 0; i < firstDay; i++) {
                const el = document.createElement('div');
                el.className = 'cal-day empty';
                grid.appendChild(el);
            }

            // Days
            for (let d = 1; d <= totalDays; d++) {
                const el = document.createElement('div');
                el.className = 'cal-day';
                el.textContent = d;

                const thisDate = new Date(currentYear, currentMonth, d);
                const todayDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

                if (thisDate < todayDate) {
                    el.classList.add('past');
                } else {
                    if (thisDate.toDateString() === todayDate.toDateString()) el.classList.add('today');
                    if (selectedDate && thisDate.toDateString() === selectedDate.toDateString()) el.classList.add('selected');
                    el.addEventListener('click', () => selectDate(thisDate, d));
                }
                grid.appendChild(el);
            }
        }

        function selectDate(date, day) {
            selectedDate = date;
            renderCalendar();
            updateSummary();
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            renderCalendar();
        }

        function formatRupiah(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function formatTanggal(date) {
            return date.getDate().toString().padStart(2,'0') + ' ' + MONTHS[date.getMonth()] + ' ' + date.getFullYear();
        }

        function updateSummary() {
            const durasi   = parseInt(document.getElementById('durasi-select').value);
            const subtotal = hargaPerBulan * durasi;
            const total    = subtotal + biayaLayanan;

            document.getElementById('summary-harga').textContent    = formatRupiah(hargaPerBulan);
            document.getElementById('summary-durasi').textContent   = durasi + ' Bulan';
            document.getElementById('summary-subtotal').textContent = formatRupiah(subtotal);
            document.getElementById('summary-total').textContent    = formatRupiah(total);

            // Checkout estimate
            if (selectedDate) {
                const checkout = new Date(selectedDate);
                checkout.setMonth(checkout.getMonth() + durasi);
                document.getElementById('checkout-date-text').textContent = formatTanggal(checkout);
                document.getElementById('checkout-info').style.display = 'block';

                // Enable button
                const btn = document.getElementById('btn-lanjut');
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor  = 'pointer';

                // Update hidden inputs
                const y = selectedDate.getFullYear();
                const m = String(selectedDate.getMonth()+1).padStart(2,'0');
                const d = String(selectedDate.getDate()).padStart(2,'0');
                document.getElementById('input-tanggal').value = y+'-'+m+'-'+d;
                document.getElementById('input-durasi').value  = durasi;
                document.getElementById('input-total').value   = total;
            }
        }

        // Init
        renderCalendar();
        updateSummary();
    </script>

    </body>
</html>