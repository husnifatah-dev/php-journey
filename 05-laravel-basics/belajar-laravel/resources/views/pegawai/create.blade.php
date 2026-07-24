@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Pegawai Baru</h2>
        <a href="/pegawai" class="text-gray-500 hover:text-gray-700 underline text-sm">Kembali ke Daftar</a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
        <form action="/pegawai" method="POST" enctype="multipart/form-data" class="space-y-5" id="formTambah">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pegawai <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama')}}" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror 
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil (Opsional)</label>
                <input type="file" name="foto"
                        class="w-full border border-gray-300 rounded-md px-4 py-1.5 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('foto')
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi / Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="posisi" value="{{ old('posisi')}}" required 
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('posisi')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>
            
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Departemen <span class="text-red-500">*</span></label>
                    <select name="departemen_id" id="departemen_id"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departemen as $dpt)
                            <option value="{{ $dpt->id }}" {{ old('departemen_id') == $dpt->id ? 'selected' : '' }}> {{ $dpt->nama_departemen }}</option>
                        @endforeach
                    </select>
                    @error('departemen_id')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Shift <span class="text-red-500">*</span></label>
                <select name="shift" id="shift"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="Pagi" {{ old('shift') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                    <option value="Siang" {{ old('shift') == 'Siang' ? 'selected' : '' }}>Siang</option>
                    <option value="Malam" {{ old('shift') == 'Malam' ? 'selected' : '' }}>Malam</option>
                </select>
                @error('shift')
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-md transition duration-200">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection