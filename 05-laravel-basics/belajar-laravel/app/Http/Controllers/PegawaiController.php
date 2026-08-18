<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;
use Illuminate\Support\Facades\Storage;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Imports\PegawaiImport;
use Barryvdh\DomPDF\Facade\Pdf;

class PegawaiController extends Controller
{
    private function checkAdmin($request) {
        if (auth()->user()->role !== 'admin') {
            if ($request->wantsJson() || $request->ajax()) {
                abort(response()->json(['status' => 'error', 'pesan' => 'Akses ditolak! Anda bukan Admin.'], 403));
            }
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh melakukan aksi ini.');
        }
    }

    public function index(Request $request) {

    $departemens = \App\Models\Departemen::all();

    $query = Pegawai::with(['departemen', 'pelatihans']);
    if ($request->has('cari') && $request->cari != '') {
        $query->where(function($q) use ($request) {
            $q->where('nama', 'LIKE', "%{$request->cari}%")
                ->orWhere('posisi', 'LIKE', "%{$request->cari}%");   
        });
    }

    if ($request->has('shift') &&  $request->shift != '') {
        $query->where('shift', $request->shift);
    }

    if ($request->has('departemen_id') && $request->departemen_id != '') {
        $query->where('departemen_id', $request->departemen_id);
    }
                
    $data_pegawai = $query->paginate(5);
    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'pegawais' => $data_pegawai->items(),
            'pagination' => (string) $data_pegawai->withQueryString()->links(),
            'isAdmin' => auth()->user()->role === 'admin'
        ]);
    }

    return view('pegawai.index', compact('data_pegawai', 'departemens'));
    }

    public function create(Request $request) {
        $this->checkAdmin($request);
        $departemen = \App\Models\Departemen::all();
        $pelatihans = \App\Models\Pelatihan::all();
        return view('pegawai.create', compact('departemen', 'pelatihans'));
    }

    public function store(StorePegawaiRequest $request) {
        $this->checkAdmin($request);
        
        $path_foto = null;
        if ($request->hasFile('foto')) {
            $path_foto = $request->file('foto')->store('foto_pegawai', 'public');
        }

        $pegawai = Pegawai::create([
            
            'nama' => ucwords(strtolower(trim($request->nama))),
            'foto' => $path_foto,
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);
        $pegawai->pelatihans()->sync((array) $request->pelatihan_id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'pesan'  => 'Pegawai baru berhasil didaftarkan!'
            ]);
        }

        return redirect('/pegawai')->with('success', 'Data pegawai beserta foto berhasil ditambahkan!');
    }

    public function edit(Request $request, $id) {
        $this->checkAdmin($request);
        $pegawai = Pegawai::with('pelatihans')->findOrFail($id);
        $departemen = \App\Models\Departemen::all();
        $pelatihans = \App\Models\Pelatihan::all();

        return view('pegawai.edit', compact('pegawai', 'departemen', 'pelatihans'));
    }

    public function update(UpdatePegawaiRequest $request, $id) 
    {
        $this->checkAdmin($request);
        
        $pegawai = Pegawai::findOrFail($id);
        $path_foto = $pegawai->foto;
        
        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $path_foto = $request->file('foto')->store('foto_pegawai', 'public');

        }
            
        $pegawai->update([
            'nama' => ucwords(strtolower(trim($request->nama))),
            'foto' => $path_foto,
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);
        $pegawai->pelatihans()->sync((array) $request->pelatihan_id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'pesan' => 'Data pegawai sukses diperbarui!'
            ]);
        }
        
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil diubah.');
    }

    public function destroy(Request $request, $id) {
        $this->checkAdmin($request);
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'pesan' => 'Pegawai dipindahkan ke tong sampah'
            ]);
        }

        return redirect('/pegawai')->with('success', 'Data pegawai dipindah ke tong sampah!');
    }

    public function exportExcel()
    {
        return Excel::download(new PegawaiExport, 'Data_Pegawai_Pabrik.xlsx');
    }

    public function sampah(Request $request)
    {
        $this->checkAdmin($request);
        $data_pegawai = Pegawai::onlyTrashed()->with('departemen')->latest()->paginate(5);

        return view('pegawai.trash', compact('data_pegawai'));
    }

    public function restore(Request $request, $id)
    {
        $this->checkAdmin($request);
        $pegawai = Pegawai::onlyTrashed()->findOrFail($id);
        $pegawai->restore();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'success', 'pesan' => 'Pegawai berhasil dikembalikan ke posisi semula!']);
        }

        return redirect('/pegawai/sampah');
    }

    public function forceDelete(Request $request, $id)
    {
        $this->checkAdmin($request);

        $pegawai = Pegawai::onlyTrashed()->findOrFail($id);
        if ($pegawai->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->forceDelete();
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'success', 'pesan' => 'Data musnah tak tersisa dari database!']);
        }
    
        return redirect('/pegawai/sampah');

    }

    public function show(Request $request, $id)
    {
        $pegawai = Pegawai::with(['departemen', 'pelatihans'])->findOrFail($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $pegawai
            ]);
        }
        return abort(404, 'Halaman ini khusus diakses via AJAX.');
    }

    public function cetakIdCard($id)
    {
        $pegawai = Pegawai::with('departemen')->findOrFail($id);
        $pdf = Pdf::loadView('pegawai.id-card', compact('pegawai'));
        $pdf->setPaper('a6', 'portrait');
        $namaFile = 'ID-CARD-' . str_replace(' ', '-', strtoupper($pegawai->nama)) . '.pdf';
        
        return $pdf->download($namaFile);
    }

    public function importExcel(Request $request)
    {
        $this->checkAdmin($request);

        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:5120'
        ]);

        try {
            $file = $request->file('file_excel');

            Excel::import(new PegawaiImport, $file);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['status' => 'success', 'pesan' => 'Data berhasil masuk ke database!']);
            }

            return back()->with('success', 'Data Pegawai berhasil di import!');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['status' => 'error', 'pesan' => 'Format Excel salah atau data yang tidak valid. Pastikan judul kolom sesuai dengan template.']);
            }

            return back()->with('error', 'Gagal Import! Pesan Error: ' . $e->getMessage());
        }
    }
}
