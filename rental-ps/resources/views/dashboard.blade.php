<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Premium Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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

        /* Ambient background glow */
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

        /* Widget Cards */
        .widget-card {
            border-radius: 14px;
            padding: 20px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .widget-card:hover {
            transform: translateY(-3px);
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Modernized filter buttons */
        .filter-btn-modern {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(255, 255, 255, 0.03);
            color: #94a3b8;
        }

        .filter-btn-modern:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #f1f5f9;
        }

        .filter-btn-modern.active {
            background: var(--color-aktif);
            color: #fff;
            border-color: var(--color-aktif);
            box-shadow: 0 4px 15px var(--glow-aktif);
        }

        /* Console Cards */
        .card-ps {
            min-height: 270px;
            background: rgba(20, 27, 43, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: relative;
            position: relative;
        }

        .card-ps::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            transition: all 0.3s ease;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        /* Status Colors & Glows */
        .card-ps.status-tersedia {
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.03);
        }
        .card-ps.status-tersedia::before {
            background: linear-gradient(90deg, #10b981, #059669);
        }
        .card-ps.status-tersedia:hover {
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.12);
            border-color: rgba(16, 185, 129, 0.3);
            transform: translateY(-5px);
        }

        .card-ps.status-aktif {
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.03);
        }
        .card-ps.status-aktif::before {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
        }
        .card-ps.status-aktif:hover {
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.12);
            border-color: rgba(59, 130, 246, 0.3);
            transform: translateY(-5px);
        }

        .card-ps.status-rusak {
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.03);
        }
        .card-ps.status-rusak::before {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }
        .card-ps.status-rusak:hover {
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.12);
            border-color: rgba(239, 68, 68, 0.3);
            transform: translateY(-5px);
        }

        .card-ps.status-offline {
            box-shadow: 0 4px 20px rgba(156, 163, 175, 0.03);
        }
        .card-ps.status-offline::before {
            background: linear-gradient(90deg, #6b7280, #4b5563);
        }
        .card-ps.status-offline:hover {
            box-shadow: 0 10px 25px rgba(156, 163, 175, 0.12);
            border-color: rgba(156, 163, 175, 0.3);
            transform: translateY(-5px);
        }

        /* Gowing Badges */
        .badge-glow-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
            box-shadow: 0 0 12px rgba(16, 185, 129, 0.15);
        }

        .badge-glow-primary {
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 0 12px rgba(59, 130, 246, 0.15);
        }

        .badge-glow-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.2);
            box-shadow: 0 0 12px rgba(245, 158, 11, 0.15);
        }

        .badge-glow-secondary {
            background: rgba(107, 114, 128, 0.1);
            color: #cbd5e1;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        /* Custom Dropdown styling */
        .dropdown-menu-dark {
            background-color: #161f30;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
            border-radius: 12px;
        }

        .dropdown-item {
            color: #94a3b8;
            padding: 8px 16px;
            font-size: 0.88rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }

        .dropdown-item i {
            font-size: 1rem;
        }

        /* Dark Modals */
        .modal-content-dark {
            background-color: #111827;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #f1f5f9;
            border-radius: 16px;
        }

        .modal-header-dark {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 20px;
        }

        .modal-footer-dark {
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding: 16px 20px;
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

        /* Scenario check cards in checkout modal */
        .scenario-card {
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: #1f2937;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .scenario-card:hover {
            border-color: rgba(255, 255, 255, 0.12);
        }

        .form-check-input:checked + .scenario-label-wrapper {
            color: #fff;
        }

        /* Ticking Timer */
        .countdown-timer {
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Print formatting */
        #nota-print-area { display: none; }

        @media print {
            body * { visibility: hidden; }
            #nota-print-area, #nota-print-area * { visibility: visible; }
            #nota-print-area {
                display: block !important;
                position: absolute;
                left: 0; top: 0; width: 58mm;
                font-family: 'Courier New', Courier, monospace;
                font-size: 11px; color: #000; line-height: 1.2;
                background-color: #fff;
                padding: 10px;
            }
            .garis-putus { border-top: 1px dashed #000; margin: 5px 0; }
            .text-center { text-align: center; }
            .d-flex-print { display: flex; justify-content: space-between; }
            @page { size: auto; margin: 0mm; }
        }
    </style>
</head>
<body>

<div class="ambient-bg"></div>
<div class="ambient-bg-2"></div>

<div class="container-fluid">
    <div class="row">
        
        <!-- SIDEBAR MENU -->
        <div class="col-md-2 p-0 sidebar d-flex flex-column justify-content-between p-4 text-white">
            <div>
                <div class="brand-container text-center my-3">
                    <h4 class="fw-extrabold text-primary mb-1" style="letter-spacing: 1.5px;">AJIS-PS</h4>
                    <span class="badge badge-glow-primary text-uppercase" style="font-size: 9px; letter-spacing: 1.5px; font-weight: 700;">MANAGEMENT SYSTEM</span>
                </div>
                
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link active">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kantin.menu') }}" class="nav-link">
                            <i class="bi bi-shop"></i> Kasir Kantin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kantin.riwayat') }}" class="nav-link">
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
            
            <!-- HEADER UTAMA + JAM DIGITAL LIVE -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3 p-3 glass-panel">
                <div>
                    <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                        <span>🖥️</span> DASHBOARD UTAMA MONITORING
                    </h5>
                    <small class="text-muted">Pantau status, sisa billing, dan kelola operasional rental secara real-time</small>
                </div>
                <div class="d-flex align-items-center gap-3 w-100 w-sm-auto justify-content-between justify-content-sm-end flex-wrap">
                    <!-- Jam Digital Live Kasir -->
                    <div class="bg-dark px-3 py-2 rounded-3 border border-secondary border-opacity-30 fw-bold text-info" style="font-size: 13.5px;">
                        <i class="bi bi-clock-fill me-2"></i><span id="liveClock">00:00:00 WIB</span>
                    </div>
                    <!-- User Logged In Info -->
                    <span class="badge badge-glow-secondary p-2 d-flex align-items-center gap-2" style="font-size: 12.5px;">
                        <i class="bi bi-person-circle text-info"></i> {{ Auth::user()->name }}
                    </span>
                    @if($shiftAktif)
                        <!-- Shift Aktif Info -->
                        <a href="{{ route('shift.index') }}" class="badge badge-glow-success p-2 d-flex align-items-center gap-2 text-decoration-none" style="font-size: 12.5px;">
                            <span style="width:7px;height:7px;border-radius:50%;background:#10b981;box-shadow:0 0 6px rgba(16,185,129,0.8);display:inline-block;animation:pulse 1.5s infinite;"></span>
                            Shift: {{ $shiftAktif->kasir_name }}
                        </a>
                    @else
                        <!-- Tidak Ada Shift Aktif -->
                        <a href="{{ route('shift.index') }}" class="badge badge-glow-danger p-2 d-flex align-items-center gap-2 text-decoration-none" style="font-size: 12.5px;" title="Klik untuk buka shift">
                            <i class="bi bi-exclamation-triangle-fill"></i> Belum Ada Shift Aktif
                        </a>
                    @endif
                </div>
            </div>

            <!-- 1. WIDGET RINGKASAN STATUS -->
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-sm-6">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary bg-opacity-20 rounded-3 text-primary border border-primary border-opacity-20">
                            <i class="bi bi-play-circle-fill fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">TOTAL UNIT AKTIF</small>
                            <h4 class="m-0 fw-bold text-white mt-1">{{ $consoles->where('status', 'aktif')->count() }} PS</h4>
                        </div>  
                    </div>  
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-success bg-opacity-20 rounded-3 text-success border border-success border-opacity-20">
                            <i class="bi bi-check-circle-fill fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">KOSONG / TERSEDIA</small>
                            <h4 class="m-0 fw-bold text-white mt-1">{{ $consoles->where('status', 'tersedia')->count() }} PS</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-warning bg-opacity-20 rounded-3 text-warning border border-warning border-opacity-20">
                            <i class="bi bi-exclamation-octagon-fill fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">MAINTENANCE / OFFLINE</small>
                            <h4 class="m-0 fw-bold text-white mt-1">{{ $consoles->whereIn('status', ['rusak', 'offline'])->count() }} PS</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. TOMBOL FILTER CEPAT -->
            <div class="d-flex flex-wrap gap-2 mb-4 p-2 glass-panel rounded-3">
                <button type="button" class="btn filter-btn-modern active" onclick="filterPSModern(this, 'semua')">
                    <i class="bi bi-grid-fill me-1"></i> Semua Unit
                </button>
                <button type="button" class="btn filter-btn-modern" onclick="filterPSModern(this, 'tersedia')">
                    <i class="bi bi-check-circle me-1"></i> Hanya Kosong
                </button>
                <button type="button" class="btn filter-btn-modern" onclick="filterPSModern(this, 'aktif')">
                    <i class="bi bi-play-fill me-1"></i> Hanya Aktif
                </button>
                <button type="button" class="btn filter-btn-modern" onclick="filterPSModern(this, 'PS4')">
                    <i class="bi bi-controller me-1"></i> Khusus PS4
                </button>
                <button type="button" class="btn filter-btn-modern" onclick="filterPSModern(this, 'PS5')">
                    <i class="bi bi-controller me-1 text-info"></i> Khusus PS5
                </button>
            </div>

            <!-- GRID DAFTAR PS -->
            <div class="row g-4" id="gridConsoleContainer">
                @foreach($consoles as $console)
                    <div class="col-xl-3 col-md-4 col-sm-6 mb-2 item-ps-card" data-status="{{ $console->status }}" data-tipe="{{ $console->type }}">
                        <div class="card card-ps status-{{ $console->status }} h-100">
                            
                            <!-- Dropdown Quick Actions / Pengaturan PS (Untuk Akses Fitur) -->
                            <div class="dropdown position-absolute top-0 end-0 m-3">
                                <button class="btn btn-link text-white text-opacity-50 p-1 border-0 hover:text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Ubah Status Unit</h6></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('console.available', $console->id) }}">
                                            <i class="bi bi-check-circle me-2 text-success"></i> Atur Tersedia (Kosong)
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('console.broken', $console->id) }}">
                                            <i class="bi bi-exclamation-triangle me-2 text-warning"></i> Atur Rusak (Maintenance)
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('console.offline', $console->id) }}">
                                            <i class="bi bi-power me-2 text-danger"></i> Atur Offline
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between p-4">
                                
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-controller fs-4 text-white text-opacity-80"></i>
                                        <h5 class="card-title fw-bold text-white m-0">{{ $console->name }}</h5>
                                    </div>
                                    <span class="badge bg-secondary bg-opacity-20 text-light border border-secondary border-opacity-30 text-uppercase mb-3" style="font-size: 10px;">
                                        Tipe: {{ $console->type }}
                                    </span>
                                    
                                    <div class="my-2">
                                        @if($console->status == 'tersedia')
                                            <span class="badge badge-glow-success px-3 py-2 rounded-pill fw-bold">READY TO PLAY</span>
                                            <div class="text-white text-opacity-50 small mt-3"><i class="bi bi-hourglass-bottom me-1"></i>Sisa: --:--:--</div>
                                            <div class="text-white text-opacity-50 small"><i class="bi bi-ticket-perforated me-1"></i>Paket: -</div>
                                        @elseif($console->status == 'aktif')
                                            <span class="badge badge-glow-primary px-3 py-2 rounded-pill fw-bold">PLAYING</span>
                                            @php $activeTx = $console->transactions->first(); @endphp
                                            @if($activeTx)
                                                <div class="mt-3 p-3 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-20 text-start" style="font-size: 12.5px;">
                                                    <div class="text-white fw-semibold mb-2">
                                                        <i class="bi bi-person-fill text-info me-1"></i> {{ $activeTx->renter_name }}
                                                    </div>
                                                    @if($activeTx->duration > 0)
                                                        <div class="text-info fw-bold d-flex align-items-center gap-1">
                                                            <i class="bi bi-hourglass-split"></i> Sisa: 
                                                            <span class="countdown-timer text-warning" data-start="{{ $activeTx->created_at->toISOString() }}" data-duration="{{ $activeTx->duration }}">Menghitung...</span>
                                                        </div>
                                                        <div class="text-white text-opacity-65 mt-1">Paket: {{ $activeTx->duration }} Jam</div>
                                                    @else
                                                        <div class="text-warning fw-bold"><i class="bi bi-infinity me-1"></i> Paket: Open Bill (Los)</div>
                                                    @endif
                                                </div>
                                            @endif
                                        @elseif($console->status == 'rusak')
                                            <span class="badge badge-glow-warning px-3 py-2 rounded-pill fw-bold">MAINTENANCE</span>
                                            <div class="text-danger small fw-bold mt-3"><i class="bi bi-exclamation-triangle-fill me-1"></i>Unit Bermasalah / Stik Analog Error</div>
                                        @else
                                            <span class="badge badge-glow-secondary px-3 py-2 rounded-pill fw-bold">OFFLINE</span>
                                            <div class="text-white text-opacity-40 small mt-3"><i class="bi bi-power me-1"></i>Daya Dinonaktifkan</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4">
                                    @if($console->status == 'tersedia')
                                        <button type="button" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#rentModal{{ $console->id }}">
                                            <i class="bi bi-play-circle-fill"></i> MULAI BILLING
                                        </button>
                                    @elseif($console->status == 'aktif')
                                        <button type="button" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#checkoutModal{{ $console->id }}"
                                            onclick="hitungCheckout('{{ $console->id }}', '{{ $activeTx->created_at ?? '' }}', '{{ $activeTx->duration ?? 0 }}', '{{ $activeTx->renter_name ?? 'Pelanggan' }}', '{{ $console->name }}', {{ $activeTx->member->discount_percentage ?? 0 }})">
                                            <i class="bi bi-stop-circle-fill"></i> STOP BILLING
                                        </button>
                                    @else
                                        <!-- Jika rusak/offline, berikan kemudahan agar langsung bisa diaktifkan kembali lewat tombol utama -->
                                        <a href="{{ route('console.available', $console->id) }}" class="btn btn-outline-success w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                                            <i class="bi bi-check-circle-fill"></i> AKTIFKAN UNIT
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<!-- MODAL MULAI BILLING -->
@foreach($consoles as $console)
<div class="modal fade" id="rentModal{{ $console->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2">
                    <i class="bi bi-play-circle-fill text-primary"></i> Mulai Billing - {{ $console->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('console.start', $console->id) }}" method="GET">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Tipe Pelanggan</label>
                        <select id="member_toggle_{{ $console->id }}" class="form-select form-control-dark" onchange="toggleMemberSelect('{{ $console->id }}')">
                            <option value="non_member">Pelanggan Umum (Bukan Member)</option>
                            <option value="member">Member Terdaftar</option>
                        </select>
                    </div>
                    
                    <div class="mb-3" id="member_select_container_{{ $console->id }}" style="display: none;">
                        <label class="form-label fw-bold text-white-50">Pilih Member</label>
                        <select name="member_id" id="member_id_{{ $console->id }}" class="form-select form-control-dark" onchange="onSelectMember('{{ $console->id }}')">
                            <option value="">-- Pilih Member --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" data-name="{{ $member->name }}">{{ $member->name }} (Diskon {{ $member->discount_percentage }}%)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Nama Penyewa</label>
                        <input type="text" name="renter_name" id="renter_name_{{ $console->id }}" class="form-control form-control-dark" placeholder="Masukkan nama pelanggan" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Durasi Main (Jam)</label>
                        <input type="number" name="duration" class="form-control form-control-dark" min="0" placeholder="Ketik 0 jika Open Bill / Tarif Los" required>
                        <div class="form-text text-white-50 mt-1" style="font-size: 11px;">Ketik 0 untuk mode Open Bill (dihitung berdasarkan durasi nyata saat billing distop)</div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-dark">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">MULAI MAIN 🚀</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- POP-UP LAYAR MONITOR: STOP BILLING & CHECKOUT -->
