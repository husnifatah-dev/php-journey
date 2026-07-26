<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PegawaiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    // * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pegawai::with('departemen')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pegawau',
            'Posisi / Jabatan',
            'Shift',
            'Tanggal Didaftarkan'
        ];
    }

    public function map($pegawai): array 
    {
        return [
            $pegawai->id,
            $pegawai->nama,
            $pegawai->posisi,
            $pegawai->departemen ? $pegawai->departemen->nama_departemen : 'Belum ada',
            $pegawai->shift,
            $pegawai->created_at->format('d-m-Y H:i:s'),
        ];
    }
}
