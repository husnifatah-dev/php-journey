<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Pabrik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    <nav class="bg-gray-900 text-white shadow-lg mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <a href="/pegawai" class="text-xl font-bold tracking-wider">
                    Pabrik Laravel
                </a>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-300">
                        Halo, <b class="text-white">{{ auth()->user()->name }}</b>!
                    </span>

                    <form action="/logout" method="POST"
                        onsubmit="return confirm('Yakin ingin logout?')">
                        @csrf

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition duration-200">
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