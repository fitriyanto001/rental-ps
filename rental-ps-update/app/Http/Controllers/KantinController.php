<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuKantin;
use App\Models\Transaction;
use App\Models\TransactionFood;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KantinController extends Controller
{
    // === 1. DASHBOARD & CRUD MENU KANTIN ===
    public function index(Request $request)
    {
        $query = MenuKantin::query();

        // Search
        if ($request->filled('search')) {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $menus = $query->orderBy('nama_menu', 'asc')->paginate(10)->withQueryString();

        return view('kantin.menu', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|string|in:Tersedia,Habis',
        ]);

        $status = $request->status;
        if ($request->stok == 0) {
            $status = 'Habis';
        }

        MenuKantin::create([
            'nama_menu' => $request->nama_menu,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status' => $status,
        ]);

        return redirect()->route('kantin.menu')->with('toast_success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|string|in:Tersedia,Habis',
        ]);

        $menu = MenuKantin::findOrFail($id);

        $status = $request->status;
        if ($request->stok == 0) {
            $status = 'Habis';
        } elseif ($request->stok > 0 && $menu->stok == 0 && $status == 'Habis') {
            // Auto update status if stock is increased
            $status = 'Tersedia';
        }

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status' => $status,
        ]);

        return redirect()->route('kantin.menu')->with('toast_success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = MenuKantin::findOrFail($id);
        $menu->delete();

        return redirect()->route('kantin.menu')->with('toast_success', 'Menu berhasil dihapus!');
    }

    // === 2. RIWAYAT PENJUALAN KANTIN ===
    public function riwayat(Request $request)
    {
        $query = Transaction::with(['console', 'transactionFoods.menuKantin'])
            ->where('status', 'lunas');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('renter_name', 'like', '%' . $search . '%')
                  ->orWhereHas('console', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('transactionFoods.menuKantin', function ($q3) use ($search) {
                      $q3->where('nama_menu', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('kantin.riwayat', compact('transactions'));
    }

    // Print Riwayat Penjualan
    public function riwayatPrint(Request $request)
    {
        $query = Transaction::with(['console', 'transactionFoods.menuKantin'])
            ->where('status', 'lunas');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('renter_name', 'like', '%' . $search . '%')
                  ->orWhereHas('console', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('transactionFoods.menuKantin', function ($q3) use ($search) {
                      $q3->where('nama_menu', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('kantin.riwayat_print', compact('transactions'));
    }

    // Export Excel (Custom CSV)
    public function riwayatExportExcel(Request $request)
    {
        $query = Transaction::with(['console', 'transactionFoods.menuKantin'])
            ->where('status', 'lunas');

        // Search & Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('renter_name', 'like', '%' . $search . '%')
                  ->orWhereHas('console', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('transactionFoods.menuKantin', function ($q3) use ($search) {
                      $q3->where('nama_menu', 'like', '%' . $search . '%');
                  });
            });
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        $filename = 'riwayat_penjualan_kantin_' . date('Ymd_His') . '.xls';
        
        // Output Excel format directly using HTML output with specific Headers
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'public'
        ];

        $callback = function () use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for MS Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Excel HTML Wrapper
            echo '
            <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
            <head>
                <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
            </head>
            <body>
            <table border="1">
                <tr style="background-color: #3b82f6; color: #ffffff; font-weight: bold;">
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama PS</th>
                    <th>Daftar Menu</th>
                    <th>Qty</th>
                    <th>Total Kantin (Rp)</th>
                    <th>Total Rental (Rp)</th>
                    <th>Grand Total (Rp)</th>
                </tr>';
                
            foreach ($transactions as $tx) {
                $menuList = [];
                $qtyList = [];
                foreach ($tx->transactionFoods as $food) {
                    $menuList[] = $food->menuKantin->nama_menu ?? 'Menu Terhapus';
                    $qtyList[] = $food->qty;
                }
                $menuStr = implode(', ', $menuList);
                $qtyStr = implode(', ', $qtyList);
                
                echo '<tr>';
                echo '<td>' . htmlspecialchars($tx->created_at->format('Y-m-d H:i:s')) . '</td>';
                echo '<td>' . htmlspecialchars($tx->renter_name) . '</td>';
                echo '<td>' . htmlspecialchars($tx->console->name ?? '-') . '</td>';
                echo '<td>' . htmlspecialchars($menuStr ?: '-') . '</td>';
                echo '<td>' . htmlspecialchars($qtyStr ?: '-') . '</td>';
                echo '<td>' . $tx->total_kantin . '</td>';
                echo '<td>' . $tx->total_rental . '</td>';
                echo '<td>' . $tx->grand_total . '</td>';
                echo '</tr>';
            }
            
            echo '
            </table>
            </body>
            </html>';
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // === 3. LAPORAN KANTIN ===
    public function laporan()
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // 1. Total transaksi hari ini (lunas)
        $totalTransactionsToday = Transaction::where('status', 'lunas')
            ->whereDate('created_at', $today)
            ->count();

        // 2. Pendapatan kantin hari ini
        $canteenRevenueToday = Transaction::where('status', 'lunas')
            ->whereDate('created_at', $today)
            ->sum('total_kantin');

        // 3. Pendapatan minggu ini
        $canteenRevenueThisWeek = Transaction::where('status', 'lunas')
            ->where('created_at', '>=', $startOfWeek)
            ->sum('total_kantin');

        // 4. Pendapatan bulan ini
        $canteenRevenueThisMonth = Transaction::where('status', 'lunas')
            ->where('created_at', '>=', $startOfMonth)
            ->sum('total_kantin');

        // 5. Total item terjual
        $totalItemsSold = TransactionFood::whereHas('transaction', function ($q) {
            $q->where('status', 'lunas');
        })->sum('qty');

        // 6. Menu terlaris
        $bestSellingMenus = TransactionFood::select('menu_kantin_id', DB::raw('SUM(qty) as total_qty'))
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'lunas');
            })
            ->groupBy('menu_kantin_id')
            ->orderBy('total_qty', 'desc')
            ->with('menuKantin')
            ->take(5)
            ->get();

        // 7. Grafik Penjualan Harian (7 Hari Terakhir)
        $salesChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateString = $date->format('Y-m-d');
            $label = $date->translatedFormat('d M');
            
            $rentalSales = Transaction::where('status', 'lunas')
                ->whereDate('created_at', $dateString)
                ->sum('total_rental');

            $canteenSales = Transaction::where('status', 'lunas')
                ->whereDate('created_at', $dateString)
                ->sum('total_kantin');

            $salesChartData[] = [
                'label' => $label,
                'rental' => $rentalSales,
                'canteen' => $canteenSales,
                'total' => $rentalSales + $canteenSales
            ];
        }

        return view('kantin.laporan', compact(
            'totalTransactionsToday',
            'canteenRevenueToday',
            'canteenRevenueThisWeek',
            'canteenRevenueThisMonth',
            'totalItemsSold',
            'bestSellingMenus',
            'salesChartData'
        ));
    }
}
