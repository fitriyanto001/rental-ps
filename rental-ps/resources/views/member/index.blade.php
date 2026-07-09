<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Data Member</title>
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

        .badge-glow-secondary {
            background: rgba(107, 114, 128, 0.1);
            color: #cbd5e1;
            border: 1px solid rgba(107, 114, 128, 0.2);
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

        /* Pagination custom styling */
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
                        <a href="{{ route('kantin.laporan') }}" class="nav-link">
                            <i class="bi bi-file-earmark-bar-graph"></i> Laporan Kantin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('member.index') }}" class="nav-link active">
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
                <div>
                    <h5 class="m-0 fw-bold text-white d-flex align-items-center gap-2">
                        <span>👥</span> PENGELOLA DATA MEMBER
                    </h5>
                    <small class="text-muted">Kelola data pelanggan loyal, registrasi member baru, dan atur diskon rental</small>
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

            <!-- TABLE DAN CRUD MEMBER -->
            <div class="glass-panel p-4 flex-grow-1">
                
                <!-- TOMBOL ACTION & SEARCH BAR -->
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-md-7">
                        <form action="{{ route('member.index') }}" method="GET" class="row g-2 align-items-center">
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary border-opacity-30 text-muted"><i class="bi bi-search"></i></span>
                                    <input type="text" name="search" class="form-control form-control-dark" placeholder="Cari nama atau no telepon member..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex gap-1">
                                <button type="submit" class="btn btn-outline-primary py-2 px-3 text-white border-primary border-opacity-30 w-50">
                                    Cari
                                </button>
                                <a href="{{ route('member.index') }}" class="btn btn-outline-secondary py-2 px-3 text-white border-secondary border-opacity-30 w-50" title="Refresh">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-md-4 text-md-end text-start">
                        <button type="button" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="bi bi-plus-circle-fill"></i> REGISTER MEMBER BARU
                        </button>
                    </div>
                </div>

                <!-- TABLE CRUD -->
                <div class="table-responsive border border-secondary border-opacity-10 rounded-3">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Member</th>
                                <th>No Telepon / WhatsApp</th>
                                <th>Diskon Rental</th>
                                <th>Tanggal Bergabung</th>
                                <th style="width: 180px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $key => $m)
                                <tr>
                                    <td>{{ $members->firstItem() + $key }}</td>
                                    <td class="fw-bold text-white">{{ $m->name }}</td>
                                    <td>{{ $m->phone ?: '-' }}</td>
                                    <td>
                                        <span class="badge badge-glow-primary px-3 py-1.5 rounded-pill fw-bold">{{ $m->discount_percentage }}% Diskon</span>
                                    </td>
                                    <td>{{ $m->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-info rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#editMemberModal{{ $m->id }}" title="Edit Member">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-3 px-3" onclick="confirmDelete('{{ $m->id }}', '{{ htmlspecialchars($m->name) }}')" title="Hapus Member">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>

                                        <!-- Hidden Form Hapus -->
                                        <form id="delete-form-{{ $m->id }}" action="{{ route('member.destroy', $m->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people fs-2 d-block mb-2"></i>
                                        Belum ada data member terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                @if($members->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 pagination-custom">
                        <small class="text-muted">Menampilkan {{ $members->firstItem() ?? 0 }} - {{ $members->lastItem() ?? 0 }} dari {{ $members->total() }} data</small>
                        <div>
                            {{ $members->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- MODAL REGISTER MEMBER -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark bg-dark">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-primary"></i> Register Member Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('member.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-dark" placeholder="Masukkan nama member" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">No HP / WhatsApp (Opsional)</label>
                        <input type="text" name="phone" class="form-control form-control-dark" placeholder="Contoh: 0812xxxxxxxx" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Persentase Diskon Rental (%)</label>
                        <div class="input-group">
                            <input type="number" name="discount_percentage" class="form-control form-control-dark" value="10" min="0" max="100" required autocomplete="off">
                            <span class="input-group-text bg-secondary border-0 text-white fw-bold">%</span>
                        </div>
                        <div class="form-text text-white-50 mt-1" style="font-size: 11px;">Diskon ini otomatis memotong biaya sewa unit PS saat checkout.</div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-dark bg-dark">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">SIMPAN MEMBER 💾</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODALS EDIT MEMBER -->
@foreach($members as $m)
<div class="modal fade" id="editMemberModal{{ $m->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header modal-header-dark bg-dark">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-info"></i> Edit Data Member
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('member.update', $m->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-dark" value="{{ $m->name }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">No HP / WhatsApp</label>
                        <input type="text" name="phone" class="form-control form-control-dark" value="{{ $m->phone }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-white-50">Persentase Diskon Rental (%)</label>
                        <div class="input-group">
                            <input type="number" name="discount_percentage" class="form-control form-control-dark" value="{{ $m->discount_percentage }}" min="0" max="100" required autocomplete="off">
                            <span class="input-group-text bg-secondary border-0 text-white fw-bold">%</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-dark bg-dark">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-info px-4 fw-semibold text-white">UPDATE MEMBER 💾</button>
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
    // Live Clock Kasir
    function updateClock() {
        const now = moment();
        document.getElementById('liveClock').innerText = now.format('HH:mm:ss') + " WIB";
    }
    setInterval(updateClock, 1000);
    window.onload = updateClock;

    // Toast alert on success
    @if(session('toast_success'))
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
    @endif

    // SweetAlert Hapus Konfirmasi
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus Member?',
            text: `Apakah Anda yakin ingin menghapus member "${name}"? Seluruh riwayat diskon member ini tidak akan terpengaruh.`,
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
