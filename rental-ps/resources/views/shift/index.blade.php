<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Manajemen Shift</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        :root {
            --bg-primary: #090d16; --bg-surface: #131926;
            --bg-card: rgba(26,33,50,0.65); --border-glow: rgba(255,255,255,0.08);
            --color-aktif: #3b82f6; --color-tersedia: #10b981;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; background-color: var(--bg-primary); color: #f1f5f9; min-height: 100vh; overflow-x: hidden; }
        .ambient-bg { position: fixed; width: 40vw; height: 40vw; background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, rgba(0,0,0,0) 70%); top: -10vw; right: -10vw; z-index: -1; pointer-events: none; }
        .ambient-bg-2 { position: fixed; width: 35vw; height: 35vw; background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, rgba(0,0,0,0) 70%); bottom: -5vw; left: -5vw; z-index: -1; pointer-events: none; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, var(--bg-surface) 0%, #080b12 100%); border-right: 1px solid rgba(255,255,255,0.04); box-shadow: 10px 0 30px rgba(0,0,0,0.25); z-index: 10; }
        .sidebar .brand-container { border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: 20px; }
        .sidebar .nav-link { color: #94a3b8; padding: 12px 18px; border-radius: 10px; margin-bottom: 6px; transition: all 0.3s cubic-bezier(0.4,0,0.2,1); font-weight: 500; display: flex; align-items: center; gap: 12px; font-size: 0.95rem; }
        .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.04); color: var(--color-aktif); }
        .sidebar .nav-link.active { background: linear-gradient(90deg, rgba(59,130,246,0.15) 0%, rgba(59,130,246,0.02) 100%); color: #60a5fa; border-left: 3px solid var(--color-aktif); font-weight: 600; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid var(--border-glow); border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(0,0,0,0.2); }
        .badge-glow-primary  { background: rgba(59,130,246,0.1); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); box-shadow: 0 0 12px rgba(59,130,246,0.15); }
        .badge-glow-success  { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
        .badge-glow-danger   { background: rgba(239,68,68,0.1); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
        .badge-glow-secondary{ background: rgba(107,114,128,0.1); color: #cbd5e1; border: 1px solid rgba(107,114,128,0.2); }
        .badge-glow-warning  { background: rgba(245,158,11,0.1); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }
        .form-control-dark, .form-select-dark { background-color: #1f2937 !important; border: 1px solid rgba(255,255,255,0.08) !important; color: #f8fafc !important; border-radius: 10px; padding: 12px 16px; transition: all 0.3s ease; }
        .form-control-dark:focus, .form-select-dark:focus { border-color: var(--color-aktif) !important; box-shadow: 0 0 0 3px rgba(59,130,246,0.25) !important; outline: none; }
        .form-control-dark::placeholder { color: #6b7280; }
        .stat-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 20px; transition: all 0.25s ease; }
        .stat-card:hover { background: rgba(255,255,255,0.04); }
        .live-timer { font-size: 2.5rem; font-weight: 800; font-variant-numeric: tabular-nums; letter-spacing: 2px; }
        .ps-aktif-card { background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.15); border-radius: 12px; padding: 14px 18px; }
        .dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .dot-buka { background: #10b981; box-shadow: 0 0 6px rgba(16,185,129,0.8); animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.4;} }
    </style>
</head>
<body>

<script>
    (function() {
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            document.body.classList.add('sidebar-collapsed');
        }
    })();
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
        const isCollapsed = document.body.classList.contains('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed ? 'true' : 'false');
    }
</script>

<div class="ambient-bg"></div>
<div class="ambient-bg-2"></div>

<div class="container-fluid">
<div class="row">

    <!-- SIDEBAR -->
    <div class="col-md-2 p-0 sidebar d-flex flex-column justify-content-between p-4 text-white">
        <button class="sidebar-toggle-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
            <i class="bi bi-chevron-left icon-close"></i>
            <i class="bi bi-chevron-right icon-open"></i>
        </button>
        <div>
            <div class="brand-container text-center my-3">
                <h4 class="fw-extrabold text-primary mb-1" style="letter-spacing:1.5px;">AJIS-PS</h4>
                <span class="badge badge-glow-primary text-uppercase" style="font-size:9px;letter-spacing:1.5px;font-weight:700;">MANAGEMENT SYSTEM</span>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item"><a href="/dashboard" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('kantin.menu') }}" class="nav-link"><i class="bi bi-shop"></i> Kasir Kantin</a></li>
                <li class="nav-item"><a href="{{ route('kantin.riwayat') }}" class="nav-link"><i class="bi bi-clock-history"></i> Riwayat Kantin</a></li>
                <li class="nav-item"><a href="{{ route('kantin.laporan') }}" class="nav-link"><i class="bi bi-file-earmark-bar-graph"></i> Laporan Kantin</a></li>
                <li class="nav-item"><a href="{{ route('member.index') }}" class="nav-link"><i class="bi bi-people"></i> Data Member</a></li>
                <li class="nav-item"><a href="{{ route('console.index') }}" class="nav-link"><i class="bi bi-sliders"></i> Kelola PS</a></li>
                <li class="nav-item"><a href="{{ route('shift.index') }}" class="nav-link active"><i class="bi bi-calendar-check"></i> Manajemen Shift</a></li>
            </ul>
        </div>
        <div class="mt-auto">
            <hr class="opacity-20 my-3">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="btn btn-outline-danger w-100 rounded-3 py-2 d-flex align-items-center justify-content-center gap-2" style="font-size:0.9rem;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Keluar
            </a>
        </div>
    </div>

    <!-- WORKSPACE -->
    <div class="col-md-10 p-4 min-vh-100 d-flex flex-column">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4 gap-3 p-3 glass-panel">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                        <span>🗂️</span> MANAJEMEN SHIFT KASIR
                    </h5>
                    <small class="text-muted">Kelola pergantian kasir, buka & tutup shift, dan cetak laporan serah terima</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="bg-dark px-3 py-2 rounded-3 border border-secondary border-opacity-30 fw-bold text-info" style="font-size:13.5px;">
                    <i class="bi bi-clock-fill me-2"></i><span id="liveClock">00:00:00 WIB</span>
                </div>
                <a href="{{ route('shift.riwayat') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-flex align-items-center gap-2">
                    <i class="bi bi-archive"></i> Riwayat Shift
                </a>
            </div>
        </div>

        @if(!$shiftAktif)
        {{-- ===== TIDAK ADA SHIFT AKTIF — FORM BUKA SHIFT ===== --}}
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="glass-panel p-5 text-center" style="border-color: rgba(59,130,246,0.2);">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                            style="width:80px;height:80px;background:rgba(59,130,246,0.1);border:2px solid rgba(59,130,246,0.3);">
                            <i class="bi bi-door-open fs-2 text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-white mb-1">Belum Ada Shift Aktif</h4>
                        <p class="text-muted mb-0">Buka shift baru untuk mulai mencatat transaksi kasir hari ini.</p>
                    </div>

                    <form action="{{ route('shift.buka') }}" method="POST">
                        @csrf
                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold text-white-50">Nama Kasir yang Bertugas</label>
                            <input type="text" name="kasir_name" class="form-control form-control-dark text-center fw-bold fs-5"
                                placeholder="Masukkan nama Anda..." required autocomplete="off" autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-door-open-fill"></i> BUKA SHIFT SEKARANG
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @else
        {{-- ===== ADA SHIFT AKTIF — DASHBOARD SHIFT ===== --}}

        {{-- INFO SHIFT BERJALAN --}}
        <div class="glass-panel p-4 mb-4" style="border-color:rgba(16,185,129,0.2);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="dot dot-buka"></span>
                        <span class="badge badge-glow-success px-3 py-2 fw-bold">SHIFT SEDANG BERJALAN</span>
                    </div>
                    <h3 class="fw-bold text-white mb-1">
                        <i class="bi bi-person-fill-check text-success me-2"></i>{{ $shiftAktif->kasir_name }}
                    </h3>
                    <div class="text-muted small">Shift dibuka sejak: <strong class="text-white">{{ $shiftAktif->jam_buka->format('d M Y, H:i') }} WIB</strong></div>
                </div>
                <div class="col-md-6 text-md-end text-start mt-3 mt-md-0">
                    <div class="text-white-50 small mb-1">Durasi Shift Berjalan</div>
                    <div class="live-timer text-success" id="shiftTimer">00:00:00</div>
                </div>
            </div>
        </div>

        {{-- REKAP PENDAPATAN SHIFT INI --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card text-center">
                    <div class="fs-2 fw-bold text-white">{{ $ringkasan['total_transaksi'] }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-receipt me-1"></i>Transaksi Lunas</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center" style="border-color:rgba(59,130,246,0.2);">
                    <div class="fs-5 fw-bold text-primary">Rp {{ number_format($ringkasan['total_rental'],0,',','.') }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-controller me-1"></i>Pendapatan Rental</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center" style="border-color:rgba(16,185,129,0.2);">
                    <div class="fs-5 fw-bold text-success">Rp {{ number_format($ringkasan['total_kantin'],0,',','.') }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-shop me-1"></i>Pendapatan Kantin</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center" style="border-color:rgba(245,158,11,0.2);">
                    <div class="fs-5 fw-bold text-warning">Rp {{ number_format($ringkasan['grand_total'],0,',','.') }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-cash-stack me-1"></i>Grand Total Shift</div>
                </div>
            </div>
        </div>

        {{-- HANDOVER — PS YANG MASIH AKTIF --}}
        @if($psAktif && $psAktif->count() > 0)
        <div class="glass-panel p-4 mb-4" style="border-color:rgba(239,68,68,0.2);">
            <h6 class="fw-bold text-danger mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                INFO HANDOVER — {{ $psAktif->count() }} Unit Masih Aktif Dimainkan
            </h6>
            <div class="row g-3">
                @foreach($psAktif as $ps)
                    @php $tx = $ps->transactions->first(); @endphp
                    <div class="col-md-4">
                        <div class="ps-aktif-card d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold text-white">{{ $ps->name }}</div>
                                <div class="small text-muted">Penyewa: <span class="text-white">{{ $tx->renter_name ?? '-' }}</span></div>
                                <div class="small text-muted">Mulai: <span class="text-warning">{{ optional($tx->created_at)->format('H:i') }} WIB</span></div>
                            </div>
                            <span class="badge badge-glow-danger">AKTIF</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="alert mt-3 mb-0 d-flex align-items-start gap-2 rounded-3" style="background:rgba(245,158,11,0.05);border:1px solid rgba(245,158,11,0.15);">
                <i class="bi bi-info-circle-fill text-warning mt-1"></i>
                <small class="text-warning">Shift dapat ditutup meski unit di atas masih aktif. Pastikan admin pengganti memahami sesi yang masih berjalan dan bertugas menyelesaikan checkout-nya.</small>
            </div>
        </div>
        @else
        <div class="glass-panel p-3 mb-4 d-flex align-items-center gap-3" style="border-color:rgba(16,185,129,0.2);">
            <i class="bi bi-check-circle-fill text-success fs-4"></i>
            <span class="text-success fw-semibold">Semua unit PlayStation sudah tidak aktif. Aman untuk menutup shift.</span>
        </div>
        @endif

        {{-- FORM TUTUP SHIFT --}}
        <div class="glass-panel p-4">
            <h6 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-door-closed-fill text-danger"></i> Tutup Shift & Serah Terima
            </h6>
            <form action="{{ route('shift.tutup') }}" method="POST" id="formTutupShift">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold text-white-50">Catatan Handover untuk Admin Berikutnya (Opsional)</label>
                    <textarea name="catatan_handover" rows="3" class="form-control form-control-dark"
                        placeholder="Contoh: PS4-01 pelanggan sudah main 2 jam, estimasi selesai jam 14:00. Stok Aqua tinggal 3 botol..."></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        Rekap pendapatan akan dihitung otomatis saat shift ditutup.
                    </div>
                    <button type="button" class="btn btn-danger px-4 py-2 fw-bold rounded-3 d-flex align-items-center gap-2"
                        onclick="confirmTutupShift()">
                        <i class="bi bi-door-closed-fill"></i> TUTUP SHIFT SEKARANG
                    </button>
                </div>
            </form>
        </div>

        @endif

    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function updateClock() {
        document.getElementById('liveClock').innerText = moment().format('HH:mm:ss') + ' WIB';
    }
    setInterval(updateClock, 1000);
    updateClock();

    @if($shiftAktif)
    // Live timer durasi shift
    const jamBuka = moment("{{ $shiftAktif->jam_buka->toISOString() }}");
    function updateShiftTimer() {
        const now = moment();
        const diff = moment.duration(now.diff(jamBuka));
        const h = String(Math.floor(diff.asHours())).padStart(2, '0');
        const m = String(diff.minutes()).padStart(2, '0');
        const s = String(diff.seconds()).padStart(2, '0');
        document.getElementById('shiftTimer').innerText = `${h}:${m}:${s}`;
    }
    setInterval(updateShiftTimer, 1000);
    updateShiftTimer();

    function confirmTutupShift() {
        Swal.fire({
            title: '🔒 Tutup Shift?',
            html: `Anda akan menutup shift <strong style="color:#60a5fa;">{{ $shiftAktif->kasir_name }}</strong>.<br><small style="color:#94a3b8;">Rekap pendapatan akan disimpan dan shift akan berakhir.</small>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4b5563',
            confirmButtonText: 'Ya, Tutup Shift!',
            cancelButtonText: 'Batal',
            background: '#111827',
            color: '#f1f5f9'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formTutupShift').submit();
            }
        });
    }
    @endif

    @if(session('toast_success'))
    Swal.fire({ icon: 'success', title: 'Sukses', text: "{{ session('toast_success') }}", toast: true, position: 'top-end', showConfirmButton: false, timer: 3500, background: '#131926', color: '#f1f5f9', timerProgressBar: true });
    @endif
    @if(session('toast_error'))
    Swal.fire({ icon: 'error', title: 'Gagal', text: "{{ session('toast_error') }}", toast: true, position: 'top-end', showConfirmButton: false, timer: 4000, background: '#131926', color: '#f1f5f9', timerProgressBar: true });
    @endif
</script>
</body>
</html>
