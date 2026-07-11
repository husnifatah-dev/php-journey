@extends('layouts.main')

@section('content')
    <h1>Form Edit Data Pegawai</h1>
    <form action="/pegawai/{{ $pegawai->id }}" method="POST" style="border : 1px solid black; padding: 20px; width: 300px;">
        @csrf
        @method('PUT')

        <label>Nama Pegawai</label>
        <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" required><br>
        @error('nama')
            <i style="color: red;  font-size: 12px; ">{{$message}}</i>
        @enderror
        <br>

        <label>Departemen</label>
        <select name="departemen_id" id="departemen_id">
            <option value="">-- Pilih Departemen --</option>
            @foreach($departemen as $dpt)
            <option value="{{ $dpt->id }}" {{ old('departemen_id', $pegawai->departemen_id) == $dpt->id ? 'selected' : ''}}>
                {{ $dpt->nama_departemen }}
            </option>
            @endforeach
        </select> <br>
        @error('departemen_id')
            <i style="color: red; font-size: 12px;">{{$message}}</i>
        @enderror
        <br>

        <label>Posisi / Jabatan</label>
        <input type="text" name="posisi" value="{{ old('posisi', $pegawai->posisi) }}" required><br>
        @error('posisi')
            <i style="color: red; font-size: 12px;">{{$message}}</i>
        @enderror
        <br>

        <label>Shift</label>
        <select name="shift" id="shift">
            <option value="Pagi" {{ old('shift', $pegawai->shift) == 'Pagi' ? 'selected' : ''}}>Pagi</option>
            <option value="Siang" {{ old('shift', $pegawai->shift) == 'Siang' ? 'selected' : ''}}>Siang</option>
            <option value="Malam" {{ old('shift', $pegawai->shift) == 'Malam' ? 'selected' : ''}}>Malam</option>
        </select><br><br>

        <button type="submit">Update Data</button>
    </form>

    <br>
    <a href="/pegawai">Batal / Kembali</a>
    
@endsection