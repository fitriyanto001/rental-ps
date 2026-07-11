<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Riwayat Penjualan Kantin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        :root {
            --bg-primary: #090d16;
            --bg-surface: #131926;
            --bg-card: rgba(26, 33, 50, 0.65);
            --border-glow: rgba(255, 255, 255, 0.08);
            
            --color-tersedia: #10b981;
            --color-aktif: #3b82f6;
            --color-rusak: #ef4444;
            --color-offline: #6b7280;
            
            --glow-tersedia: rgba(16, 185, 129, 0.25);
            --glow-aktif: rgba(59, 130, 246, 0.25);
            --glow-rusak: rgba(239, 68, 68, 0.25);
            --glow-offline: rgba(107, 114, 128, 0.15);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: var(--bg-primary);
            color: #f1f5f9;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .ambient-bg {
            position: fixed;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, rgba(0,0,0,0) 70%);
            top: -10vw;
            right: -10vw;
            z-index: -1;
            pointer-events: none;
        }

        .ambient-bg-2 {
            position: fixed;
            width: 35vw;
            height: 35vw;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, rgba(0,0,0,0) 70%);
            bottom: -5vw;
            left: -5vw;
            z-index: -1;
            pointer-events: none;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--bg-surface) 0%, #080b12 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.04);
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.25);
            z-index: 10;
        }

        .sidebar .brand-container {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding-bottom: 20px;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }

        .sidebar .nav-link i {
            font-size: 1.15rem;
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.04);
            color: var(--color-aktif);
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.1);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.02) 100%);
            color: #60a5fa;
            border-left: 3px solid var(--color-aktif);
            font-weight: 600;
        }

        /* Glassmorphism Panel */
        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glow);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }

        .badge-glow-primary {
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 0 12px rgba(59, 130, 246, 0.15);
        }

        .badge-glow-secondary {
            background: rgba(107, 114, 128, 0.1);
            color: #cbd5e1;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .form-control-dark {
            background-color: #1f2937 !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #f8fafc !important;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control-dark:focus {
            border-color: var(--color-aktif) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25) !important;
            outline: none;
        }

        .form-control-dark::placeholder {
            color: #6b7280;
        }

        .table-dark-custom {
            --bs-table-bg: transparent;
            --bs-table-color: #f1f5f9;
            --bs-table-border-color: rgba(255, 255, 255, 0.05);
            margin-bottom: 0;
        }

        .table-dark-custom th {
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.08);
        }

        .table-dark-custom td {
            padding: 16px;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .table-dark-custom tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-dark-custom tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .pagination-custom .page-link {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #94a3b8;
            padding: 8px 16px;
            margin: 0 2px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .pagination-custom .page-link:hover {
            background-color: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
            border-color: rgba(59, 130, 246, 0.2);
        }

        .pagination-custom .page-item.active .page-link {
            background-color: var(--color-aktif);
            border-color: var(--color-aktif);
            color: white;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.25);
        }

        .pagination-custom .page-item.disabled .page-link {
            background-color: transparent;
            border-color: rgba(255, 255, 255, 0.02);
            color: #4b5563;
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
<div class="ambient-bg-2"></div>

<div class="container-fluid">
    <div class="row">
        
        <!-- SIDEBAR MENU -->
        <div class="col-md-2 p-0 sidebar d-flex flex-column justify-content-between p-4 text-white">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
                <i class="bi bi-chevron-left icon-close"></i>
                <i class="bi bi-chevron-right icon-open"></i>
            </button>
            <div>
                <div class="brand-container text-center my-3">
                    <h4 class="fw-extrabold text-primary mb-1" style="letter-spacing: 1.5px;">AJIS-PS</h4>
                    <span class="badge badge-glow-primary text-uppercase" style="font-size: 9px; letter-spacing: 1.5px; font-weight: 700;">MANAGEMENT SYSTEM</span>
                </div>
                
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kantin.menu') }}" class="nav-link">
                            <i class="bi bi-shop"></i> Kasir Kantin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kantin.riwayat') }}" class="nav-link active">
                            <i class="bi bi-clock-history"></i> Riwayat Kantin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kantin.laporan') }}" class="nav-link">
                            <i class="bi bi-file-earmark-bar-graph"></i> Laporan Kantin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('member.index') }}" class="nav-link">
                            <i class="bi bi-people"></i> Data Member
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('console.index') }}" class="nav-link">
                            <i class="bi bi-sliders"></i> Kelola PS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shift.index') }}" class="nav-link">
                            <i class="bi bi-calendar-check"></i> Manajemen Shift
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="mt-auto">
                <hr class="opacity-20 my-3">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="btn btn-outline-danger w-100 rounded-3 py-2 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </a>
            </div>
        </div>

        <!-- WORKSPACE UTAMA -->
        <div class="col-md-10 p-4 min-vh-100 d-flex flex-column">
            
            <!-- HEADER UTAMA -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3 p-3 glass-panel">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                            <span>📜</span> RIWAYAT PENJUALAN KANTIN
                        </h5>
                        <small class="text-muted">Pantau data omset kantin dan rincian transaksi billing gabungan</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 w-100 w-sm-auto justify-content-between justify-content-sm-end">
                    <div class="bg-dark px-3 py-2 rounded-3 border border-secondary border-opacity-30 fw-bold text-info" style="font-size: 13.5px;">
                        <i class="bi bi-clock-fill me-2"></i><span id="liveClock">00:00:00 WIB</span>
                    </div>
                    <span class="badge badge-glow-secondary p-2 d-flex align-items-center gap-2" style="font-size: 12.5px;">
                        <i class="bi bi-person-circle text-info"></i> {{ Auth::user()->name }}
                    </span>
                </div>
            </div>

            <!-- TABEL DAN FILTER -->
            <div class="glass-panel p-4 flex-grow-1">
                
                <!-- TOMBOL ACTION & SEARCH BAR -->
                <div class="row g-3 mb-4 align-items-end justify-content-between">
                    <div class="col-xl-8 col-lg-7">
                        <form action="{{ route('kantin.riwayat') }}" method="GET" class="row g-2 align-items-end">
                            <div class="col-sm-4">
                                <label class="text-white-50 small mb-1">Cari Pelanggan/PS/Makanan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary border-opacity-30 text-muted"><i class="bi bi-search"></i></span>
                                    <input type="text" name="search" class="form-control form-control-dark" placeholder="Ketik pencarian..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="text-white-50 small mb-1">Mulai Tanggal</label>
                                <input type="date" name="start_date" class="form-control form-control-dark" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-sm-3">
                                <label class="text-white-50 small mb-1">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control form-control-dark" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-sm-2 d-flex gap-1">
                                <button type="submit" class="btn btn-outline-primary py-2 px-3 text-white border-primary border-opacity-30 w-50" title="Filter Data">
                                    <i class="bi bi-filter"></i>
                                </button>
                                <a href="{{ route('kantin.riwayat') }}" class="btn btn-outline-secondary py-2 px-3 text-white border-secondary border-opacity-30 w-50" title="Reset Filter">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-xl-4 col-lg-5 text-lg-end text-start">
                        <div class="d-inline-flex gap-2 w-100 w-sm-auto">
                            <!-- Tombol Cetak Nota Riwayat / PDF -->
                            <a href="{{ route('kantin.riwayat.print', request()->query()) }}" target="_blank" class="btn btn-outline-info px-3 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-printer-fill"></i> Cetak Laporan
                            </a>
                            <a href="{{ route('kantin.riwayat.print', array_merge(request()->query(), ['pdf' => 1])) }}" target="_blank" class="btn btn-outline-danger px-3 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
                            </a>
                            <!-- Tombol Export Excel -->
                            <a href="{{ route('kantin.riwayat.export_excel', request()->query()) }}" class="btn btn-success px-3 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TABLE RIWAYAT -->
                <div class="table-responsive border border-secondary border-opacity-10 rounded-3">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
                                <th style="width: 150px;">Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama PS</th>
                                <th>Daftar Menu</th>
                                <th style="width: 80px;" class="text-center">Qty</th>
                                <th>Total Kantin</th>
                                <th>Total Rental</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $tx)
                                <tr>
                                    <td>{{ $tx->created_at->format('d M Y H:i') }} WIB</td>
                                    <td class="fw-bold text-white">{{ $tx->renter_name }}</td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-20 text-light border border-secondary border-opacity-30">
                                            {{ $tx->console->name ?? 'PS Terhapus' }}
                                        </span>
                                    </td>
                                    <td>
                                        @forelse($tx->transactionFoods as $food)
                                            <div class="small text-white-50">
                                                {{ $food->menuKantin->nama_menu ?? 'Menu Terhapus' }}
                                            </div>
                                        @empty
                                            <span class="text-muted small">-</span>
                                        @endforelse
                                    </td>
                                    <td class="text-center">
                                        @forelse($tx->transactionFoods as $food)
                                            <div class="small fw-bold">x{{ $food->qty }}</div>
                                        @empty
                                            <span class="text-muted small">-</span>
                                        @endforelse
                                    </td>
                                    <td class="fw-semibold text-info">
                                        Rp {{ number_format($tx->total_kantin, 0, ',', '.') }}
                                    </td>
                                    <td class="text-white-50">
                                        Rp {{ number_format($tx->total_rental, 0, ',', '.') }}
                                    </td>
                                    <td class="fw-bold text-warning">
                                        Rp {{ number_format($tx->grand_total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                        Tidak ditemukan data riwayat transaksi penjualan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                @if($transactions->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 pagination-custom">
                        <small class="text-muted">Menampilkan {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} dari {{ $transactions->total() }} data</small>
                        <div>
                            {{ $transactions->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<script>
    // Live Clock Kasir
    function updateClock() {
        const now = moment();
        document.getElementById('liveClock').innerText = now.format('HH:mm:ss') + " WIB";
    }
    setInterval(updateClock, 1000);
    window.onload = updateClock;
</script>
</body>
</html>
