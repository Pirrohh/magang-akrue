<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MitrasExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
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
            $mitra->kode,
            $mitra->nama_mitra,
            $mitra->nama_lop,
            $mitra->periode_billing,
            $mitra->bulan_awal_sharing,
            $mitra->bulan_akhir_sharing,
            $mitra->sharing,

        ];
    }

    public function headings(): array
    {
        return [
            'kode',
            'nama_mitra',
            'nama_lop',
            'periode_billing',
            'bulan_awal_sharing',
            'bulan_akhir_sharing',
            'sharing',
        ];
    }
}
