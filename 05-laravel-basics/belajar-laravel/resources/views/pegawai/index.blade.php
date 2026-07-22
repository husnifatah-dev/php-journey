@extends('layouts.main')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Pegawai</h2>
        <a href="/pegawai/create" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
            Tambah Pegawai
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="/pegawai" method="GET" class="mb-6 flex" onsubmit="return false;">
        <input type="text" name="cari" id="searchInput" placeholder="Cari nama pegawai..." value="{{ request('cari') }}" class="border border-gray-300 rounded-l-md px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring-blue-500 focus:border-transparent">
        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 border border-gray-300 border-l-0 rounded-r-md transition duration-200">
            Cari
        </button>
    </form>

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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                        <a href="/pegawai/{{ $pegawai->id }}/edit" class="bg-amber-500 hover:bg-amber-600 text-white py-1 px-3 rounded transition duration-200">Edit</a>
                        <button class="btn-hapus bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-200" data-id="{{ $pegawai->id }}">
                            Hapus
                        </button>
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