<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJIS-PS - Masuk ke Sistem</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-primary: #060913;
            --bg-surface: #0f1524;
            --bg-card: rgba(20, 27, 45, 0.6);
            --border-glow: rgba(255, 255, 255, 0.08);
            --color-aktif: #3b82f6;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: var(--bg-primary);
            color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        .ambient-bg {
            position: absolute;
            width: 50vw; height: 50vw;
            background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, rgba(0,0,0,0) 70%);
            top: -15vw; right: -15vw;
            z-index: -1; pointer-events: none;
        }
        .ambient-bg-2 {
            position: absolute;
            width: 45vw; height: 45vw;
            background: radial-gradient(circle, rgba(16,185,129,0.07) 0%, rgba(0,0,0,0) 70%);
            bottom: -15vw; left: -15vw;
            z-index: -1; pointer-events: none;
        }

        .login-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-glow);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            border-color: rgba(59, 130, 246, 0.2);
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.08);
        }

        .brand-logo {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            margin: 0 auto 24px;
            box-shadow: 0 8px 20px rgba(59,130,246,0.3);
        }

        .form-control-dark {
            background-color: #161e31 !important;
            border: 1px solid rgba(255,255,255,0.08) !important;
            color: #f8fafc !important;
            border-radius: 12px;
            padding: 14px 16px;
            transition: all 0.3s ease;
        }
        .form-control-dark:focus {
            border-color: var(--color-aktif) !important;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.2) !important;
            outline: none;
        }
        .form-control-dark::placeholder {
            color: #4b5563;
        }

        .btn-login {
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 14px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37,99,235,0.25);
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.4);
            opacity: 0.95;
        }
        .btn-login:active {
            transform: translateY(0);
        }

        .form-check-input {
            background-color: #161e31;
            border-color: rgba(255,255,255,0.15);
        }
        .form-check-input:checked {
            background-color: var(--color-aktif);
            border-color: var(--color-aktif);
        }
        
        .alert-custom {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-radius: 12px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="ambient-bg"></div>
<div class="ambient-bg-2"></div>

<div class="container py-5">
    <div class="login-card mx-auto">
        <div class="text-center">
            <div class="brand-logo">
                <i class="bi bi-controller"></i>
            </div>
            <h4 class="fw-bold text-white mb-1">AJIS-PS System</h4>
            <p class="text-muted small mb-4">Silakan masuk menggunakan akun kasir Anda</p>
        </div>

        @if($errors->any())
            <div class="alert alert-custom p-3 mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label text-white-50 small fw-semibold">Email Pengguna</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted" style="border: 1px solid rgba(255,255,255,0.08); border-radius: 12px 0 0 12px;">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control form-control-dark border-start-0" 
                        style="border-radius: 0 12px 12px 0;" placeholder="nama@email.com" 
                        value="{{ old('email') }}" required autofocus autocomplete="off">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-white-50 small fw-semibold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted" style="border: 1px solid rgba(255,255,255,0.08); border-radius: 12px 0 0 12px;">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control form-control-dark border-start-0" 
                        style="border-radius: 0 12px 12px 0;" placeholder="••••••••" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-white-50 small" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 d-flex align-items-center justify-content-center gap-2 mb-3">
                <span>MASUK SISTEM</span> <i class="bi bi-arrow-right-short fs-4"></i>
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Toast on success (e.g. from logout)
    @if(session('toast_success'))
        Swal.fire({
            icon: 'success', title: 'Sukses',
            text: "{{ session('toast_success') }}",
            toast: true, position: 'top-end',
            showConfirmButton: false, timer: 3000,
            background: '#131926', color: '#f1f5f9', timerProgressBar: true
        });
    @endif
</script>
</body>
</html>
