<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Kelola Unit PS</title>
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
            width: 40vw; height: 40vw;
            background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, rgba(0,0,0,0) 70%);
            top: -10vw; right: -10vw;
            z-index: -1; pointer-events: none;
        }
        .ambient-bg-2 {
            position: fixed;
            width: 35vw; height: 35vw;
            background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, rgba(0,0,0,0) 70%);
            bottom: -5vw; left: -5vw;
            z-index: -1; pointer-events: none;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--bg-surface) 0%, #080b12 100%);
            border-right: 1px solid rgba(255,255,255,0.04);
            box-shadow: 10px 0 30px rgba(0,0,0,0.25);
            z-index: 10;
        }
        .sidebar .brand-container { border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: 20px; }
        .sidebar .nav-link {
            color: #94a3b8; padding: 12px 18px; border-radius: 10px; margin-bottom: 6px;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1); font-weight: 500;
            display: flex; align-items: center; gap: 12px; font-size: 0.95rem;
        }
        .sidebar .nav-link i { font-size: 1.15rem; transition: transform 0.2s ease; }
        .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.04); color: var(--color-aktif); }
        .sidebar .nav-link:hover i { transform: scale(1.1); }
        .sidebar .nav-link.active {
            background: linear-gradient(90deg, rgba(59,130,246,0.15) 0%, rgba(59,130,246,0.02) 100%);
            color: #60a5fa; border-left: 3px solid var(--color-aktif); font-weight: 600;
        }

        /* Glass */
        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glow);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(0,0,0,0.2);
        }

        /* Badges */
        .badge-glow-success { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); box-shadow: 0 0 12px rgba(16,185,129,0.15); }
        .badge-glow-primary  { background: rgba(59,130,246,0.1);  color: #60a5fa;  border: 1px solid rgba(59,130,246,0.2);  box-shadow: 0 0 12px rgba(59,130,246,0.15); }
        .badge-glow-danger   { background: rgba(239,68,68,0.1);   color: #f87171;  border: 1px solid rgba(239,68,68,0.2);  }
        .badge-glow-secondary{ background: rgba(107,114,128,0.1); color: #cbd5e1;  border: 1px solid rgba(107,114,128,0.2); }
        .badge-glow-warning  { background: rgba(245,158,11,0.1);  color: #fbbf24;  border: 1px solid rgba(245,158,11,0.2);  }

        /* Modals */
        .modal-content-dark {
            background-color: #111827; border: 1px solid rgba(255,255,255,0.08);
            color: #f1f5f9; border-radius: 16px;
        }
        .modal-header-dark { border-bottom: 1px solid rgba(255,255,255,0.06); padding: 20px; }
        .modal-footer-dark  { border-top:  1px solid rgba(255,255,255,0.06); padding: 16px 20px; }
        .form-control-dark, .form-select-dark {
            background-color: #1f2937 !important;
            border: 1px solid rgba(255,255,255,0.08) !important;
            color: #f8fafc !important; border-radius: 10px; padding: 12px 16px;
            transition: all 0.3s ease;
        }
        .form-control-dark:focus, .form-select-dark:focus {
            border-color: var(--color-aktif) !important;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.25) !important; outline: none;
        }
        .form-control-dark::placeholder { color: #6b7280; }
        .form-select-dark option { background: #1f2937; color: #f8fafc; }

        /* Table */
        .table-dark-custom {
            --bs-table-bg: transparent; --bs-table-color: #f1f5f9;
            --bs-table-border-color: rgba(255,255,255,0.05); margin-bottom: 0;
        }
        .table-dark-custom th {
            color: #94a3b8; font-weight: 600; text-transform: uppercase;
            font-size: 0.75rem; letter-spacing: 0.5px; padding: 16px;
            border-bottom: 2px solid rgba(255,255,255,0.08);
        }
        .table-dark-custom td { padding: 14px 16px; vertical-align: middle; font-size: 0.9rem; }
        .table-dark-custom tbody tr { transition: background-color 0.2s ease; }
        .table-dark-custom tbody tr:hover { background-color: rgba(255,255,255,0.02); }

        /* Status pill card */
        .ps-unit-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 14px 18px;
            transition: all 0.25s ease;
        }
        .ps-unit-card:hover { background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1); }

        /* Pagination */
        .pagination-custom .page-link {
            background-color: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);
            color: #94a3b8; padding: 8px 16px; margin: 0 2px; border-radius: 6px; transition: all 0.2s ease;
        }
        .pagination-custom .page-link:hover { background-color: rgba(59,130,246,0.1); color: #60a5fa; border-color: rgba(59,130,246,0.2); }
        .pagination-custom .page-item.active .page-link { background-color: var(--color-aktif); border-color: var(--color-aktif); color: white; box-shadow: 0 4px 10px rgba(59,130,246,0.25); }
        .pagination-custom .page-item.disabled .page-link { background-color: transparent; border-color: rgba(255,255,255,0.02); color: #4b5563; }

        /* Status indicator dot */
        .dot-status { width: 9px; height: 9px; border-radius: 50%; display: inline-block; margin-right: 6px; }
        .dot-tersedia { background: #10b981; box-shadow: 0 0 6px rgba(16,185,129,0.7); }
        .dot-aktif    { background: #3b82f6; box-shadow: 0 0 6px rgba(59,130,246,0.7); }
        .dot-rusak    { background: #ef4444; box-shadow: 0 0 6px rgba(239,68,68,0.7); }
        .dot-offline  { background: #6b7280; }

        /* Type badge */
        .type-ps4 { background: linear-gradient(135deg, #1d4ed8, #3b82f6); }
        .type-ps5 { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
    </style>
</head>
<body>

<div class="ambient-bg"></div>
<div class="ambient-bg-2"></div>

<div class="container-fluid">
<div class="row">

    <!-- SIDEBAR -->
    <div class="col-md-2 p-0 sidebar d-flex flex-column justify-content-between p-4 text-white">
        <div>
            <div class="brand-container text-center my-3">
                <h4 class="fw-extrabold text-primary mb-1" style="letter-spacing:1.5px;">AJIS-PS</h4>
                <span class="badge badge-glow-primary text-uppercase" style="font-size:9px;letter-spacing:1.5px;font-weight:700;">MANAGEMENT SYSTEM</span>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kantin.menu') }}" class="nav-link"><i class="bi bi-shop"></i> Kasir Kantin</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kantin.riwayat') }}" class="nav-link"><i class="bi bi-clock-history"></i> Riwayat Kantin</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kantin.laporan') }}" class="nav-link"><i class="bi bi-file-earmark-bar-graph"></i> Laporan Kantin</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('member.index') }}" class="nav-link"><i class="bi bi-people"></i> Data Member</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('console.index') }}" class="nav-link active"><i class="bi bi-sliders"></i> Kelola PS</a>
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
            <a href="#" class="btn btn-outline-danger w-100 rounded-3 py-2 d-flex align-items-center justify-content-center gap-2" style="font-size:0.9rem;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Keluar
            </a>
        </div>
    </div>

    <!-- WORKSPACE UTAMA -->
    <div class="col-md-10 p-4 min-vh-100 d-flex flex-column">

        <!-- HEADER -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3 p-3 glass-panel">
            <div>
                <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                    <span>🎮</span> KELOLA UNIT PLAYSTATION
                </h5>
                <small class="text-muted">Tambah, edit, atau hapus unit PlayStation yang terdaftar di sistem</small>
            </div>
            <div class="d-flex align-items-center gap-3 w-100 w-sm-auto justify-content-between justify-content-sm-end">
                <div class="bg-dark px-3 py-2 rounded-3 border border-secondary border-opacity-30 fw-bold text-info" style="font-size:13.5px;">
                    <i class="bi bi-clock-fill me-2"></i><span id="liveClock">00:00:00 WIB</span>
                </div>
                <span class="badge badge-glow-secondary p-2 d-flex align-items-center gap-2" style="font-size:12.5px;">
                    <i class="bi bi-person-circle text-info"></i> {{ Auth::user()->name }}
                </span>
            </div>
        </div>

        <!-- STATS CARDS -->
        @php
            $totalAll     = $consoles->total();
            $totalTersedia = \App\Models\Console::where('status','tersedia')->count();
            $totalAktif   = \App\Models\Console::where('status','aktif')->count();
            $totalRusak   = \App\Models\Console::where('status','rusak')->count();
        @endphp
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="glass-panel p-3 text-center">
                    <div class="fs-2 fw-bold text-white">{{ $totalAll }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-controller me-1"></i>Total Unit</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-panel p-3 text-center" style="border-color: rgba(16,185,129,0.2);">
                    <div class="fs-2 fw-bold text-success">{{ $totalTersedia }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-check-circle me-1"></i>Tersedia</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-panel p-3 text-center" style="border-color: rgba(59,130,246,0.2);">
                    <div class="fs-2 fw-bold text-primary">{{ $totalAktif }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-play-circle me-1"></i>Aktif / Main</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-panel p-3 text-center" style="border-color: rgba(239,68,68,0.2);">
                    <div class="fs-2 fw-bold text-danger">{{ $totalRusak }}</div>
                    <div class="small text-muted mt-1"><i class="bi bi-tools me-1"></i>Rusak / Offline</div>
                </div>
            </div>
        </div>

        <!-- TABLE & ACTIONS -->
        <div class="glass-panel p-4 flex-grow-1">

            <!-- FILTER BAR -->
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-md-8">
                    <form action="{{ route('console.index') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary border-opacity-30 text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control form-control-dark" placeholder="Cari nama unit..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <select name="type" class="form-select form-select-dark">
                                <option value="">Semua Tipe</option>
                                <option value="PS4" {{ request('type')=='PS4'?'selected':'' }}>PS4</option>
                                <option value="PS5" {{ request('type')=='PS5'?'selected':'' }}>PS5</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="status" class="form-select form-select-dark">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status')=='tersedia'?'selected':'' }}>Tersedia</option>
                                <option value="aktif"    {{ request('status')=='aktif'?'selected':'' }}>Aktif</option>
                                <option value="rusak"    {{ request('status')=='rusak'?'selected':'' }}>Rusak</option>
                                <option value="offline"  {{ request('status')=='offline'?'selected':'' }}>Offline</option>
                            </select>
                        </div>
                        <div class="col-sm-2 d-flex gap-1">
                            <button type="submit" class="btn btn-outline-primary py-2 px-3 text-white border-primary border-opacity-30 w-50">Cari</button>
                            <a href="{{ route('console.index') }}" class="btn btn-outline-secondary py-2 px-3 text-white border-secondary border-opacity-30 w-50" title="Reset"><i class="bi bi-arrow-clockwise"></i></a>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-md-end text-start">
                    <button type="button" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#addConsoleModal">
                        <i class="bi bi-plus-circle-fill"></i> TAMBAH UNIT PS BARU
                    </button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="table-responsive border border-secondary border-opacity-10 rounded-3">
                <table class="table table-dark-custom">
                    <thead>
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Unit</th>
                            <th>Tipe PS</th>
                            <th>Status Saat Ini</th>
                            <th>Terdaftar Sejak</th>
                            <th class="text-center" style="width:200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consoles as $key => $console)
                            <tr>
                                <td>{{ $consoles->firstItem() + $key }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="d-flex align-items-center justify-content-center rounded-3 fw-bold text-white text-uppercase"
                                            style="width:42px;height:42px;font-size:11px;
                                                {{ $console->type == 'PS5' ? 'background: linear-gradient(135deg,#7c3aed,#a78bfa);' : 'background: linear-gradient(135deg,#1d4ed8,#3b82f6);' }}">
                                            {{ $console->type }}
                                        </div>
                                        <span class="fw-bold text-white">{{ $console->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($console->type == 'PS5')
                                        <span class="badge px-3 py-1 rounded-pill fw-bold text-white" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);">PlayStation 5</span>
                                    @else
                                        <span class="badge px-3 py-1 rounded-pill fw-bold text-white" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">PlayStation 4</span>
                                    @endif
                                </td>
                                <td>
                                    @if($console->status == 'tersedia')
                                        <span class="badge badge-glow-success px-3 py-1 rounded-pill">
                                            <span class="dot-status dot-tersedia"></span>TERSEDIA
                                        </span>
                                    @elseif($console->status == 'aktif')
                                        <span class="badge badge-glow-primary px-3 py-1 rounded-pill">
                                            <span class="dot-status dot-aktif"></span>AKTIF / MAIN
                                        </span>
                                    @elseif($console->status == 'rusak')
                                        <span class="badge badge-glow-danger px-3 py-1 rounded-pill">
                                            <span class="dot-status dot-rusak"></span>RUSAK
                                        </span>
                                    @else
                                        <span class="badge badge-glow-secondary px-3 py-1 rounded-pill">
                                            <span class="dot-status dot-offline"></span>OFFLINE
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $console->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-info rounded-3 px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editConsoleModal{{ $console->id }}"
                                            title="Edit Unit PS">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        @if($console->status == 'aktif')
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-3 px-3" disabled title="Sedang aktif digunakan">
                                                <i class="bi bi-lock-fill"></i>
                                            </button>
                                        @else
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-3 px-3"
                                                onclick="confirmDelete('{{ $console->id }}', '{{ htmlspecialchars($console->name) }}')"
                                                title="Hapus Unit PS">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Hidden delete form -->
                                    <form id="delete-form-{{ $console->id }}" action="{{ route('console.destroy', $console->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-controller fs-2 d-block mb-2"></i>
                                    Belum ada unit PlayStation yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @if($consoles->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4 pagination-custom">
                    <small class="text-muted">Menampilkan {{ $consoles->firstItem() ?? 0 }} - {{ $consoles->lastItem() ?? 0 }} dari {{ $consoles->total() }} unit</small>
                    <div>{{ $consoles->links('pagination::bootstrap-4') }}</div>
                </div>
            @endif

        </div>
    </div>
</div>
</div>

<!-- ====== MODAL TAMBAH UNIT PS BARU ====== -->
<div class="modal fade" id="addConsoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark bg-dark">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-primary"></i> Tambah Unit PS Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('console.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Nama Unit</label>
                        <input type="text" name="name" class="form-control form-control-dark"
                            placeholder="Contoh: PS5 - 02" required autocomplete="off">
                        <div class="form-text text-white-50 mt-1" style="font-size:11px;">Gunakan format yang konsisten, misal: PS4 - 01, PS5 - 02, dll.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Tipe PlayStation</label>
                        <select name="type" class="form-select form-select-dark" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="PS4">PlayStation 4 (PS4)</option>
                            <option value="PS5">PlayStation 5 (PS5)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Status Awal</label>
                        <select name="status" class="form-select form-select-dark" required>
                            <option value="tersedia" selected>Tersedia (Siap Digunakan)</option>
                            <option value="rusak">Rusak (Dalam Perbaikan)</option>
                            <option value="offline">Offline (Daya Dimatikan)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-dark bg-dark">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">SIMPAN UNIT 💾</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====== MODALS EDIT UNIT PS ====== -->
@foreach($consoles as $console)
<div class="modal fade" id="editConsoleModal{{ $console->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark bg-dark">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-info"></i> Edit Unit: {{ $console->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('console.update', $console->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Nama Unit</label>
                        <input type="text" name="name" class="form-control form-control-dark"
                            value="{{ $console->name }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Tipe PlayStation</label>
                        <select name="type" class="form-select form-select-dark" required
                            {{ $console->status == 'aktif' ? 'disabled' : '' }}>
                            <option value="PS4" {{ $console->type=='PS4'?'selected':'' }}>PlayStation 4 (PS4)</option>
                            <option value="PS5" {{ $console->type=='PS5'?'selected':'' }}>PlayStation 5 (PS5)</option>
                        </select>
                        @if($console->status == 'aktif')
                            <input type="hidden" name="type" value="{{ $console->type }}">
                            <div class="form-text text-warning mt-1" style="font-size:11px;"><i class="bi bi-lock-fill me-1"></i>Tipe tidak dapat diubah saat unit sedang aktif digunakan.</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Status Unit</label>
                        <select name="status" class="form-select form-select-dark" required>
                            <option value="tersedia" {{ $console->status=='tersedia'?'selected':'' }}>Tersedia</option>
                            <option value="aktif"    {{ $console->status=='aktif'?'selected':'' }}>Aktif (sedang digunakan)</option>
                            <option value="rusak"    {{ $console->status=='rusak'?'selected':'' }}>Rusak</option>
                            <option value="offline"  {{ $console->status=='offline'?'selected':'' }}>Offline</option>
                        </select>
                    </div>

                    @if($console->status == 'aktif')
                        <div class="alert d-flex align-items-center gap-2 rounded-3" style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);">
                            <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                            <small class="text-warning">Unit ini sedang aktif digunakan. Hati-hati saat mengubah statusnya.</small>
                        </div>
                    @endif
                </div>
                <div class="modal-footer modal-footer-dark bg-dark">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-info px-4 fw-semibold text-white">UPDATE UNIT 💾</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Live Clock
    function updateClock() {
        document.getElementById('liveClock').innerText = moment().format('HH:mm:ss') + ' WIB';
    }
    setInterval(updateClock, 1000);
    window.onload = updateClock;

    // Toast on success
    @if(session('toast_success'))
        Swal.fire({
            icon: 'success', title: 'Sukses',
            text: "{{ session('toast_success') }}",
            toast: true, position: 'top-end',
            showConfirmButton: false, timer: 3000,
            background: '#131926', color: '#f1f5f9', timerProgressBar: true
        });
    @endif

    @if(session('toast_error'))
        Swal.fire({
            icon: 'error', title: 'Gagal',
            text: "{{ session('toast_error') }}",
            toast: true, position: 'top-end',
            showConfirmButton: false, timer: 4000,
            background: '#131926', color: '#f1f5f9', timerProgressBar: true
        });
    @endif

    // Konfirmasi Hapus
    function confirmDelete(id, name) {
        Swal.fire({
            title: '🗑️ Hapus Unit PS?',
            html: `Anda yakin ingin menghapus unit <strong style="color:#60a5fa;">${name}</strong>?<br><small style="color:#94a3b8;">Seluruh data riwayat transaksi unit ini tidak ikut terhapus.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4b5563',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#111827',
            color: '#f1f5f9'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
</body>
</html>
