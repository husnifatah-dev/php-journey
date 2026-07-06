<!DOCTYPE hrml>
<html>
<head>
    <meta charset="UTF-8">
    <title>EDIT PEGAWAI</title>
</head>
<body>
    <h1>Form Edit Data Pegawai</h1>
    <form action="/pegawai/{{ $pegawai->id }}" method="POST" style="border : 1px solid black; padding: 20px; width: 300px;">
        @csrf
        @method('PUT')

        <label>Nama Pegawai</label>
        <input type="text" name="nama" value="{{ $pegawai->nama }}" required><br><br>

        <label>Posisi / Jabatan</label>
        <input type="text" name="posisi" value="{{ $pegawai->posisi }}" required><br><br>

        <label>Shift</label>
        <select name="shift" id="shift">
            <option value="Pagi" {{ $pegawai->shift == 'Pagi' ? 'selected' : ''}}>Pagi</option>
            <option value="Siang" {{ $pegawai->shift == 'Siang' ? 'selected' : ''}}>Siang</option>
            <option value="Malam" {{ $pegawai->shift == 'Malam' ? 'selected' : ''}}>Malam</option>
        </select><br><br>

        <button type="submit">Simpan Data</button>
    </form>

    <br>
    <a href="/pegawai">Batal / Kembali</a>
    
</body>
</html>