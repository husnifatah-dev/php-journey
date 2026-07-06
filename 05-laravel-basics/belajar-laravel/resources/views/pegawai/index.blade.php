<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Profil Pegawai Pabrik</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr style="background-color: black; color: white;"> 
            <th>ID</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Shift</th>
            <th>Aksi</th>
            <!-- <th>Aksoy</th> -->
        </tr>

        @foreach ($data_pegawai as $pegawai)
        <tr>
            <td>{{ $pegawai->id }}</td>
            <td>{{ $pegawai->nama }}</td>
            <td>{{ $pegawai->posisi }}</td>
            <td>{{ $pegawai->shift }}</td>
            <td>
                <a href="/pegawai/{{ $pegawai->id }}/edit">Edit</a>

                <form action="/pegawai/{{ $pegawai->id }}" method="POST" style="display: inline; margin-left: 5px; ">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah anda benar ingin menghapus data pegawai ini?')">
                        Hapus
                    </button>

                </form>
            </td>
        </tr>
        @endforeach
    </table>
    

</body>
</html>