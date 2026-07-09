<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        // Search name or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $members = $query->orderBy('name', 'asc')->paginate(10)->withQueryString();

        return view('member.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'discount_percentage' => 'required|integer|min:0|max:100',
        ]);

        Member::create($request->all());

        return redirect()->route('member.index')->with('toast_success', 'Member baru berhasil didaftarkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'discount_percentage' => 'required|integer|min:0|max:100',
        ]);

        $member = Member::findOrFail($id);
        $member->update($request->all());

        return redirect()->route('member.index')->with('toast_success', 'Data member berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('member.index')->with('toast_success', 'Data member berhasil dihapus!');
    }
}
