<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;

class PelanggansExport implements FromCollection
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
            $mitra->id_pelanggan,
            $mitra->nama_mitra,
            $mitra->nama_lop,
            $mitra->nomor_inet,
            $mitra->nomor_pots,
            $mitra->nama_pelanggan,
            $mitra->tanggal_aktivasi,

        ];
    }

    public function headings(): array
    {
        return [
        'id_pelanggan',
        'nama_mitra',
        'nama_lop',
        'nomor_inet',
        'nomor_pots',
        'nama_pelanggan',
        'tanggal_aktivasi',
        ];
    }
}
