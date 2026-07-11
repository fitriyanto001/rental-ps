<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Console;

class ShiftController extends Controller
{
    /**
     * Halaman utama shift.
     * Jika ada shift aktif → tampilkan ringkasan shift berjalan.
     * Jika tidak → tampilkan form buka shift.
     */
    public function index()
    {
        $shiftAktif = Shift::aktif();

        // Statistik real-time untuk shift yang sedang berjalan
        $psAktif = [];
        $ringkasan = null;

        if ($shiftAktif) {
            $psAktif = Console::where('status', 'aktif')->with(['transactions' => function ($q) use ($shiftAktif) {
                $q->where('shift_id', $shiftAktif->id)->where('status', 'belum_bayar')->latest();
            }])->get()->filter(function ($c) {
                return $c->transactions->isNotEmpty();
            });

            $txShift = $shiftAktif->transactions()->where('status', 'lunas')->get();
            $ringkasan = [
                'total_transaksi' => $txShift->count(),
                'total_rental'    => $txShift->sum('total_rental'),
                'total_kantin'    => $txShift->sum('total_kantin'),
                'total_diskon'    => $txShift->sum('diskon'),
                'grand_total'     => $txShift->sum('grand_total'),
            ];
        }

        return view('shift.index', compact('shiftAktif', 'psAktif', 'ringkasan'));
    }

    /**
     * Buka shift baru.
     */
    public function buka(Request $request)
    {
        $request->validate([
            'kasir_name' => 'required|string|max:100',
        ]);

        // Cegah buka shift jika sudah ada yang aktif
        if (Shift::aktif()) {
            return redirect()->route('shift.index')
                ->with('toast_error', 'Sudah ada shift yang sedang berjalan!');
        }

        Shift::create([
            'kasir_name' => $request->kasir_name,
            'jam_buka'   => now(),
            'status'     => 'buka',
        ]);

        return redirect()->route('shift.index')
            ->with('toast_success', 'Shift berhasil dibuka. Selamat bertugas, ' . $request->kasir_name . '!');
    }

    /**
     * Tutup shift aktif.
     */
    public function tutup(Request $request)
    {
        $shift = Shift::aktif();

        if (!$shift) {
            return redirect()->route('shift.index')
                ->with('toast_error', 'Tidak ada shift yang sedang aktif.');
        }

        // Hitung rekap final dari transaksi lunas dalam shift ini
        $txLunas = $shift->transactions()->where('status', 'lunas')->get();

        $shift->update([
            'jam_tutup'        => now(),
            'status'           => 'tutup',
            'total_transaksi'  => $txLunas->count(),
            'total_rental'     => $txLunas->sum('total_rental'),
            'total_kantin'     => $txLunas->sum('total_kantin'),
            'total_diskon'     => $txLunas->sum('diskon'),
            'grand_total'      => $txLunas->sum('grand_total'),
            'catatan_handover' => $request->input('catatan_handover'),
        ]);

        return redirect()->route('shift.index')
            ->with('toast_success', 'Shift berhasil ditutup. Rekap telah tersimpan.');
    }

    /**
     * Riwayat semua shift.
     */
    public function riwayat(Request $request)
    {
        $query = Shift::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('jam_buka', $request->tanggal);
        }

        if ($request->filled('kasir')) {
            $query->where('kasir_name', 'like', '%' . $request->kasir . '%');
        }

        $shifts = $query->orderBy('jam_buka', 'desc')->paginate(15)->withQueryString();

        return view('shift.riwayat', compact('shifts'));
    }

    /**
     * Detail satu shift beserta transaksinya.
     */
    public function detail($id)
    {
        $shift = Shift::with(['transactions.console', 'transactions.member', 'transactions.transactionFoods.menuKantin'])->findOrFail($id);
        $transactions = $shift->transactions()->where('status', 'lunas')->orderBy('updated_at', 'desc')->get();

        return view('shift.detail', compact('shift', 'transactions'));
    }
}
