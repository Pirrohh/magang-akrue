<?php

namespace App\Filament\Widgets;

use App\Models\Mitra;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class MitrasChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah LOP';

    protected function getData(): array
    {
        // Mengambil data dari kolom 'nama_lop' dan 'jumlah_sharing'
        $data = Mitra::select('nama_lop', 'sharing(%)')->get();

        $totalSharing = $data->sum('sharing(%)');

        // Menghitung total sharing untuk setiap nama lop
        $sharingPercentages = $data->groupBy('nama_lop')
            ->map(function ($group) use ($totalSharing) {
                return round(($group->sum('sharing(%)') / $totalSharing) * 100, 2);
            })
            ->toArray();

        $labels = [];
        foreach ($sharingPercentages as $nama_lop => $persentase) {
            $labels[] = "$nama_lop: $persentase%";
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Sharing',
                    'data' => array_values($sharingPercentages),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF', '#FF66B3', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF', '#FF66B3', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF'],
                    'borderColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF', '#FF66B3', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF', '#FF66B3', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#6384FF'],
                ],
            ],
            'labels' => array_keys($sharingPercentages),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Menggunakan chart jenis bar untuk representasi vertical-horizontal
    }
}
