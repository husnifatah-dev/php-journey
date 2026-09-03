<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
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

    public function store(PegawaiRequest $request)
    {
       $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil ditambahkan via API',
            'data' => $pegawai,
        ], 201);
    }

    public function show($id) 
    {
        $pegawai = Pegawai::with('departemen')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data pegawai berhasil diambil',
            'data' => $pegawai
        ], 200);
    }

    public function update(PegawaiRequest $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diupdate!',
            'data' => $pegawai
        ], 200);
    } 

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus!'
        ], 200);
    }
}
