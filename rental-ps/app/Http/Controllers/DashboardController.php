<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;
use App\Models\Shift;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data PS, sekaligus menarik data transaksi terbaru yang statusnya 'belum_bayar'
        $consoles = Console::with(['transactions' => function($query) {
            $query->where('status', 'belum_bayar')->with('member')->latest();
        }])->get();
        
        // Mengambil seluruh menu kantin untuk di-looping di modal checkout
        $menuKantin = \App\Models\MenuKantin::orderBy('nama_menu', 'asc')->get();
        
        // Mengambil data member untuk modal start billing
        $members = \App\Models\Member::orderBy('name', 'asc')->get();

        // Ambil shift yang sedang aktif
        $shiftAktif = Shift::aktif();
        
        return view('dashboard', compact('consoles', 'menuKantin', 'members', 'shiftAktif'));
    }

    public function startRent(Request $request, $id)
    {
        $console = Console::findOrFail($id);
        $duration = $request->input('duration');
        $totalPrice = 0;

        // Logika Hitung Harga Custom Sesuai Request Anda
        if ($duration == 1) {
            $totalPrice = 8000;
        } elseif ($duration == 2) {
            $totalPrice = 15000;
        } elseif ($duration >= 3) {
            // Rumus: Base 2 jam (15.000) + (sisa jam dikali 5.000)
            $totalPrice = 15000 + (($duration - 2) * 5000);
        } else {
            // Jika diisi 0 (Paket Los)
            $totalPrice = 0;
        }

        // Ambil shift aktif untuk di-tag ke transaksi
        $shiftAktif = Shift::aktif();

        // Simpan ke database transaksi
        \App\Models\Transaction::create([
            'console_id'  => $console->id,
            'member_id'   => $request->input('member_id') ?: null,
            'shift_id'    => $shiftAktif ? $shiftAktif->id : null,
            'kasir_name'  => $shiftAktif ? $shiftAktif->kasir_name : null,
            'renter_name' => $request->input('renter_name'),
            'duration'    => $duration,
            'total_price' => $totalPrice,
            'status'      => 'belum_bayar'
        ]);

        // Ubah status PS jadi Aktif
        $console->status = 'aktif';
        $console->save();

        return redirect()->back();
    }

    public function checkoutRent(Request $request, $id)
    {
        $console = Console::findOrFail($id);
        
        // Ambil transaksi aktif beserta data membernya
        $transaction = \App\Models\Transaction::with('member')
            ->where('console_id', $console->id)
            ->where('status', 'belum_bayar')
            ->latest()
            ->firstOrFail();

        // Hitung durasi nyata sewa
        $startTime = $transaction->created_at;
        $now = \Carbon\Carbon::now();
        $diffMins = $now->diffInMinutes($startTime);
        if ($diffMins < 0) {
            $diffMins = 0;
        }

        $jamNyata = floor($diffMins / 60);
        $sisaMenit = $diffMins % 60;
        if ($sisaMenit > 5) {
            $jamNyata += 1;
        }
        if ($jamNyata == 0) {
            $jamNyata = 1;
        }

        // Fungsi tarif sewa PS
        $calculatePrice = function ($jam) {
            if ($jam <= 1) return 8000;
            if ($jam == 2) return 15000;
            return 15000 + (($jam - 2) * 5000);
        };

        // Kebijakan Skenario Biaya
        $skenario = $request->input('skenario_biaya_' . $console->id, 'B');
        
        if ($skenario === 'A' && $transaction->duration > 0) {
            $rentalPrice = $calculatePrice($transaction->duration);
            $durationSaved = $transaction->duration;
        } else {
            $rentalPrice = $calculatePrice($jamNyata);
            $durationSaved = $jamNyata;
        }

        // Proses Item Kantin & Makanan
        $totalKantin = 0;
        $foods = $request->input('food', []);
        
        foreach ($foods as $foodId => $qty) {
            $qty = (int) $qty;
            if ($qty > 0) {
                $menu = \App\Models\MenuKantin::findOrFail($foodId);
                
                // Pastikan qty tidak melebihi stok yang tersedia
                if ($menu->stok < $qty) {
                    $qty = $menu->stok;
                }

                if ($qty > 0) {
                    $subtotal = $menu->harga * $qty;
                    $totalKantin += $subtotal;

                    // Buat relasi transaction_food
                    \App\Models\TransactionFood::create([
                        'transaction_id' => $transaction->id,
                        'menu_kantin_id' => $menu->id,
                        'qty' => $qty,
                        'harga' => $menu->harga,
                        'subtotal' => $subtotal,
                    ]);

                    // Kurangi Stok Menu Kantin
                    $menu->stok -= $qty;
                    if ($menu->stok <= 0) {
                        $menu->stok = 0;
                        $menu->status = 'Habis';
                    }
                    $menu->save();
                }
            }
        }

        // Hitung diskon member (jika transaksi terhubung dengan member)
        $diskonAmount = 0;
        if ($transaction->member) {
            $diskonAmount = (int) round($rentalPrice * ($transaction->member->discount_percentage / 100));
        }

        $grandTotal = $rentalPrice - $diskonAmount + $totalKantin;

        // Update Transaksi
        $transaction->update([
            'duration'    => $durationSaved,
            'total_rental'=> $rentalPrice,
            'total_kantin'=> $totalKantin,
            'diskon'      => $diskonAmount,
            'grand_total' => $grandTotal,
            'total_price' => $grandTotal,
            'status'      => 'lunas',
        ]);

        // Update rekap kumulatif di shift aktif (jika transaksi ini terhubung ke shift)
        if ($transaction->shift_id) {
            $shift = \App\Models\Shift::find($transaction->shift_id);
            if ($shift && $shift->status === 'buka') {
                $shift->increment('total_transaksi', 1);
                $shift->increment('total_rental', $rentalPrice);
                $shift->increment('total_kantin', $totalKantin);
                $shift->increment('total_diskon', $diskonAmount);
                $shift->increment('grand_total', $grandTotal);
            }
        }

        // Kembalikan status console ke tersedia
        $console->status = 'tersedia';
        $console->save();

        return redirect()->back()->with('toast_success', 'Checkout billing berhasil diselesaikan!');
    }

    public function stopRent($id)
    {
        $console = Console::findOrFail($id);
        $console->status = 'tersedia';
        $console->save();

        return redirect()->back(); // Kembali ke halaman dashboard setelah sukses
    }

    public function setBroken($id)
    {
        $console = Console::findOrFail($id);
        $console->status = 'rusak';
        $console->save();

        return redirect()->back(); // Kembali ke halaman dashboard setelah sukses
    }

    public function setAvailable($id)
    {
        $console = Console::findOrFail($id);
        $console->status = 'tersedia';
        $console->save();

        return redirect()->back(); // Kembali ke halaman dashboard setelah sukses
    }

    public function setOffline($id)
    {
        $console = Console::findOrFail($id);
        $console->status = 'offline';
        $console->save();

        return redirect()->back(); // Kembali ke halaman dashboard setelah sukses
    }
}
