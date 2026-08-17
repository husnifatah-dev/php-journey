<!DOCTYPE html>
<html>
<head>
    <title>ID Card {{ $pegawai->nama }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .card {
            width: 100%;
            text-align: center;
            border: 2px solid #1f2937;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .card-header {
            background-color: #1f2937;
            color: white;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 15px 20px;
        }

        .foto-profil {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px solid #1f2937;
            object-fit: cover;
            margin: 0 auto 10px auto;
            display: block;
        }

        .no-photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background-color: #e5e7eb;
            line-height: 110px;
            margin: 0 auto 10px auto;
            color: #6b7280;
            border: 3px solid #1f2937;
        }

        .name {
            font-size: 22px;
            font-weight: bold;
            margin: 0 0 3px 0;
            color: #111827;
        }

        .position {
            font-size: 16px;
            color: #4b5563;
            margin: 0 0 15px 0;
        }

        .detail-info {
            text-align: left;
            margin-top: 5px;
            font-size: 14px;
            line-height: 1.6;
        }

        .detail-info p {
            margin: 0;
        }

        .footer {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px dashed #d1d5db;
            font-size: 12px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card">

        <div class="card-header">
            ID CARD PEGAWAI
        </div>

        <div class="card-body">

            @if($pegawai->foto)

                <img
                    src="{{ public_path('storage/' . $pegawai->foto) }}"
                    class="foto-profil"
                >

            @else

                <div class="no-photo">
                    Tanpa Foto
                </div>

            @endif

            <div class="name">
                {{ $pegawai->nama }}
            </div>

            <div class="position">
                {{ $pegawai->posisi }}
            </div>

            <div class="detail-info">

                <p>
                    <strong>ID Karyawan :</strong>
                    {{ sprintf('EMP-%04d', $pegawai->id) }}
                </p>

                <p>
                    <strong>Departemen :</strong>
                    {{ $pegawai->departemen->nama_departemen ?? '-' }}
                </p>

                <p>
                    <strong>Shift Kerja :</strong>
                    {{ $pegawai->shift }}
                </p>

            </div>

            <div class="footer">
                Sistem Manajemen Pabrik Internal
                <br>
                <em>
                    Kartu ini wajib dipakai selama berada di area pabrik
                </em>
            </div>

        </div>

    </div>

</body>
</html>