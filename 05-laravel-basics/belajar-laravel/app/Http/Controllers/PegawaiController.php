<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;

class PegawaiController extends Controller
{
    public function index() {
        $data_pegawai = Pegawai::with('departemen')->get();

        return view('pegawai.index', compact('data_pegawai'));
    }

    public function create() {
        $departemen =  Departemen::all();
        return view('pegawai.create', compact('departemen'));
    }

    public function store(Request $request) {

        $request->validate([
            'nama' => 'required|min:3',
            'posisi' => 'required|max: 30',
            'shift' => 'required',
            'departemen_id' => 'required'

        ], [
            'nama.required' => 'Nama pegawai wajib diisi!',
            'nama.min' => 'Nama minimal harus 3 huruf.',
            'posisi.required' => 'Posisi/ Jabatan tidak boleh kosong.',
            'departemen_id' => 'Harus pilih departemennya.'
        ]); 

        Pegawai::create([
            
            'nama' => ucwords(strtolower(trim($request->nama))),
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);

        return redirect('/pegawai');
    }

    public function edit($id) {
        $pegawai = Pegawai::find($id);
        $departemen = Departemen::all();

        return view('pegawai.edit', compact('pegawai', 'departemen'));
    }

    public function update(Request $request, $id) {
        Pegawai::find($id)->update([
            'nama' => ucwords(strtolower(trim($request->nama))),
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);
        
        return redirect('/pegawai');
    }

    public function destroy($id) {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return redirect('/pegawai');
    }
}
