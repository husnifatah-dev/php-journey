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
        Pegawai::create([
            
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);

        return redirect('/pegawai');
    }

    public function edit($id) {
        $pegawai = Pegawai::find($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id) {
        Pegawai::find($id)->update([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
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
