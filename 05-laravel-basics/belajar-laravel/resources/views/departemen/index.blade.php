@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Master Data Departemen</h2>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-green-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
            <h3 class="text-lg font-semibold mb-4">Tambah Departemen</h3>
            <form action="/departemen" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Departemen</label>
                    <input type="text" name="nama_departemen" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blur-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Simpan Baru
                </button>
            </form>
        </div>
        
        <div class="md:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-4 text-sm font-medium uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-sm font-medium uppercase tracking-wider">Nama Departemen</th>
                        <th class="px-6 py-4 text-sm font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($departemens as $dept)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $dept->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $dept->nama_departemen }}</td>
                            <td class="px-6 py-4 text-sm flex space-x-2">
                                <form action="/departemen/{{ $dept->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus departemen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded transition duration-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection