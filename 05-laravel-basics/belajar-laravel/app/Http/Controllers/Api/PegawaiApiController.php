<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiApiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('departemen')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data pegawai berhasil diambil',
            'data' => $pegawai
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'shift' => 'required|in:Pagi,Siang,Malam',
            'departemen_id' => 'required|exists:departemens,id',
        ]);

        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil ditambahkan via APi',
            'data' => $pegawai,
        ], 201);
    }
}
