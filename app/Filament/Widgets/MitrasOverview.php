<?php

namespace App\Filament\Widgets;

use App\Models\Mitra;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MitrasOverview extends BaseWidget
{
    protected function getStats(): array
{
    $uniqueNameCount = Mitra::distinct('nama_lop')->count();
    return [
        Stat::make('Jumlah Nama LOP', $uniqueNameCount),
        // Stat lainnya jika diperlukan
    ];
}
}
