<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemens = Departemen::latest()->get();
        return view('departemen.index', compact('departemens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departemens,nama_departemen'
        ]);

        Departemen::create([
            'nama_departemen' => $request->nama_departemen
        ]);

        return back()->with('success', 'Departemen baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departemens,nama_departemen,' . $id
        ]);

        $departemen = Departemen::findOrFail($id);
        $departemen->update([
            'nama_departemen' => $request->nama_departemen
        ]);

        return back()->with('success', 'Nama departemen berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $departemen = Departemen::findOrFail($id);

        if ($departemen->pegawai()->count() > 0) {
            return back()->with('error', 'Gagal! Departemen ini masih memiliki pegawai.');
        }

        $departemen->delete();
        return back()->with('success', 'Departemen berhasil dihapus!');
    }
}
