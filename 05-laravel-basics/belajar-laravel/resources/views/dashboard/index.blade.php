@extends('layouts.main')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Statistik</h2>
        <p class="text-gray-500 text-sm mt-1">Ringkasan data Sistem Manajemen Pabrik saat ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pegawai</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPegawai }}</p>
            </div>          
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-full bg-teal-100 text-teal-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Shift Pagi</p>
                <p class="text-2xl font-bold text-gray-800">{{ $shiftPagi }}</p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Shift Siang</p>
                <p class="text-2xl font-bold text-gray-800">{{ $shiftSiang }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Shift Malam</p>
                <p class="text-2xl font-bold text-gray-800">{{ $shiftMalam }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
            <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Departemen</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalDepartemen }}</p>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Komposisi Shift Pegawai</h3>
        <div class="w-full md:w-1/3 mx-auto">
            <canvas id="shiftChart"></canvas>
        </div>
    </div>
    </div>

    <div class="flex space-x-4">
        <a href="/pegawai" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-md font-medium transition duration-200 shadow-sm">
            Lihat Data Pegawai
        </a>
    </div>
    <script>
            window.statistikShift = {
            pagi: {{ $shiftPagi }},
            siang: {{ $shiftSiang }},
            malam: {{ $shiftMalam }},
        };
    </script>
@endsection