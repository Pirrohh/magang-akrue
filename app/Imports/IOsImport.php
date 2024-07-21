<?php

namespace App\Imports;

use App\Models\IO;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IOsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new IO([
            'kode' => $row['kode'],
            'nomor_inet' => $row['nomor_inet'],
            'billing_inet' => $row['billing_inet'],
            'periode' => $row['periode'],
            'total_billing' => $row['total_billing'],
            'nomor_pots' => $row['nomor_pots'],
            'billing_pots' => $row['billing_pots'],
            'revenue_share_inet' => $row['revenue_share_inet'],
            'revenue_share_pots' => $row['revenue_share_pots'],
            'total_billing_sharing' => $row['total_billing_sharing'],
            'total_nilai_sharing' => $row['total_nilai_sharing']
        ]);
    }
}
