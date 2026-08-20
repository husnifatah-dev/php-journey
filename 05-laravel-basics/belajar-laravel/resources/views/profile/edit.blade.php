@extends('layouts.main')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Profil</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form action="/profil" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="flex items-center space-x-6 mb-6">
                    <div class="shrink-0">
                        @if($user->foto_profil)
                            <img class="h-24 w-24 object-cover rounded-full border-2 border-indigo-500" src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil">
                        @else
                            <div class="h-24 w-24 rounded-full bg-indigo-100 flex items-center justify-center border-2 border-indigo-500">
                                <span class="text-indigo-800 font-bold text-3xl">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <label class="block">
                        <span class="sr-only">Pilih foto profil</span>
                        <input type="file" name="foto_profil" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:px-4 file:py-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file-text-700 hover:file:bg-indigo-100"/>
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG atau JPEG (Maks. 2MB)</p>
                    </label>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Email (Tidak bisa diubah)</label>
                    <input type="email" value="{{ $user->email }}" disabled class="w-full border border-gray-300 bg-gray-100 rounded-md px-3 py-2 text-gray-500 cursor-notallowed">
                </div>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded transition duration-200">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection