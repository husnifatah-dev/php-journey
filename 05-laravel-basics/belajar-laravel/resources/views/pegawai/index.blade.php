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
                <select id="filterDeparetemen" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="">Semua Departemen</option>
                    @foreach($departemen as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">Shift</label>
                <select id="filterShift" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"> 
                    <option value="">Semua Shift</option>
                    <option value="Pagi">Pagi</option>
                    <option vlaue="Siang">Siang</option>
                    <option value="Malam">Malam</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tarcking-wide mb-1">Cari Nama / Posisi</label>
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
                        @if(auth()->user()->role === 'admin')
                            <a href="/pegawai/{{ $pegawai->id }}/edit" class="bg-amber-500 hover:bg-amber-600 text-white py-1 px-3 rounded transition duration-200">Edit</a>
                            <button class="btn-hapus bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-200" data-id="{{ $pegawai->id }}">
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
@endsection