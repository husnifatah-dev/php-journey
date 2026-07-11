<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pabrik Laravel</title>
    <style>
        body {
            font-family: sans-serif; padding: 20px;
        }
        table {
            width: 100%; border-collapse: collapse; margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd; padding: 8px; text-align: left;
        }
        th {
            background-color: black; color: white;
        }


    </style>
</head>
<body>
    <div style="background-color: #f4f4f4; padding: 10px; margin-bottom: 20px;">
        <h2 style="margin: 0;">Sistem Manajemen Pabrik</h2>
        <a href="/pegawai">Data Pegawai</a> | <a href="#">Data Departemen</a>
    </div>

    @yield('content')

    <div style="margin-top: 30px; font-size: 12px; color: gray;">
        &copy: 2026 - Dibuat oleh Husni Fatah (Backend Engineer)
    </div>
</body>
</html>