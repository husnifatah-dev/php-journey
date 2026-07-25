@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Pegawai</h2>
        <a href="/pegawai" class="text-gray-500 hover:text-gray-700 underline text-sm">Batal / Kembali</a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
        <form class="space-y-5" id="formEdit" data-id="{{ $pegawai->id }}">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pegawai <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-4 bg-gray-50 border border-gray-200 rounded-md">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil Saat Ini</label>
                <div class="flex items-center space-x-4 mb-3">
                    @if($pegawai->foto)
                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai" width="80" class="h-16 w-16 object-cover rounded-md shadow-sm border border-gray-300">
                    @else
                        <div class="h-16 w-16 flex items-center justify-center bg-gray-200 rounded-md border border-gray-300 text-xs text-gray-500">Kosong</div>
                    @endif

                    <div class="flex-1">
                        <input type="file" name="foto"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-white file:border-gray-300 file:border file:text-gray-700 hover:file:bg-gray-50"> 
                        <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika tidak ingin mengganti foto</p>
                    </div>
                </div>
                @error('foto')   
                    <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi / Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="posisi" value="{{ old('posisi', $pegawai->posisi) }}" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    @error('posisi')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Departemen <span class="text-red-500">*</span></label>
                    <select name="departemen_id" id="departemen_id"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departemen as $dpt)
                        <option value="{{ $dpt->id }}" {{ old('departemen_id', $pegawai->departemen_id) == $dpt->id ? 'selected' : '' }}>
                            {{ $dpt->nama_departemen }}
                        </option>
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
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                    <option value="Pagi" {{ old('shift', $pegawai->shift) == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                    <option value="Siang" {{ old('shift', $pegawai->shift) == 'Siang' ? 'selected' : '' }}>Siang</option>
                    <option value="Malam" {{ old('shift', $pegawai->shift) == 'Malam' ? 'selected' : '' }}>Malam</option>
                </select>
                @error('shift')
                    <p class="text-red-500 text-xs mt-1 italic"> {{ $message }}</p>
                @enderror
            </div>
    
            <div class="pt-4">
                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-700 text-white font-bold py-2.5 px-4 rounded-md transition duration-200">
                    Update Data Pegawai
                </button>
            </div>
        </form>
    </div>
</div>
    
@endsection