@extends('layouts.main')

@section('content')
    <h1>Profil Pegawai Pabrik</h1>
    @if (session('success'))
        <div style="background-color: lightgreen; color: darkgreen; padding: 10px; margin-bottom: 15px; border: 1px solid green;">
            <b>NOTIFIKASI:</b> {{session('success')}}
        </div>
    @endif
    <a href="/pegawai/create" style="display: inline-block; margin-bottom: 15px; text-decoration: none; background-color: blue; color: white; padding: 5px;  ">Tambah Pegawai Baru</a>
    <table>
        <tr> 
            <th>ID</th>
            <th>Nama</th>
            <th>Departemen</th>
            <th>Posisi</th>
            <th>Shift</th>
            <th>Aksi</th>
            <!-- <th>Aksoy</th> -->
        </tr>

        @foreach ($data_pegawai as $pegawai)
        <tr>
            <td>{{ $pegawai->id }}</td>
            <td>{{ $pegawai->nama }}</td>
            <td>{{ $pegawai->departemen->nama_departemen ?? 'Belum ada departemen'}}</td>
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
    
@endsection