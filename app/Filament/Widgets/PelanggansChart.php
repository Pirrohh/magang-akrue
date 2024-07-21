<?php

namespace App\Filament\Widgets;

use App\Models\Pelanggan;
use Filament\Widgets\ChartWidget;

class PelanggansChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Mitra';

    protected function getData(): array
    {
        // Mengambil data dari kolom 'nama_lop' pada tabel 'mitra'
        $data = Pelanggan::pluck('nama_lop')->toArray();

        // Menghitung jumlah kemunculan masing-masing nama
        $counts = array_count_values($data);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Mitra',
                    'data' => array_values($counts),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF', '#FF66B3', '#FF6384', '#36A2EB'
                ],
                'borderColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF', '#FF66B3', '#FF6384', '#36A2EB'
            ],
                ],
            ],
            'labels' => array_keys($counts),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Tipe chart bisa diganti ke 'bar', 'line', dll.
    }
}
