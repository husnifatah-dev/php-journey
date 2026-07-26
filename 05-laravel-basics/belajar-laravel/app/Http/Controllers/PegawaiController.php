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
                'pagination' => (string) $data_pegawai->withQueryString()->links()
            ]);
        }

        return view('pegawai.index', compact('data_pegawai'));
    }

    public function create() {
        $departemen =  Departemen::all();
        return view('pegawai.create', compact('departemen'));
    }

    public function store(Request $request) {

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

    public function edit($id) {
        $pegawai = Pegawai::findOrFail($id);
        $departemen = Departemen::all();

        return view('pegawai.edit', compact('pegawai', 'departemen'));
    }

    public function update(Request $request, $id) {
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
            'departemen_id.exist' => 'Departemen yang dipilih tidak valid.'

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
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'pesan' => 'Data pegawai berhasil dimusnahkan!'
            ]);
        }

        return redirect('/pegawai')->with('success', 'Data pegawai sudah dihapus dari sistem.');
    }

    public function exportExcel()
    {
        return Excel::download(new PegawaiExport, 'Data_Pegawai_Pabrik.xlsx');
    }
}
