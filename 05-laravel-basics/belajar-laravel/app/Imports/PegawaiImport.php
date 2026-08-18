<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawai([
            'nama' => $row['nama_pegawai'],
            'posisi' => $row['posisi'],
            'shift' => $row['shift'],
            'departemen_id' => $row['id_departemen'],
            'foto' => null,
        ]);
    }
}
