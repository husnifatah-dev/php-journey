<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index() {
        $data_pegawai = Pegawai::all();

        return view('pegawai.index', compact('data_pegawai'));
    }

    public function create() {
        return view('pegawai.create');
    }

    public function store(Request $request) {
        Pegawai::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'shift' => $request->shift
        ]);

        return redirect('/pegawai');
    }
}
