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

        <label>Departemen</label>
        <select name="departemen_id" id="departemen_id">
            <option value="">-- Pilih Departemen --</option>
            @foreach($departemen as $dpt)
            <option value="{{ $dpt->id }}" {{ $pegawai->departemen_id == $dpt->id ? 'selected' : ''}}>
                {{ $dpt->nama_departemen }}
            </option>
            @endforeach
        </select> <br><br>

        <label>Posisi / Jabatan</label>
        <input type="text" name="posisi" value="{{ $pegawai->posisi }}" required><br><br>

        <label>Shift</label>
        <select name="shift" id="shift">
            <option value="Pagi" {{ $pegawai->shift == 'Pagi' ? 'selected' : ''}}>Pagi</option>
            <option value="Siang" {{ $pegawai->shift == 'Siang' ? 'selected' : ''}}>Siang</option>
            <option value="Malam" {{ $pegawai->shift == 'Malam' ? 'selected' : ''}}>Malam</option>
        </select><br><br>

        <button type="submit">Update Data</button>
    </form>

    <br>
    <a href="/pegawai">Batal / Kembali</a>
    
</body>
</html>