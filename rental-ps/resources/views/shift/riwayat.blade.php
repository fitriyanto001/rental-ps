<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Riwayat Shift</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        :root { --bg-primary:#090d16; --bg-surface:#131926; --bg-card:rgba(26,33,50,0.65); --border-glow:rgba(255,255,255,0.08); --color-aktif:#3b82f6; }
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; background-color: var(--bg-primary); color: #f1f5f9; min-height: 100vh; }
        .ambient-bg { position: fixed; width: 40vw; height: 40vw; background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, rgba(0,0,0,0) 70%); top: -10vw; right: -10vw; z-index: -1; pointer-events: none; }
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, var(--bg-surface) 0%, #080b12 100%); border-right: 1px solid rgba(255,255,255,0.04); box-shadow: 10px 0 30px rgba(0,0,0,0.25); z-index: 10; }
        .sidebar .brand-container { border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: 20px; }
        .sidebar .nav-link { color: #94a3b8; padding: 12px 18px; border-radius: 10px; margin-bottom: 6px; transition: all 0.3s ease; font-weight: 500; display: flex; align-items: center; gap: 12px; font-size: 0.95rem; }
        .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.04); color: var(--color-aktif); }
        .sidebar .nav-link.active { background: linear-gradient(90deg, rgba(59,130,246,0.15) 0%, rgba(59,130,246,0.02) 100%); color: #60a5fa; border-left: 3px solid var(--color-aktif); font-weight: 600; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(16px); border: 1px solid var(--border-glow); border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(0,0,0,0.2); }
        .badge-glow-primary  { background: rgba(59,130,246,0.1); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); }
        .badge-glow-success  { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
        .badge-glow-danger   { background: rgba(239,68,68,0.1); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
        .badge-glow-secondary{ background: rgba(107,114,128,0.1); color: #cbd5e1; border: 1px solid rgba(107,114,128,0.2); }
        .form-control-dark { background-color: #1f2937 !important; border: 1px solid rgba(255,255,255,0.08) !important; color: #f8fafc !important; border-radius: 10px; padding: 10px 16px; }
        .form-control-dark:focus { border-color: var(--color-aktif) !important; box-shadow: 0 0 0 3px rgba(59,130,246,0.25) !important; outline: none; }
        .table-dark-custom { --bs-table-bg: transparent; --bs-table-color: #f1f5f9; --bs-table-border-color: rgba(255,255,255,0.05); margin-bottom: 0; }
        .table-dark-custom th { color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 16px; border-bottom: 2px solid rgba(255,255,255,0.08); }
        .table-dark-custom td { padding: 14px 16px; vertical-align: middle; font-size: 0.9rem; }
        .table-dark-custom tbody tr { transition: background-color 0.2s ease; cursor: pointer; }
        .table-dark-custom tbody tr:hover { background-color: rgba(59,130,246,0.04); }
        .pagination-custom .page-link { background-color: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); color: #94a3b8; padding: 8px 16px; margin: 0 2px; border-radius: 6px; transition: all 0.2s ease; }
        .pagination-custom .page-item.active .page-link { background-color: var(--color-aktif); border-color: var(--color-aktif); color: white; }
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
        <div class="d-flex justify-content-between align-items-center mb-4 gap-3 p-3 glass-panel">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2"><span>📋</span> RIWAYAT SHIFT KASIR</h5>
                    <small class="text-muted">Arsip semua shift yang pernah berjalan beserta rekap pendapatan</small>
                </div>
            </div>
            <a href="{{ route('shift.index') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold d-flex align-items-center gap-2">
                <i class="bi bi-calendar-check"></i> Shift Aktif
            </a>
        </div>

        <div class="glass-panel p-4 flex-grow-1">
            <!-- FILTER -->
            <form action="{{ route('shift.riwayat') }}" method="GET" class="row g-2 mb-4 align-items-center">
                <div class="col-sm-3">
                    <input type="text" name="kasir" class="form-control form-control-dark" placeholder="Cari nama kasir..." value="{{ request('kasir') }}">
                </div>
                <div class="col-sm-3">
                    <input type="date" name="tanggal" class="form-control form-control-dark" value="{{ request('tanggal') }}">
                </div>
                <div class="col-sm-2 d-flex gap-1">
                    <button type="submit" class="btn btn-outline-primary py-2 px-3 text-white border-primary border-opacity-30 w-50">Cari</button>
                    <a href="{{ route('shift.riwayat') }}" class="btn btn-outline-secondary py-2 px-3 text-white w-50"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </form>

            <div class="table-responsive border border-secondary border-opacity-10 rounded-3">
                <table class="table table-dark-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kasir</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Durasi</th>
                            <th>Transaksi</th>
                            <th>Rental</th>
                            <th>Kantin</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($shifts as $key => $shift)
                        <tr onclick="window.location='{{ route('shift.detail', $shift->id) }}'">
                            <td>{{ $shifts->firstItem() + $key }}</td>
                            <td class="fw-bold text-white">{{ $shift->kasir_name }}</td>
                            <td>{{ $shift->jam_buka->format('d/m/Y H:i') }}</td>
                            <td>{{ $shift->jam_tutup ? $shift->jam_tutup->format('d/m/Y H:i') : '-' }}</td>
                            <td>
                                @if($shift->jam_tutup)
                                    @php
                                        $dur = $shift->jam_buka->diff($shift->jam_tutup);
                                        echo $dur->h . 'j ' . $dur->i . 'm';
                                    @endphp
                                @else
                                    <span class="text-success">Berjalan...</span>
                                @endif
                            </td>
                            <td class="text-center fw-bold">{{ $shift->total_transaksi }}</td>
                            <td class="text-primary">Rp {{ number_format($shift->total_rental,0,',','.') }}</td>
                            <td class="text-success">Rp {{ number_format($shift->total_kantin,0,',','.') }}</td>
                            <td class="text-warning fw-bold">Rp {{ number_format($shift->grand_total,0,',','.') }}</td>
                            <td>
                                @if($shift->status == 'buka')
                                    <span class="badge badge-glow-success px-2 py-1">AKTIF</span>
                                @else
                                    <span class="badge badge-glow-secondary px-2 py-1">TUTUP</span>
                                @endif
                            </td>
                            <td class="text-center" onclick="event.stopPropagation()">
                                <a href="{{ route('shift.detail', $shift->id) }}" class="btn btn-sm btn-outline-info rounded-3 px-3">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>Belum ada riwayat shift.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($shifts->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 pagination-custom">
                <small class="text-muted">Menampilkan {{ $shifts->firstItem() ?? 0 }} - {{ $shifts->lastItem() ?? 0 }} dari {{ $shifts->total() }} shift</small>
                <div>{{ $shifts->links('pagination::bootstrap-4') }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
