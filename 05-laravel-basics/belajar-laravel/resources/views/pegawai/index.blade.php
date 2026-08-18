@extends('layouts.main')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Pegawai</h2>
        <div class="flex space-x-3">
            <a href="/pegawai/export/excel" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </a>
            @if(auth()->user()->role === 'admin')
                <button onclick="document.getElementById('modalImport').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                    Import Data
                </button>
                <a href="/pegawai/create" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                    Tambah Pegawai
                </a>
                <a href="/pegawai/sampah"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                    🗑️ Tong Sampah
                </a>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Departemen</label>
                <select id="filterDepartemen" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="">Semua Departemen</option>
                    @foreach($departemens as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">Shift</label>
                <select id="filterShift" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"> 
                    <option value="">Semua Shift</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Siang">Siang</option>
                    <option value="Malam">Malam</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Cari Nama / Posisi</label>
                <input type="text" id="searchInput" placeholder="Ketik nama pegawai...."
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
        </div>

    </div>

    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr> 
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Departemen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Posisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Shift</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pelatihan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <!-- Pindahkan id="tableBody" ke sini -->
            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                @foreach ($data_pegawai as $pegawai)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pegawai->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $pegawai->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($pegawai->foto)
                            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto" class="h-12 w-12 object-cover rounded shadow-sm">
                        @else 
                            <span class="text-sm text-gray-400 italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pegawai->departemen->nama_departemen ?? 'Belum ada' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pegawai->posisi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($pegawai->shift == 'Pagi')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-800">Pagi</span>
                        @elseif($pegawai->shift == 'Siang')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Siang</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Malam</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-normal">
                        <div class="flex flex-wrap gap-1">
                            @forelse($pegawai->pelatihans as $pelatihan)
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-[10px] font-bold px-2 py-1 rounded-md border border-indigo-200">
                                    {{ $pelatihan->nama_pelatihan }}
                                </span>
                            @empty
                                <span class="text-gray-400 italic text-xs">
                                    Belum ada
                                </span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                        <button class="btn-detail bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-200 cursor-pointer" data-id="{{ $pegawai->id }}">
                            Detail
                        </button>
                        @if(auth()->user()->role === 'admin')
                            <a href="/pegawai/{{ $pegawai->id }}/edit" class="bg-amber-500 hover:bg-amber-600 text-white py-1 px-3 rounded transition duration-200">Edit</a>
                            <button class="btn-hapus bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-200 cursor-pointer" data-id="{{ $pegawai->id }}">
                                Hapus
                            </button>
                        @else
                            <span class="text-gray-400 italic">Tidak ada akses</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6" id="paginationContainer">
        {{ $data_pegawai->withQueryString()->links() }}
    </div>
    <div id="modalDetail" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300 relative">

            <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Foto Profil Lengkap</h3>
                <button id="btnCloseModal" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div id="modalFoto" class="modalFoto" class="h-20 w-20 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center overflow-hidden">
                        <!-- js -->
                    </div>
                    <div>
                        <h4 id="modalNama" class="text-xl font-bold text-gray-900">Memuat...</h4>
                        <p id="modalPosisi" class="text-sm text-gray-500">Memuat...</h4>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-sm font-medium text-gray-500">Departemen</span>
                        <span id="modalDepartemen" class="text-sm text-gray-900 font-semibold">...</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-sm font-medium text-gray-500">Shift</span>
                        <span id="modalShift" class="text-sm text-gray-900 font-semibold">...</span>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500 block mb-2">Riwayat Pelatihan:</span>
                        <div id="modalPelatihan" class="flex flex-warp gap-1">
                            <!-- js -->
                        </div>
                    </div>
                    <div class="mt-6 py-4 border-t border-gray-200">
                        <a href="#" id="btnCetakIdCard" class="w-full flex justify-center items-center bg-gray-800 hover:bg-gray-900 text-white font-bold py2 px-4 rounded transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak ID Card (PDF)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalImport" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Import Data dari Excel</h3>
            <p class="text-sm text-gray-500 mb-4">
                Pastikan baris pertama Excel Anda memiliki judul kolom: <br>
                <code class="bg-gray-100 text-red-600 px-1 py-0.5 rounded">nama_pegawai</code>,
                <code class="bg-gray-100 text-red-600 px-1 py-0.5 rounded">posisi</code>,
                <code class="bg-gray-100 text-red-600 px-1 py-0.5 rounded">shift</code>,
                <code class="bg-gray-100 text-red-600 px-1 py-0.5 rounded">id_departemen</code>,
            </p>

            <form id="formImportExcel" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file_excel" accept=".xlsx, .xls, .csv" required class="w-full border border-gray-300 rounded p-2 mb-4">

                <div class="flex justify-end space-x-3">
                    <button type="button" onclik="document.getElementById('modalImport').classList.add('hidden')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded">Batal</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">Upload & Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection