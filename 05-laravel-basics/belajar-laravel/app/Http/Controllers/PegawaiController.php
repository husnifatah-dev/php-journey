<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Departemen;
use Illuminate\Support\Facades\Storage;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    private function checkAdmin(Request $request) {
        if (auth()->user()->role !== 'admin') {
            if ($request->wantsJson() || $request->ajax()) {
                abort(response()->json(['status' => 'error', 'pesan' => 'Akses ditolak! Anda bukan Admin.'], 403));
            }
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh melakukan aksi ini.');
        }
    }

    public function index(Request $request) {

    $query = Pegawai::with('departemen');
    if ($request->has('cari') && $request->cari != '') {
        $query->where('nama', 'LIKE', "%{$request->cari}%")
            ->orWhere('posisi', 'LIKE', "%{$request->cari}%");
    }
        $data_pegawai = $query->paginate(5);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'pegawais' => $data_pegawai->items(),
                'pagination' => (string) $data_pegawai->withQueryString()->links(),
                'isAdmin' => auth()->user()->role === 'admin'
            ]);
        }

        return view('pegawai.index', compact('data_pegawai'));
    }

    public function create(Request $request) {
        $this->checkAdmin($request);
        $departemen =  Departemen::all();
        return view('pegawai.create', compact('departemen'));
    }

    public function store(Request $request) {
        $this->checkAdmin($request);
        $request->validate([
            'nama' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'posisi' => 'required|max:30',
            'shift' => 'required',
            'departemen_id' => 'required|exists:departemens,id'

        ], [
            'nama.required' => 'Nama pegawai wajib diisi!',
            'nama.min' => 'Nama minimal harus 3 huruf.',
            'posisi.required' => 'Posisi/ Jabatan tidak boleh kosong.',
            'shift.required' => 'Shift wajib dipilih.',
            'departemen_id.required' => 'Harus pilih departemennya.',
            'departemen_id.exists' => 'Departemen yang dipilih tidak valid.'
        ]); 

        $path_foto = null;
        if ($request->hasFile('foto')) {
            $path_foto = $request->file('foto')->store('foto_pegawai', 'public');
        }

        Pegawai::create([
            
            'nama' => ucwords(strtolower(trim($request->nama))),
            'foto' => $path_foto,
            'posisi' => ucwords(strtolower(trim($request->posisi))),
            'shift' => $request->shift,
            'departemen_id' => $request->departemen_id
        ]);

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
        $pegawai = Pegawai::findOrFail($id);
        $departemen = Departemen::all();

        return view('pegawai.edit', compact('pegawai', 'departemen'));
    }

    public function update(Request $request, $id) {
        $this->checkAdmin($request);
        $request->validate([
            'nama' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'posisi' => 'required|max:30',
            'shift' => 'required',
            'departemen_id' => 'required|exists:departemens,id',
        ], [
            'nama.required' => 'Nama pegawai wajib diisi!',
            'nama.min' => 'Nama minimal harus 3 huruf.',
            'posisi.required' => 'Posisi / Jabatan tidak boleh kosong.',
            'shift.required' => 'Shift wajib dipilih.',
            'departemen_id.required' => 'Harus pilih departemenya.',
            'departemen_id.exists' => 'Departemen yang dipilih tidak valid.'

        ]);

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
}
