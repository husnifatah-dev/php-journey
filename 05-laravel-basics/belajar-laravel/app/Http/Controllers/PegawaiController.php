<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;

class PegawaiController extends Controller
{
    public function index(Request $request) {

    $query = Pegawai::with('departemen');
    if ($request->has('cari')) {
        $query->where('nama', 'LIKE', '%'. $request->cari . '%');
    }
        $data_pegawai = $query->paginate(5);

        return view('pegawai.index', compact('data_pegawai'));
    }

    public function create() {
        $departemen =  Departemen::all();
        return view('pegawai.create', compact('departemen'));
    }

    public function store(Request $request) {

        $request->validate([
            'nama' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,avg|max:2048',
            'shift' => 'required',
            'departemen_id' => 'required'

        ], [
            'nama.required' => 'Nama pegawai wajib diisi!',
            'nama.min' => 'Nama minimal harus 3 huruf.',
            'posisi.required' => 'Posisi/ Jabatan tidak boleh kosong.',
            'departemen_id.required' => 'Harus pilih departemennya.'
        ]); 

        $path_foto = null;
        if ($request->hasFile('foto')) {
            $path_foto = $request->file('foto')->store('foto_pegawai', 'public');
        }

        Pegawai::create([
            
            'nama' => ucwords(strtolower(trim($request->nama))),
            'foto' => $path_foto,
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);

        return redirect('/pegawai')->with('success', 'Data pegawai baru berhasil ditambahkan.');
    }

    public function edit($id) {
        $pegawai = Pegawai::find($id);
        $departemen = Departemen::all();

        return view('pegawai.edit', compact('pegawai', 'departemen'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|min:3',
            'posisi' => 'required|max:30',
            'shift' => 'required',
            'departemen_id' => 'required',
        ], [
            'nama.required' => 'Nama pegawai wajib diisi!',
            'nama.min' => 'Nama minimal harus 3 huruf.',
            'posisi.required' => 'Posisi / Jabatan tidak boleh kosong.',
            'departemen_id.required' => 'Harus pilih departemenya.'

        ]);

        Pegawai::find($id)->update([
            'nama' => ucwords(strtolower(trim($request->nama))),
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);
        
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil diubah.');
    }

    public function destroy($id) {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return redirect('/pegawai')->with('success', 'Data pegawai sudah dihapus dari sistem.');
    }
}
