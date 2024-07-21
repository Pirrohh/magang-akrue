<?php

namespace App\Filament\Exports;

use App\Models\Mitra;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MitrasExporter extends Exporter
{
    protected static ?string $model = Mitra::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('kode'),
            ExportColumn::make('nama_mitra'),
            ExportColumn::make('nama_lop'),
            ExportColumn::make('periode_billing'),
            ExportColumn::make('bulan_awal_sharing'),
            ExportColumn::make('bulan_akhir_sharing'),
            ExportColumn::make('sharing'),
            
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your mitras export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
