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
        </tr>

        @foreach ($data_pegawai as $pegawai)
        <tr>
            <td>{{ $pegawai->id }}</td>
            <td>{{ $pegawai->nama }}</td>
            <td>{{ $pegawai->posisi }}</td>
            <td>{{ $pegawai->shift }}</td>
            <td>
                <a href="/pegawai/{{ $pegawai->id }}/edit">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
    

</body>
</html>