<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;

class ConsoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Console::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $consoles = $query->orderBy('name', 'asc')->paginate(10)->withQueryString();

        return view('console.index', compact('consoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:PS4,PS5',
            'status' => 'required|string|in:tersedia,rusak,offline',
        ]);

        Console::create($request->all());

        return redirect()->route('console.index')->with('toast_success', 'Unit PS baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:PS4,PS5',
            'status' => 'required|string|in:tersedia,aktif,rusak,offline',
        ]);

        $console = Console::findOrFail($id);
        
        // Prevent changing status of active console directly unless needed, but let's allow it or keep standard warning
        $console->update($request->all());

        return redirect()->route('console.index')->with('toast_success', 'Data unit PS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $console = Console::findOrFail($id);

        // Jangan izinkan hapus jika PS sedang digunakan/aktif
        if ($console->status === 'aktif') {
            return redirect()->route('console.index')->with('toast_error', 'Gagal: Unit PS sedang aktif digunakan!');
        }

        $console->delete();

        return redirect()->route('console.index')->with('toast_success', 'Unit PS berhasil dihapus!');
    }
}
