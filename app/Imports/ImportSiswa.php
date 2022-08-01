<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSiswa implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswa([
            'nis'  => $row['nis'],
            'nama' => $row['nama'],
            'tgl_lahir'    => $row['tgl_lahir'],
            'jenis_kelamin'    => $row['jenis_kelamin'],
            'kelas_id'    => $row['kelas_id'],
            'nama_wali'    => $row['nama_wali'],
            'no_hp'    => $row['no_hp'],
            'alamat'    => $row['alamat'],
        ]);
    }
}
