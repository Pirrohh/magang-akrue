<?php

namespace App\Imports;

use App\Models\Billing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BillingsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Billing([
            'kode' => $row['kode'],
            'nomor_inet' => $row['nomor_inet'],
            'billing_inet' => $row['billing_inet'],
            'nomor_pots' => $row['nomor_pots'],
            'periode_billing' => $row['periode_billing'],
            'total_billing' => $row['total_billing'],
            'tanggal_bayar' => $row['tanggal_bayar'],
        ]);
    }
}
