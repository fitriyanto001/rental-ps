<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Detail Shift</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        :root { --bg-primary:#090d16; --bg-surface:#131926; --bg-card:rgba(26,33,50,0.65); --border-glow:rgba(255,255,255,0.08); --color-aktif:#3b82f6; }
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; background-color: var(--bg-primary); color: #f1f5f9; min-height: 100vh; }
        .ambient-bg { position: fixed; width: 40vw; height: 40vw; background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, rgba(0,0,0,0) 70%); top: -10vw; right: -10vw; z-index: -1; pointer-events: none; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, var(--bg-surface) 0%, #080b12 100%); border-right: 1px solid rgba(255,255,255,0.04); z-index: 10; }
        .sidebar .brand-container { border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: 20px; }
        .sidebar .nav-link { color: #94a3b8; padding: 12px 18px; border-radius: 10px; margin-bottom: 6px; transition: all 0.3s ease; font-weight: 500; display: flex; align-items: center; gap: 12px; font-size: 0.95rem; }
        .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.04); color: var(--color-aktif); }
        .sidebar .nav-link.active { background: linear-gradient(90deg, rgba(59,130,246,0.15) 0%, rgba(59,130,246,0.02) 100%); color: #60a5fa; border-left: 3px solid var(--color-aktif); font-weight: 600; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(16px); border: 1px solid var(--border-glow); border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(0,0,0,0.2); }
        .badge-glow-primary  { background: rgba(59,130,246,0.1); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); }
        .badge-glow-success  { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
        .badge-glow-secondary{ background: rgba(107,114,128,0.1); color: #cbd5e1; border: 1px solid rgba(107,114,128,0.2); }
        .table-dark-custom { --bs-table-bg: transparent; --bs-table-color: #f1f5f9; --bs-table-border-color: rgba(255,255,255,0.05); margin-bottom: 0; }
        .table-dark-custom th { color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 14px 16px; border-bottom: 2px solid rgba(255,255,255,0.08); }
        .table-dark-custom td { padding: 13px 16px; vertical-align: middle; font-size: 0.88rem; }
        .table-dark-custom tbody tr:hover { background-color: rgba(255,255,255,0.02); }
        .stat-mini { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 16px 20px; }
        @media print {
            .sidebar, .no-print { display: none !important; }
            .col-md-10 { width: 100% !important; max-width: 100% !important; flex: 0 0 100% !important; }
            .glass-panel { border: 1px solid #ddd !important; background: white !important; color: #000 !important; }
            body { background: white !important; color: #000 !important; }
            table { color: #000 !important; }
            th, td { color: #000 !important; border-color: #ccc !important; }
        }
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

<div class="container-fluid">
<div class="row">
    <!-- SIDEBAR -->
    <div class="col-md-2 p-0 sidebar d-flex flex-column justify-content-between p-4 text-white">
        <button class="sidebar-toggle-btn no-print" onclick="toggleSidebar()" title="Toggle Sidebar">
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
        <div class="mt-auto"><hr class="opacity-20 my-3">
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
        <div class="d-flex justify-content-between align-items-center mb-4 gap-3 p-3 glass-panel no-print">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                        <span>📄</span> DETAIL SHIFT — {{ $shift->kasir_name }}
                    </h5>
                    <small class="text-muted">{{ $shift->jam_buka->format('d M Y, H:i') }} WIB
                        @if($shift->jam_tutup) &rarr; {{ $shift->jam_tutup->format('H:i') }} WIB @endif
                    </small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('shift.riwayat') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-flex align-items-center gap-2 no-print">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-outline-info px-3 py-2 rounded-3 d-flex align-items-center gap-2 no-print">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <a href="{{ route('shift.riwayat') }}?export=excel&id={{ $shift->id }}" class="btn btn-outline-success px-3 py-2 rounded-3 d-flex align-items-center gap-2 no-print">
                    <i class="bi bi-file-earmark-excel"></i> Excel
                </a>
            </div>
        </div>

        <!-- INFO SHIFT -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-mini">
                    <div class="text-muted small mb-1"><i class="bi bi-person-fill me-1"></i>Kasir</div>
                    <div class="fw-bold text-white fs-5">{{ $shift->kasir_name }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-mini">
                    <div class="text-muted small mb-1"><i class="bi bi-door-open me-1"></i>Jam Buka</div>
                    <div class="fw-bold text-success">{{ $shift->jam_buka->format('H:i') }} WIB</div>
                    <div class="text-muted" style="font-size:11px;">{{ $shift->jam_buka->format('d M Y') }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-mini">
                    <div class="text-muted small mb-1"><i class="bi bi-door-closed me-1"></i>Jam Tutup</div>
                    @if($shift->jam_tutup)
                        <div class="fw-bold text-danger">{{ $shift->jam_tutup->format('H:i') }} WIB</div>
                        <div class="text-muted" style="font-size:11px;">{{ $shift->jam_tutup->format('d M Y') }}</div>
                    @else
                        <div class="fw-bold text-success">Masih Berjalan</div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-mini">
                    <div class="text-muted small mb-1"><i class="bi bi-clock me-1"></i>Durasi Shift</div>
                    @if($shift->jam_tutup)
                        @php $dur = $shift->jam_buka->diff($shift->jam_tutup); @endphp
                        <div class="fw-bold text-white">{{ $dur->h }} Jam {{ $dur->i }} Menit</div>
                    @else
                        <div class="fw-bold text-white">-</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- REKAP KEUANGAN -->
        <div class="glass-panel p-4 mb-4" style="border-color:rgba(245,158,11,0.2);">
            <h6 class="fw-bold text-warning mb-3"><i class="bi bi-cash-stack me-2"></i>Rekap Pendapatan Shift</h6>
            <div class="row g-3">
                <div class="col-6 col-md-2">
                    <div class="text-muted small">Total Transaksi</div>
                    <div class="fs-4 fw-bold text-white">{{ $shift->total_transaksi }}</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="text-muted small">Pendapatan Rental</div>
                    <div class="fw-bold text-primary">Rp {{ number_format($shift->total_rental,0,',','.') }}</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="text-muted small">Pendapatan Kantin</div>
                    <div class="fw-bold text-success">Rp {{ number_format($shift->total_kantin,0,',','.') }}</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="text-muted small">Total Diskon Member</div>
                    <div class="fw-bold text-danger">-Rp {{ number_format($shift->total_diskon,0,',','.') }}</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="text-muted small">GRAND TOTAL BERSIH</div>
                    <div class="fs-3 fw-bold text-warning">Rp {{ number_format($shift->grand_total,0,',','.') }}</div>
                </div>
            </div>
            @if($shift->catatan_handover)
            <hr class="opacity-20 mt-3 mb-2">
            <div class="d-flex gap-2 align-items-start">
                <i class="bi bi-chat-left-text text-info mt-1"></i>
                <div>
                    <div class="small text-white-50 mb-1">Catatan Handover</div>
                    <div class="text-white">{{ $shift->catatan_handover }}</div>
                </div>
            </div>
            @endif
        </div>

        <!-- TABEL TRANSAKSI -->
        <div class="glass-panel p-4 flex-grow-1">
            <h6 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-receipt"></i> Daftar Transaksi Dalam Shift Ini ({{ $transactions->count() }} Transaksi)
            </h6>
            <div class="table-responsive border border-secondary border-opacity-10 rounded-3">
                <table class="table table-dark-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penyewa</th>
                            <th>Unit PS</th>
                            <th>Durasi</th>
                            <th>Member</th>
                            <th>Rental</th>
                            <th>Kantin</th>
                            <th>Diskon</th>
                            <th>Grand Total</th>
                            <th>Waktu Checkout</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $key => $tx)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-bold text-white">{{ $tx->renter_name }}</td>
                            <td>{{ optional($tx->console)->name ?? '-' }}</td>
                            <td>{{ $tx->duration }} Jam</td>
                            <td>
                                @if($tx->member)
                                    <span class="badge badge-glow-primary px-2 py-1" style="font-size:10px;">{{ $tx->member->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-primary">Rp {{ number_format($tx->total_rental,0,',','.') }}</td>
                            <td class="text-success">Rp {{ number_format($tx->total_kantin,0,',','.') }}</td>
                            <td class="text-danger">
                                @if($tx->diskon > 0) -Rp {{ number_format($tx->diskon,0,',','.') }} @else - @endif
                            </td>
                            <td class="text-warning fw-bold">Rp {{ number_format($tx->grand_total,0,',','.') }}</td>
                            <td>{{ $tx->updated_at->format('H:i') }} WIB</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">
                                <i class="bi bi-receipt fs-2 d-block mb-2"></i>Belum ada transaksi lunas dalam shift ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($transactions->count() > 0)
                    <tfoot>
                        <tr style="border-top: 2px solid rgba(255,255,255,0.1);">
                            <td colspan="5" class="text-end fw-bold text-white-50 pt-3">TOTAL SHIFT:</td>
                            <td class="text-primary fw-bold pt-3">Rp {{ number_format($transactions->sum('total_rental'),0,',','.') }}</td>
                            <td class="text-success fw-bold pt-3">Rp {{ number_format($transactions->sum('total_kantin'),0,',','.') }}</td>
                            <td class="text-danger fw-bold pt-3">-Rp {{ number_format($transactions->sum('diskon'),0,',','.') }}</td>
                            <td class="text-warning fw-bold pt-3">Rp {{ number_format($transactions->sum('grand_total'),0,',','.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
