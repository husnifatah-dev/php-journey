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

}
