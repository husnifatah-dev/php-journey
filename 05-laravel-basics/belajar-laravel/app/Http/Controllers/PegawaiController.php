<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index() {
        $nama = "Husni Fatah";
        $posisi = "Backend Engineer";

        return view('pegawai.index', compact('nama', 'posisi'));
    }

}
