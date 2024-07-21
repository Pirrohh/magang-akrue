<?php

namespace App\Imports;

use App\Models\Mitra;
use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class MitrasImport implements ToModel,WithHeadingRow,SkipsEmptyRows,WithProgressBar
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Mitra([
            'kode' => $row['kode'],
            'nama_mitra' => $row['nama_mitra'],
            'nama_lop'    => $row['nama_lop'],
            'periode_billing' => $row['periode_billing' ],
            'bulan_awal_sharing' => $row['bulan_awal_sharing'],
            'bulan_akhir_sharing' => $row['bulan_akhir_sharing'],
            'sharing(%)' => $row['sharing(%)'],

            
        ]);

        return new Pelanggan([
            'nama_mitra'=> $row['nama_mitra'],
            'nama_lop'=> $row['nama_lop'],
        ]);

        
    }

    
}
