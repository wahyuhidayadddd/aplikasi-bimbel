<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Student;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount('students')->latest()->get();

        return view('owner.branches.index', [
            'branches' => $branches,
            'total' => Branch::count(),
            'active' => Branch::where('status', 'active')->count(),
            'students' => Student::count(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
        ]);

        Branch::create([
            'name' => $request->name,
            'city' => $request->city,
            'status' => 'active',
        ]);

        return back()->with('success', 'Cabang berhasil ditambahkan');
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
        ]);

        $branch->update([
            'name' => $request->name,
            'city' => $request->city,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Cabang berhasil diupdate');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return back()->with('success', 'Cabang berhasil dihapus');
    }
}