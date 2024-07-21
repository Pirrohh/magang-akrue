<?php

namespace App\Filament\Exports;

use App\Models\Pelanggan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PelangganExporter extends Exporter
{
    protected static ?string $model = Pelanggan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('kode'),
            ExportColumn::make('nama_mitra'),
            ExportColumn::make('nama_lop'),
            ExportColumn::make('nomor_inet'),
            ExportColumn::make('nomor_pots'),
            ExportColumn::make('nama_pelanggan'),
            ExportColumn::make('tanggal_aktivasi'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pelanggan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