@foreach($consoles as $console)
@php $activeTx = $console->transactions->first(); @endphp
<div class="modal fade" id="checkoutModal{{ $console->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark bg-dark">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2">
                    <i class="bi bi-receipt-cutoff text-info"></i> CHECKOUT KASIR - {{ $console->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('console.checkout', $console->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    
                    <h6 class="fw-bold text-info border-bottom border-secondary border-opacity-30 pb-2 mb-3">
                        <i class="bi bi-person-fill-gear"></i> DATA RENTAL
                    </h6>
                    <div class="row mb-4 bg-dark bg-opacity-40 p-3 rounded-3 border border-secondary border-opacity-10 g-3">
                        <div class="col-sm-6">
                            <span class="text-white-50 small d-block">Pelanggan:</span>
                            <span class="fw-bold text-white fs-6">{{ $activeTx->renter_name ?? '-' }}</span>
                            <hr class="my-2 opacity-10">
                            <span class="text-white-50 small d-block">Paket Awal:</span>
                            <span class="fw-bold text-white">{{ ($activeTx && $activeTx->duration > 0) ? $activeTx->duration . ' Jam' : 'Open Bill' }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-white-50 small d-block">Mulai Jam:</span>
                            <span class="fw-bold text-white" id="txtMulai{{ $console->id }}">-</span>
                            <hr class="my-2 opacity-10">
                            <span class="text-white-50 small d-block">Durasi Nyata:</span>
                            <span class="fw-bold text-info" id="txtDurasiNyata{{ $console->id }}">-</span>
                        </div>
                    </div>

                    <h6 class="fw-bold text-info border-bottom border-secondary border-opacity-30 pb-2 mb-3">
                        <i class="bi bi-currency-dollar"></i> KEBIJAKAN BIAYA
                    </h6>
                    <div class="d-flex flex-column gap-2 mb-4">
                        <div class="scenario-card d-flex align-items-center gap-3">
                            <input class="form-check-input flex-shrink-0" type="radio" name="skenario_biaya_{{ $console->id }}" id="skenA{{ $console->id }}" value="A" onchange="hitungTotalAkhir('{{ $console->id }}')">
                            <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="skenA{{ $console->id }}">
                                <div>
                                    <strong class="text-white d-block">Skenario A: Uang Hangus</strong>
                                    <span class="text-white-50 small" style="font-size: 11px;">Biaya dihitung penuh sesuai paket awal yang dipilih</span>
                                </div>
                                <span class="fw-extrabold text-danger fs-5 ms-2" id="hargaSkenA{{ $console->id }}">Rp 0</span>
                            </label>
                        </div>
                        <div class="scenario-card d-flex align-items-center gap-3">
                            <input class="form-check-input flex-shrink-0" type="radio" name="skenario_biaya_{{ $console->id }}" id="skenB{{ $console->id }}" value="B" checked onchange="hitungTotalAkhir('{{ $console->id }}')">
                            <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="skenB{{ $console->id }}">
                                <div>
                                    <strong class="text-white d-block">Skenario B: Hitung Ulang (Disarankan)</strong>
                                    <span class="text-white-50 small" style="font-size: 11px;">Biaya dihitung proporsional mengikuti durasi nyata main</span>
                                </div>
                                <span class="fw-extrabold text-success fs-5 ms-2" id="hargaSkenB{{ $console->id }}">Rp 0</span>
                            </label>
                        </div>
                    </div>

                    <h6 class="fw-bold text-info border-bottom border-secondary border-opacity-30 pb-2 mb-3">
                        <i class="bi bi-cart-fill"></i> KANTIN & MAKANAN
                    </h6>
                    <div class="row g-3 mb-4 overflow-y-auto" style="max-height: 250px;">
                        @forelse($menuKantin as $menu)
                            <div class="col-sm-6">
                                <div class="p-3 bg-dark bg-opacity-40 rounded-3 border border-secondary border-opacity-10 d-flex align-items-center justify-content-between">
                                    <div class="flex-grow-1 me-2">
                                        <label class="text-white fw-semibold d-block" style="font-size: 13.5px;">{{ $menu->nama_menu }}</label>
                                        <span class="text-info fw-bold" style="font-size: 12.5px;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                        @if($menu->stok <= 0 || $menu->status == 'Habis')
                                            <span class="badge bg-danger ms-1" style="font-size: 9px;">Habis</span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-30 text-white-50 ms-1" style="font-size: 9px;">Stok: {{ $menu->stok }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary px-2 text-white border-secondary border-opacity-40" onclick="decQty('{{ $console->id }}', '{{ $menu->id }}')" {{ ($menu->stok <= 0 || $menu->status == 'Habis') ? 'disabled' : '' }}>-</button>
                                        <input type="number" name="food[{{ $menu->id }}]" id="qty_{{ $console->id }}_{{ $menu->id }}" class="form-control form-control-sm text-center bg-transparent border-0 text-white fw-bold qty-input-{{ $console->id }}" value="0" min="0" max="{{ $menu->stok }}" readonly style="width: 32px;" data-harga="{{ $menu->harga }}" data-nama="{{ $menu->nama_menu }}">
                                        <button type="button" class="btn btn-sm btn-outline-secondary px-2 text-white border-secondary border-opacity-40" id="btn_add_{{ $console->id }}_{{ $menu->id }}" onclick="incQty('{{ $console->id }}', '{{ $menu->id }}', {{ $menu->stok }})" {{ ($menu->stok <= 0 || $menu->status == 'Habis') ? 'disabled' : '' }}>+</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-2 text-muted">
                                Belum ada menu kantin tersedia.
                            </div>
                        @endforelse
                    </div>

                    <div class="row g-3 mb-3 p-3 bg-dark bg-opacity-40 rounded-3 border border-secondary border-opacity-10 align-items-center" id="member_discount_info_{{ $console->id }}" style="display: none;">
                        <div class="col-6">
                            <span class="text-white-50 small d-block">Diskon Member:</span>
                            <span class="fw-bold text-success" id="lblMemberDiscountPercent_{{ $console->id }}">0%</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-white-50 small d-block">Potongan Harga (Sewa):</span>
                            <span class="fw-bold text-success fs-5" id="lblMemberDiscountAmount_{{ $console->id }}">-Rp 0</span>
                        </div>
                    </div>

                    <div class="bg-black bg-opacity-60 border border-warning border-opacity-20 p-3 rounded-3 text-center mb-4">
                        <small class="text-warning text-uppercase d-block fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">TOTAL YANG HARUS DIBAYAR</small>
                        <h2 class="fw-extrabold text-warning m-0" id="lblTotalBayar{{ $console->id }}">Rp 0</h2>
                    </div>

                    <div class="row g-3 p-3 bg-dark bg-opacity-40 rounded-3 border border-secondary border-opacity-10">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-white-50">Uang Diterima (Nominal Tunai)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-0 text-white fw-bold">Rp</span>
                                <input type="number" id="inputBayar{{ $console->id }}" class="form-control form-control-dark fs-5 fw-bold text-success" placeholder="0" oninput="hitungKembalian('{{ $console->id }}')" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <label class="form-label fw-bold text-white-50 mb-1">Kembalian Pelanggan</label>
                            <div class="fs-3 fw-bold text-danger" id="lblKembalian{{ $console->id }}">Rp 0</div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer modal-footer-dark bg-dark">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-success fw-bold px-4" onclick="prosesCetakNota('{{ $console->id }}')">
                        <i class="bi bi-printer-fill me-2"></i> BAYAR & CETAK STRUK
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- ====== 🧾 STRUK INDOMARET HIDDEN AREA ====== -->
<div id="nota-print-area">
    <div class="text-center">
        <strong>AJIS-PS RENTAL</strong><br>
        Jl. Kenangan No. 123<br>
        HP: 0812-3456-7890<br>
        <div class="garis-putus"></div>
    </div>
    <div class="d-flex-print"><span>Kasir:</span><span>Fitriyanto</span></div>
    <div class="d-flex-print"><span>Penyewa:</span><span id="p-nama-pelanggan">-</span></div>
    <div class="d-flex-print"><span>Device:</span><span id="p-nama-ps">-</span></div>
    <div class="d-flex-print"><span>Jam Mulai:</span><span id="p-jam-mulai">-</span></div>
    <div class="d-flex-print"><span>Total Main:</span><span id="p-durasi-nyata">-</span></div>
    <div class="garis-putus"></div>
    <div class="text-center">** RINCIAN NOTA **</div>
    <div class="garis-putus"></div>
    <div class="d-flex-print"><span id="p-label-sewa">Biaya Rental PS</span><span id="p-harga-sewa">Rp 0</span></div>
    <div id="p-diskon-member" class="d-flex-print" style="display: none;"><span>Diskon Member</span><span id="p-diskon-nilai">-Rp 0</span></div>
    <div id="p-list-kantin"></div>
    <div class="garis-putus"></div>
    <div class="d-flex-print" style="font-weight: bold;"><span>TOTAL:</span><span id="p-total-akhir">Rp 0</span></div>
    <div class="d-flex-print"><span>TUNAI:</span><span id="p-uang-tunai">Rp 0</span></div>
    <div class="d-flex-print"><span>KEMBALIAN:</span><span id="p-uang-kembali">Rp 0</span></div>
    <div class="garis-putus"></div>
    <div class="text-center" style="margin-top: 10px;">TERIMA KASIH<br>SELAMAT BERMAIN KEMBALI!</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<script>
    let dataBiayaSewa = {};
    let infoNotaTerpilih = {};

    // 1. FITUR JAM DIGITAL LIVE KASIR
    function updateClock() {
        const now = moment();
        document.getElementById('liveClock').innerText = now.format('HH:mm:ss') + " WIB";
    }
    setInterval(updateClock, 1000);
    window.onload = updateClock;

    // 2. FITUR FILTER CEPAT UNIT PS MODERN
    function filterPSModern(button, kriteria) {
        // Atur gaya aktif tombol filter
        const buttons = document.querySelectorAll('.filter-btn-modern');
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });
        button.classList.add('active');

        const cards = document.querySelectorAll('.item-ps-card');
        cards.forEach(card => {
            const status = card.getAttribute('data-status');
            const tipe = card.getAttribute('data-tipe');

            if (kriteria === 'semua') {
                card.style.setProperty('display', 'block', 'important');
            } else if (kriteria === 'tersedia' || kriteria === 'aktif') {
                if (status === kriteria) {
                    card.style.setProperty('display', 'block', 'important');
                } else {
                    card.style.setProperty('display', 'none', 'important');
                }
            } else if (kriteria === 'PS4' || kriteria === 'PS5') {
                if (tipe === kriteria) {
                    card.style.setProperty('display', 'block', 'important');
                } else {
                    card.style.setProperty('display', 'none', 'important');
                }
            }
        });
    }

    // fallback agar fungsi filterPS lama tidak error jika dipanggil
    function filterPS(kriteria) {
        const activeBtn = document.querySelector(`.filter-btn-modern`);
        filterPSModern(activeBtn, kriteria);
    }

    // LOGIKA PERHITUNGAN CHECKOUT & NOTA PRINT
    function hitungCheckout(id, createdAtStr, durationHours, renterName, consoleName) {
        if (!createdAtStr) return;

        let startTime = moment(createdAtStr);
        let now = moment();
        
        let jamMulaiStr = startTime.format('HH:mm') + " WIB";
        document.getElementById(`txtMulai${id}`).innerText = jamMulaiStr;

        let diffMins = now.diff(startTime, 'minutes');
        if (diffMins < 0) diffMins = 0;

        let jamNyata = Math.floor(diffMins / 60);
        let sisaMenit = diffMins % 60;
        
        if(sisaMenit > 5) jamNyata += 1;
        if(jamNyata === 0) jamNyata = 1;

        document.getElementById(`txtDurasiNyata${id}`).innerText = `${Math.floor(diffMins/60)} Jam ${sisaMenit} Menit (Dibulatkan jadi ${jamNyata} Jam)`;

        function rumusTarif(jam) {
            if (jam <= 1) return 8000;
            if (jam == 2) return 15000;
            return 15000 + ((jam - 2) * 5000);
        }

        let biayaSkenA = rumusTarif(parseInt(durationHours));
        let biayaSkenB = rumusTarif(jamNyata);

        if (parseInt(durationHours) === 0) biayaSkenA = biayaSkenB;

        dataBiayaSewa[id] = { skenA: biayaSkenA, skenB: biayaSkenB };

        infoNotaTerpilih = {
            id: id, namaPelanggan: renterName, namaPS: consoleName,
            jamMulai: jamMulaiStr, durasiCetak: `${jamNyata} Jam`,
            durasiAsliText: `${Math.floor(diffMins/60)}j ${sisaMenit}m`
        };

        document.getElementById(`hargaSkenA${id}`).innerText = "Rp " + biayaSkenA.toLocaleString('id-ID');
        document.getElementById(`hargaSkenB${id}`).innerText = "Rp " + biayaSkenB.toLocaleString('id-ID');

        hitungTotalAkhir(id);
    }

    // 3. FITUR TAMBAH / KURANG QUANTITY KANTIN
    function incQty(consoleId, menuId, maxStock) {
        let input = document.getElementById(`qty_${consoleId}_${menuId}`);
        let currentVal = parseInt(input.value) || 0;
        if (currentVal < maxStock) {
            input.value = currentVal + 1;
            hitungTotalAkhir(consoleId);
        }
    }

    function decQty(consoleId, menuId) {
        let input = document.getElementById(`qty_${consoleId}_${menuId}`);
        let currentVal = parseInt(input.value) || 0;
        if (currentVal > 0) {
            input.value = currentVal - 1;
            hitungTotalAkhir(consoleId);
        }
    }

    // LOGIKA PERHITUNGAN CHECKOUT & NOTA PRINT
    function hitungCheckout(id, createdAtStr, durationHours, renterName, consoleName, discountPercentage = 0) {
        if (!createdAtStr) return;

        let startTime = moment(createdAtStr);
        let now = moment();
        
        let jamMulaiStr = startTime.format('HH:mm') + " WIB";
        document.getElementById(`txtMulai${id}`).innerText = jamMulaiStr;

        let diffMins = now.diff(startTime, 'minutes');
        if (diffMins < 0) diffMins = 0;

        let jamNyata = Math.floor(diffMins / 60);
        let sisaMenit = diffMins % 60;
        
        if(sisaMenit > 5) jamNyata += 1;
        if(jamNyata === 0) jamNyata = 1;

        document.getElementById(`txtDurasiNyata${id}`).innerText = `${Math.floor(diffMins/60)} Jam ${sisaMenit} Menit (Dibulatkan jadi ${jamNyata} Jam)`;

        function rumusTarif(jam) {
            if (jam <= 1) return 8000;
            if (jam == 2) return 15000;
            return 15000 + ((jam - 2) * 5000);
        }

        let biayaSkenA = rumusTarif(parseInt(durationHours));
        let biayaSkenB = rumusTarif(jamNyata);

        if (parseInt(durationHours) === 0) biayaSkenA = biayaSkenB;

        dataBiayaSewa[id] = { skenA: biayaSkenA, skenB: biayaSkenB };

        infoNotaTerpilih = {
            id: id, namaPelanggan: renterName, namaPS: consoleName,
            jamMulai: jamMulaiStr, durasiCetak: `${jamNyata} Jam`,
            durasiAsliText: `${Math.floor(diffMins/60)}j ${sisaMenit}m`,
            discountPercentage: discountPercentage
        };

        document.getElementById(`hargaSkenA${id}`).innerText = "Rp " + biayaSkenA.toLocaleString('id-ID');
        document.getElementById(`hargaSkenB${id}`).innerText = "Rp " + biayaSkenB.toLocaleString('id-ID');

        hitungTotalAkhir(id);
    }

    function hitungTotalAkhir(id) {
        let total = 0;
        let skenarioTerpilih = document.querySelector(`input[name="skenario_biaya_${id}"]:checked`).value;
        let hargaSewaFix = (skenarioTerpilih === 'A') ? dataBiayaSewa[id].skenA : dataBiayaSewa[id].skenB;

        let totalKantin = 0;
        let htmlKantinPrint = "";
        let qtyInputs = document.querySelectorAll(`.qty-input-${id}`);
        qtyInputs.forEach(input => {
            let qty = parseInt(input.value) || 0;
            if (qty > 0) {
                let itemHarga = parseInt(input.getAttribute('data-harga'));
                let itemNama = input.getAttribute('data-nama');
                let subtotal = itemHarga * qty;
                totalKantin += subtotal;
                htmlKantinPrint += `<div class="d-flex-print"><span>${itemNama} x${qty}</span><span>Rp ${subtotal.toLocaleString('id-ID')}</span></div>`;
            }
        });

        // Hitung diskon member (hanya dipotong dari biaya sewa PS)
        let diskonPersen = infoNotaTerpilih.discountPercentage || 0;
        let diskonAmount = 0;
        let discountInfoBox = document.getElementById(`member_discount_info_${id}`);
        
        if (diskonPersen > 0) {
            diskonAmount = Math.round(hargaSewaFix * (diskonPersen / 100));
            document.getElementById(`lblMemberDiscountPercent_${id}`).innerText = `${diskonPersen}%`;
            document.getElementById(`lblMemberDiscountAmount_${id}`).innerText = `-Rp ${diskonAmount.toLocaleString('id-ID')}`;
            discountInfoBox.style.setProperty('display', 'flex', 'important');
        } else {
            discountInfoBox.style.setProperty('display', 'none', 'important');
        }

        let grandTotal = (hargaSewaFix - diskonAmount) + totalKantin;

        document.getElementById(`lblTotalBayar${id}`).innerText = "Rp " + grandTotal.toLocaleString('id-ID');
        document.getElementById(`lblTotalBayar${id}`).setAttribute('data-raw-total', grandTotal);

        infoNotaTerpilih.hargaSewa = hargaSewaFix;
        infoNotaTerpilih.diskon = diskonAmount;
        infoNotaTerpilih.totalKantin = totalKantin;
        infoNotaTerpilih.htmlKantin = htmlKantinPrint;

        hitungKembalian(id);
    }

    function hitungKembalian(id) {
        let total = parseInt(document.getElementById(`lblTotalBayar${id}`).getAttribute('data-raw-total')) || 0;
        let uangDiterima = parseInt(document.getElementById(`inputBayar${id}`).value) || 0;

        let kembalian = uangDiterima - total;
        
        if (kembalian < 0) {
            document.getElementById(`lblKembalian${id}`).innerText = "Uang Kurang!";
            document.getElementById(`lblKembalian${id}`).className = "fs-3 fw-bold text-danger";
        } else {
            document.getElementById(`lblKembalian${id}`).innerText = "Rp " + kembalian.toLocaleString('id-ID');
            document.getElementById(`lblKembalian${id}`).className = "fs-3 fw-bold text-success";
        }

        infoNotaTerpilih.totalAkhir = total;
        infoNotaTerpilih.uangTunai = uangDiterima;
        infoNotaTerpilih.uangKembali = kembalian < 0 ? 0 : kembalian;
    }

    function prosesCetakNota(id) {
        document.getElementById('p-nama-pelanggan').innerText = infoNotaTerpilih.namaPelanggan;
        document.getElementById('p-nama-ps').innerText = infoNotaTerpilih.namaPS;
        document.getElementById('p-jam-mulai').innerText = infoNotaTerpilih.jamMulai;
        document.getElementById('p-durasi-nyata').innerText = infoNotaTerpilih.durasiAsliText;
        document.getElementById('p-label-sewa').innerText = `Sewa PS (${infoNotaTerpilih.durasiCetak})`;
        document.getElementById('p-harga-sewa').innerText = "Rp " + infoNotaTerpilih.hargaSewa.toLocaleString('id-ID');
        
        // Diskon Member
        if (infoNotaTerpilih.diskon > 0) {
            document.getElementById('p-diskon-nilai').innerText = "-Rp " + infoNotaTerpilih.diskon.toLocaleString('id-ID');
            document.getElementById('p-diskon-member').style.setProperty('display', 'flex', 'important');
        } else {
            document.getElementById('p-diskon-member').style.setProperty('display', 'none', 'important');
        }
        
        let listKantinHTML = "";
        if (infoNotaTerpilih.totalKantin > 0) {
            listKantinHTML += `<div class="garis-putus"></div>`;
            listKantinHTML += `<div class="text-center" style="font-weight: bold;">KANTIN</div>`;
            listKantinHTML += `<div class="garis-putus"></div>`;
            listKantinHTML += infoNotaTerpilih.htmlKantin;
        }
        document.getElementById('p-list-kantin').innerHTML = listKantinHTML;

        document.getElementById('p-total-akhir').innerText = "Rp " + infoNotaTerpilih.totalAkhir.toLocaleString('id-ID');
        document.getElementById('p-uang-tunai').innerText = "Rp " + infoNotaTerpilih.uangTunai.toLocaleString('id-ID');
        document.getElementById('p-uang-kembali').innerText = "Rp " + infoNotaTerpilih.uangKembali.toLocaleString('id-ID');

        setTimeout(() => { window.print(); }, 300);
    }

    // Fungsi Pembantu Member Dropdown & Input Auto-fill
    function toggleMemberSelect(id) {
        let toggleVal = document.getElementById(`member_toggle_${id}`).value;
        let selectContainer = document.getElementById(`member_select_container_${id}`);
        let renterNameInput = document.getElementById(`renter_name_${id}`);
        let memberSelect = document.getElementById(`member_id_${id}`);
        
        if (toggleVal === 'member') {
            selectContainer.style.setProperty('display', 'block', 'important');
            memberSelect.required = true;
            renterNameInput.readOnly = true;
            onSelectMember(id);
        } else {
            selectContainer.style.setProperty('display', 'none', 'important');
            memberSelect.required = false;
            memberSelect.value = '';
            renterNameInput.readOnly = false;
            renterNameInput.value = '';
        }
    }

    function onSelectMember(id) {
        let memberSelect = document.getElementById(`member_id_${id}`);
        let selectedOption = memberSelect.options[memberSelect.selectedIndex];
        let renterNameInput = document.getElementById(`renter_name_${id}`);
        
        if (selectedOption && selectedOption.value !== "") {
            renterNameInput.value = selectedOption.getAttribute('data-name');
        } else {
            renterNameInput.value = '';
        }
    }

    function startCountdowns() {
        const timers = document.querySelectorAll('.countdown-timer');
        timers.forEach(timer => {
            const startTime = new Date(timer.getAttribute('data-start')).getTime();
            const durationHours = parseInt(timer.getAttribute('data-duration'));
            const endTime = startTime + (durationHours * 60 * 60 * 1000);

            const interval = setInterval(() => {
                const now = new Date().getTime();
                const distance = endTime - now;
                if (distance < 0) {
                    clearInterval(interval);
                    timer.innerHTML = "❌ WAKTU HABIS!";
                    return;
                }
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                timer.innerHTML = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }, 1000);
        });
    }
    document.addEventListener('DOMContentLoaded', startCountdowns);
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('toast_success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: "{{ session('toast_success') }}",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        background: '#131926',
        color: '#f1f5f9',
        timerProgressBar: true
    });
</script>
@endif
</body>
</html>