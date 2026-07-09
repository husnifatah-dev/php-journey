<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title> Tambah Pegawai </title>
</head>
<body>
    <h1>FORM TAMBAH PEGAWAI BARU</h1>
    <form action="/pegawai" method="POST" style="border: 1px solid black; padding: 20px; width: 300px;">
        @csrf

        <label>Nama Pegawai</label>
        <input type="text" name="nama" value="{{old('nama')}}" required> <br>
        @error('nama')
            <i style="color: red; font-size: 12px;">{{ $message }}</i>
        @enderror 
        <br>

        <label>Departemen:</label>
        <select name="departemen_id" id="departemen_id">
            <option value="">-- Pilih Departemen --</option>
            @foreach($departemen as $dpt)
                <option value="{{ $dpt->id }}" {{ old('departemen_id') ==  $dpt->id ?'selected' : '' }}> {{$dpt->nama_departemen}}</option>
            @endforeach
        </select> <br>
        @error('departemen_id')
            <i style="color: red; font-size: 12px;">{{ $message }}</i>
        @enderror
        <br>

        <label>Posisi / Jabatan</label>
        <input type="text" name="posisi" value="{{old('posisi')}}" required><br>
        @error('posisi')
            <i style="color: red; font-size: 12px ">{{ $message }}</i>
        @enderror
        <br>

        <label>Shift</label>
        <select name="shift" id="shift">
            <option value="Pagi">Pagi</option>
            <option value="Siang">Siang</option>
            <option value="Malam">Malam</option>
        </select><br><br>

        <button type="submit">Simpan Data</button>
    </form>
    <br>
    <a href="/pegawai">Kembali ke Daftar</a>
</body>
</html>