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
}
