<?php

namespace App\Exports;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class BillingsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(public Collection $records)
    {
    }

    public function collection()
    {
        return $this->records;
    }

    public function map($mitra): array
    {
        return [
            $mitra->id_billings,
            $mitra->            nomor_inet,
            $mitra->            billing_inet,
            $mitra->            nomor_pots,
            $mitra->            periode,
            $mitra->            total_billing,
            $mitra->            tanggal_bayar,

        ];
    }

    public function headings(): array
    {
        return [
            'id_billings',
            'nomor_inet',
            'billing_inet',
            'nomor_pots',
            'periode',
            'total_billing',
            'tanggal_bayar',
        ];
    }
}
