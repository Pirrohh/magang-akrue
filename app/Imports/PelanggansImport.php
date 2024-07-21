<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelanggansImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pelanggan([
            'kode'=> $row['kode'],
            'nama_mitra'=> $row['nama_mitra'],
            'nama_lop'=> $row['nama_lop'],
            'nomor_inet'=> $row['nomor_inet'],
            'nomor_pots'=> $row['nomor_pots'],
            'nama_pelanggan'=> $row['nama_pelanggan'],
            'tanggal_aktivasi'=> $row['tanggal_aktivasi'],
        ]);
    }
}
