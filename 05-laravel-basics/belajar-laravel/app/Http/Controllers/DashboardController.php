<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count();
        $shiftPagi = Pegawai::where('shift', 'Pagi')->count();
        $shiftSiang = Pegawai::where('shift', 'Siang')->count();
        $shiftMalam = Pegawai::where('shift', 'Malam')->count();
        $totalDepartemen = Departemen::count();

        return view('dashboard.index', compact(
            'totalPegawai', 'shiftPagi', 'shiftSiang', 'shiftMalam', 'totalDepartemen'
        ));
    }
}
