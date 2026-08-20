<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Manajemen Pabrik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    <nav class="bg-gray-900 text-white shadow-lg mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <div class="flex items-center gap-6">
                    <a href="/pegawai" class="text-xl font-bold tracking-wider">
                        Pabrik Laravel
                    </a>

                    <a href="/dashboard" class="hover:text-blue-400 transition">
                        Dashboard
                    </a>

                    <a href="/pegawai" class="hover:text-blue-400 transition">
                        Pegawai
                    </a>

                    <a href="/departemen" class="hover:text-blue-400 transition">
                        Departemen
                    </a>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="/profil" class="flex items-center space-x-2 text-gray-300 hover:text-indigo-600 transition">
                        @if(auth()->user()->foto_profil)
                            <img class="h-8 w-8 object-cover rounded-full border border-gray-300" src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Foto">
                        @else
                            <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                        <span class="font-medium text-sm hidden md:block">{{ auth()->user()->name }}</span>
                    </a>

                    <form action="/logout" method="POST"
                        onsubmit="return confirm('Yakin ingin logout?')">
                        @csrf

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition duration-200 cursor-pointer">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @yield('content')
        </div>
    </main>

    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6 text-center text-gray-500 text-sm">
        &copy; 2026 - Dibuat oleh Husni Fatah (Backend Engineer)
    </footer>
</body>
</html>