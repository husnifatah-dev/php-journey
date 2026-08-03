@extends('layouts.main')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-red-700 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Tong Sampah Pegawai
            </h2>
            <p class="text-sm text-gray-500 mt-1">Data di bawah ini sudah tidak aktif. Hapus permanen akan menghilangkan data selamanya.</p>
        </div>
        <a href="/pegawai" class="text-gray-500 hover:text-gray-700 underline text-sm font-medium">Kembali ke Daftar Aktif</a>
    </div>

    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-red-50 text-red-700">
                <tr> 
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Posisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tgl Dihapus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBodyTrash" class="bg-white divide-y divide-gray-200">
                @forelse ($data_pegawai as $pegawai)
                <tr class="hover:bg-red-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $pegawai->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pegawai->posisi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pegawai->deleted_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                        <!-- Tombol Restore -->
                        <button class="btn-restore bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded transition duration-200" data-id="{{ $pegawai->id }}">
                            Pulihkan
                        </button>
                        <!-- Tombol Force Delete -->
                        <button class="btn-force-delete bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded transition duration-200" data-id="{{ $pegawai->id }}">
                            Hapus Permanen
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Tong sampah bersih. Tidak ada data yang dihapus.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $data_pegawai->links() }}
    </div>
@endsection