<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KantinController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\AuthController;

// Landing / Redirect page
Route::get('/', function () {
    return redirect('/dashboard');
});

// Guest Routes (Login only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login/guest', [AuthController::class, 'loginGuest'])->name('login.guest');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/start/{id}', [DashboardController::class, 'startRent'])->name('console.start');
    Route::get('/dashboard/stop/{id}', [DashboardController::class, 'stopRent'])->name('console.stop');
    Route::get('/dashboard/broken/{id}', [DashboardController::class, 'setBroken'])->name('console.broken');
    Route::get('/dashboard/available/{id}', [DashboardController::class, 'setAvailable'])->name('console.available');
    Route::get('/dashboard/offline/{id}', [DashboardController::class, 'setOffline'])->name('console.offline');
    Route::post('/dashboard/checkout/{id}', [DashboardController::class, 'checkoutRent'])->name('console.checkout');

    // Rute Kasir Kantin
    Route::get('/kantin/menu', [KantinController::class, 'index'])->name('kantin.menu');
    Route::post('/kantin/menu', [KantinController::class, 'store'])->name('kantin.menu.store');
    Route::put('/kantin/menu/{id}', [KantinController::class, 'update'])->name('kantin.menu.update');
    Route::delete('/kantin/menu/{id}', [KantinController::class, 'destroy'])->name('kantin.menu.destroy');

    Route::get('/kantin/riwayat', [KantinController::class, 'riwayat'])->name('kantin.riwayat');
    Route::get('/kantin/riwayat/print', [KantinController::class, 'riwayatPrint'])->name('kantin.riwayat.print');
    Route::get('/kantin/riwayat/export-excel', [KantinController::class, 'riwayatExportExcel'])->name('kantin.riwayat.export_excel');

    Route::get('/kantin/laporan', [KantinController::class, 'laporan'])->name('kantin.laporan');

    // Rute Data Member
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::post('/member', [MemberController::class, 'store'])->name('member.store');
    Route::put('/member/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/{id}', [MemberController::class, 'destroy'])->name('member.destroy');

    // Rute Kelola PS
    Route::get('/console', [ConsoleController::class, 'index'])->name('console.index');
    Route::post('/console', [ConsoleController::class, 'store'])->name('console.store');
    Route::put('/console/{id}', [ConsoleController::class, 'update'])->name('console.update');
    Route::delete('/console/{id}', [ConsoleController::class, 'destroy'])->name('console.destroy');

    // Rute Manajemen Shift
    Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::post('/shift/buka', [ShiftController::class, 'buka'])->name('shift.buka');
    Route::post('/shift/tutup', [ShiftController::class, 'tutup'])->name('shift.tutup');
    Route::get('/shift/riwayat', [ShiftController::class, 'riwayat'])->name('shift.riwayat');
    Route::get('/shift/{id}', [ShiftController::class, 'detail'])->name('shift.detail');
});