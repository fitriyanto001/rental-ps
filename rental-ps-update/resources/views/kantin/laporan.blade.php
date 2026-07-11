<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Laporan Kantin & Rental</title>
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

        /* Widget Cards */
        .widget-card {
            border-radius: 14px;
            padding: 20px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .widget-card:hover {
            transform: translateY(-3px);
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
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
                        <a href="{{ route('kantin.riwayat') }}" class="nav-link">
                            <i class="bi bi-clock-history"></i> Riwayat Kantin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kantin.laporan') }}" class="nav-link active">
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
                            <span>📊</span> LAPORAN ANALISA KANTIN
                        </h5>
                        <small class="text-muted">Analisa omset harian, tren makanan terlaris, dan pendapatan kantin</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 w-100 w-sm-auto justify-content-between justify-content-sm-end">
                    <div class="bg-dark px-3 py-2 rounded-3 border border-secondary border-opacity-30 fw-bold text-info" style="font-size: 13.5px;">
                        <i class="bi bi-clock-fill me-2"></i><span id="liveClock">00:00:00 WIB</span>
                    </div>
                    <span class="badge badge-glow-secondary p-2 d-flex align-items-center gap-2" style="font-size: 12.5px;">
                        <i class="bi bi-person-circle text-info"></i> Kasir: Fitriyanto
                    </span>
                </div>
            </div>

            <!-- CARDS WIDGET LAPORAN -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary bg-opacity-20 rounded-3 text-primary border border-primary border-opacity-20">
                            <i class="bi bi-cart-check-fill fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">TRANSAKSI HARI INI</small>
                            <h4 class="m-0 fw-bold text-white mt-1">{{ $totalTransactionsToday }} Transaksi</h4>
                        </div>  
                    </div>  
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-success bg-opacity-20 rounded-3 text-success border border-success border-opacity-20">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">PENDAPATAN KANTIN HARI INI</small>
                            <h4 class="m-0 fw-bold text-white mt-1">Rp {{ number_format($canteenRevenueToday, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-warning bg-opacity-20 rounded-3 text-warning border border-warning border-opacity-20">
                            <i class="bi bi-calendar3 fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">PENDAPATAN MINGGU INI</small>
                            <h4 class="m-0 fw-bold text-white mt-1">Rp {{ number_format($canteenRevenueThisWeek, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget-card d-flex align-items-center gap-3">
                        <div class="p-3 bg-info bg-opacity-20 rounded-3 text-info border border-info border-opacity-20">
                            <i class="bi bi-calendar-range-fill fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">PENDAPATAN BULAN INI</small>
                            <h4 class="m-0 fw-bold text-white mt-1">Rp {{ number_format($canteenRevenueThisMonth, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRAFIK & MENU TERLARIS -->
            <div class="row g-4 mb-4">
                
                <!-- Grafik Penjualan Harian -->
                <div class="col-xl-8 col-lg-7">
                    <div class="glass-panel p-4 h-100">
                        <h6 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-graph-up text-primary"></i> GRAFIK PENJUALAN HARIAN
                        </h6>
                        <div style="position: relative; height:320px; width:100%">
                            <canvas id="dailySalesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Menu Terlaris & Item Terjual -->
                <div class="col-xl-4 col-lg-5">
                    <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                                <i class="bi bi-fire text-danger"></i> MENU TERLARIS KANTIN
                            </h6>
                            
                            <div class="d-flex flex-column gap-3">
                                @forelse($bestSellingMenus as $item)
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-bold text-white small">{{ $item->menuKantin->nama_menu ?? 'Menu Terhapus' }}</span>
                                            <span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-30 small">{{ $item->total_qty }} Terjual</span>
                                        </div>
                                        <div class="progress bg-dark bg-opacity-50" style="height: 6px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ min(100, ($item->total_qty / max(1, $totalItemsSold)) * 100) }}%"></div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4 text-muted small">
                                        Belum ada data menu terlaris.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top border-secondary border-opacity-20">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block uppercase fw-bold" style="font-size: 10px;">TOTAL ITEM TERJUAL</small>
                                    <h4 class="m-0 fw-bold text-info mt-1">{{ $totalItemsSold }} Pcs</h4>
                                </div>
                                <div class="fs-1 text-info text-opacity-30">
                                    <i class="bi bi-box-seam-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Live Clock Kasir
    function updateClock() {
        const now = moment();
        document.getElementById('liveClock').innerText = now.format('HH:mm:ss') + " WIB";
    }
    setInterval(updateClock, 1000);
    window.onload = updateClock;

    // Grafik Penjualan Harian (Chart.js)
    const ctx = document.getElementById('dailySalesChart').getContext('2d');
    
    // Data dari Controller
    const chartLabels = {!! json_encode(array_column($salesChartData, 'label')) !!};
    const chartRentalSales = {!! json_encode(array_column($salesChartData, 'rental')) !!};
    const chartCanteenSales = {!! json_encode(array_column($salesChartData, 'canteen')) !!};
    const chartTotalSales = {!! json_encode(array_column($salesChartData, 'total')) !!};

    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Pendapatan Rental PS',
                    data: chartRentalSales,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2
                },
                {
                    label: 'Pendapatan Kantin',
                    data: chartCanteenSales,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2
                },
                {
                    label: 'Total Omset Gabungan',
                    data: chartTotalSales,
                    borderColor: '#fbbf24',
                    backgroundColor: 'transparent',
                    borderDash: [5, 5],
                    fill: false,
                    tension: 0.3,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#94a3b8',
                        font: {
                            family: 'Plus Jakarta Sans'
                        }
                    }
                }
            },
            scales: {
                y: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)'
                    },
                    ticks: {
                        color: '#94a3b8',
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)'
                    },
                    ticks: {
                        color: '#94a3b8'
                    }
                }
            }
        }
    });
</script>
</body>
</html>
